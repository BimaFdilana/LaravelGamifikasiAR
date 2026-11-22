<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Badge;
use App\Models\Location;
use App\Models\Mission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    /** Urutan kategori misi: pencarian gedung dulu, lalu kuis. Tipe buku (lama) ditaruh paling akhir. */
    private const TYPE_ORDER = ['building', 'quiz', 'book'];

    /**
     * Mengambil daftar misi milik user.
     * - User baru: urutan misi dibuat acak per kategori.
     * - User lama: misi yang baru ditambahkan admin otomatis ditambahkan di akhir daftar.
     */
    public function getMissions(Request $request)
    {
        $user = $request->user();

        if ($user->missions()->count() === 0) {
            $this->generateRandomMissionsForUser($user);
        } else {
            $this->appendNewMissionsForUser($user);
            $this->ensureOneOpenMission($user);
        }

        $missions = $user->missions()->with('badge')->get();
        return response()->json($missions);
    }

    private function orderedMissions($exceptIds = [])
    {
        $result = collect();
        foreach (self::TYPE_ORDER as $type) {
            $result = $result->merge(
                Mission::where('type', $type)->whereNotIn('id', $exceptIds)->inRandomOrder()->get()
            );
        }
        return $result;
    }

    private function generateRandomMissionsForUser($user): void
    {
        $syncData = [];
        $order = 1;
        foreach ($this->orderedMissions() as $mission) {
            $syncData[$mission->id] = [
                'order' => $order,
                'status' => $order === 1 ? 'in_progress' : 'locked',
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $order++;
        }
        if ($syncData) $user->missions()->attach($syncData);
    }

    private function appendNewMissionsForUser($user): void
    {
        $existingIds = DB::table('user_missions')->where('user_id', $user->id)->pluck('mission_id')->all();
        $newMissions = $this->orderedMissions($existingIds);
        if ($newMissions->isEmpty()) return;

        $maxOrder = (int) DB::table('user_missions')->where('user_id', $user->id)->max('order');
        // Jika semua misi lama sudah selesai, misi baru pertama langsung dibuka.
        $hasOpen = DB::table('user_missions')->where('user_id', $user->id)
            ->whereIn('status', ['in_progress', 'locked'])->exists();

        $syncData = [];
        $order = $maxOrder + 1;
        foreach ($newMissions as $i => $mission) {
            $syncData[$mission->id] = [
                'order' => $order++,
                'status' => (!$hasOpen && empty($syncData)) ? 'in_progress' : 'locked',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        $user->missions()->attach($syncData);
    }

    /** Jika misi yang sedang berjalan dihapus admin, buka misi terkunci berikutnya. */
    private function ensureOneOpenMission($user): void
    {
        $hasInProgress = DB::table('user_missions')->where('user_id', $user->id)->where('status', 'in_progress')->exists();
        if ($hasInProgress) return;
        $next = DB::table('user_missions')->where('user_id', $user->id)->where('status', 'locked')->orderBy('order')->first();
        if ($next) {
            DB::table('user_missions')->where('id', $next->id)->update(['status' => 'in_progress', 'updated_at' => now()]);
        }
    }

    public function getMissionDetail(Mission $mission)
    {
        $mission->load('badge');
        return response()->json($mission);
    }

    public function getBadges()
    {
        return response()->json(Badge::all());
    }

    public function getLocations()
    {
        return response()->json(Location::all());
    }
}
