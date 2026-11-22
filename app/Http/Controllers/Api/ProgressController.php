<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // <--- WAJIB ADA INI

class ProgressController extends Controller
{
    public function getProfile(Request $request)
    {
        $user = $request->user()->load(['badgesEarned', 'missionsCompleted']);
        return response()->json($user);
    }

    public function startMission(Request $request, $id)
    {
        $user = Auth::user();

        // Gunakan DB::table untuk akurasi 100%
        $pivot = DB::table('user_missions')
                    ->where('user_id', $user->id)
                    ->where('mission_id', $id)
                    ->first();

        if (!$pivot) {
            return response()->json(['message' => 'Misi tidak valid / belum di-generate.'], 404);
        }

        if ($pivot->status === 'completed') {
            return response()->json(['message' => 'Misi sudah selesai.', 'status' => 'completed'], 200);
        }

        // Update Status
        DB::table('user_missions')
            ->where('id', $pivot->id) // Update by Primary Key tabel pivot
            ->update([
                'status' => 'in_progress',
                'updated_at' => now()
            ]);

        return response()->json([
            'message' => 'Misi dimulai!',
            'status' => 'in_progress'
        ], 200);
    }

   public function finishMission(Request $request, $id)
    {
        $user = Auth::user();

        // 1. Validasi Manual: Pastikan Misi Ada
        $missionExists = \DB::select('SELECT id, points_reward, badge_reward_id FROM missions WHERE id = ?', [$id]);
        if (empty($missionExists)) {
            return response()->json(['message' => 'Misi tidak ditemukan'], 404);
        }
        $missionData = $missionExists[0];

        // 2. Cek Pivot User
        $pivotData = \DB::select('SELECT id, status, `order` FROM user_missions WHERE user_id = ? AND mission_id = ?', [$user->id, $id]);

        if (empty($pivotData)) {
             return response()->json(['message' => 'Misi belum diambil.'], 400);
        }

        $currentPivot = $pivotData[0];

        // Jika sudah completed, stop.
        if ($currentPivot->status === 'completed') {
            return response()->json(['message' => 'Sudah selesai sebelumnya', 'points_awarded' => 0], 200);
        }

        // 3. EXECUTE RAW UPDATE (INI YANG MEMASTIKAN STATUS BERUBAH)
        // Kita pakai statement UPDATE langsung. Tidak mungkin gagal kecuali database mati.
        \DB::update('
            UPDATE user_missions
            SET status = "completed", completed_at = NOW(), updated_at = NOW()
            WHERE id = ?
        ', [$currentPivot->id]);

        // 4. Update User Points & Level (Manual Update User)
        $user->total_points += $missionData->points_reward;

        // Hitung Level (Manual Logic biar aman)
        $points = $user->total_points;
        $newLevel = 1;
        if ($points >= 1000) $newLevel = 5;
        elseif ($points >= 500) $newLevel = 4;
        elseif ($points >= 250) $newLevel = 3;
        elseif ($points >= 100) $newLevel = 2;

        $isLevelUp = $newLevel > ($user->level ?? 1);

        // Raw Update User
        \DB::update('UPDATE users SET total_points = ?, level = ?, updated_at = NOW() WHERE id = ?', [$user->total_points, $newLevel, $user->id]);

        // 5. Handle Badge (Raw Insert)
        if ($missionData->badge_reward_id) {
            $hasBadge = \DB::select('SELECT id FROM user_badges WHERE user_id = ? AND badge_id = ?', [$user->id, $missionData->badge_reward_id]);
            if (empty($hasBadge)) {
                \DB::insert('INSERT INTO user_badges (user_id, badge_id, created_at, updated_at) VALUES (?, ?, NOW(), NOW())', [$user->id, $missionData->badge_reward_id]);
            }
        }

        // 6. Buka Misi Selanjutnya (Next Order)
        $currentOrder = $currentPivot->order;
        $nextOrder = $currentOrder + 1;

        // Cari ID user_missions berikutnya
        // Misi berikutnya = urutan terdekat setelah misi ini yang belum selesai
        // (tetap benar walaupun ada misi yang dihapus admin sehingga urutan bolong).
        $nextMissionPivot = \DB::select('SELECT id, mission_id FROM user_missions WHERE user_id = ? AND `order` > ? AND status <> "completed" ORDER BY `order` ASC LIMIT 1', [$user->id, $currentOrder]);

        $nextMissionData = null;
        if (!empty($nextMissionPivot)) {
            $nextPivotId = $nextMissionPivot[0]->id;
            $nextMissionId = $nextMissionPivot[0]->mission_id;

            // Unlock Next Mission
            \DB::update('UPDATE user_missions SET status = "in_progress", updated_at = NOW() WHERE id = ?', [$nextPivotId]);

            // Ambil Info Judul
            $nextMissionInfo = \DB::select('SELECT id, title FROM missions WHERE id = ?', [$nextMissionId]);
            if (!empty($nextMissionInfo)) {
                $nextMissionData = [
                    'id' => $nextMissionInfo[0]->id,
                    'title' => $nextMissionInfo[0]->title
                ];
            }
        }

        return response()->json([
            'message' => 'Misi Selesai!',
            'points_awarded' => $missionData->points_reward,
            'total_points' => $user->total_points,
            'is_level_up' => $isLevelUp,
            'current_level' => $newLevel,
            'next_mission' => $nextMissionData
        ]);
    }
}
