<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{

    public function getProfile(Request $request)
    {
        $user = $request->user()->load('badgesEarned');
        return response()->json($user);
    }

    public function completeMission(Request $request, Mission $mission)
    {
        $user = Auth::user();

        $isCompleted = $user->missionsCompleted()->where('mission_id', $mission->id)->exists();

        if ($isCompleted) {
            return response()->json(['message' => 'Misi ini sudah pernah Anda selesaikan.'], 409); // 409 Conflict
        }

        $user->missionsCompleted()->attach($mission->id);

        $user->total_points += $mission->points_reward;

        if ($mission->badge_reward_id) {
            $hasBadge = $user->badgesEarned()->where('badge_id', $mission->badge_reward_id)->exists();
            if (!$hasBadge) {
                $user->badgesEarned()->attach($mission->badge_reward_id);
            }
        }

        $user->save();

        return response()->json([
            'message' => 'Selamat! Misi berhasil diselesaikan.',
            'total_points' => $user->total_points
        ]);
    }
}