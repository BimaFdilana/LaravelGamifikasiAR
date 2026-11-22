<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserMission;
use App\Models\Badge;
use App\Models\Location;
use App\Models\Mission;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('role', 'mahasiswa')->count();
        $missionsCompleted = UserMission::where('status', 'completed')->count();
        $totalBadges = Badge::count();
        $totalMissions = Mission::count();
        $missionsByType = Mission::selectRaw('type, count(*) as total')->groupBy('type')->pluck('total', 'type');
        $totalLocations = Location::count();

        $leaderboard = User::where('role', 'mahasiswa')
            ->orderBy('total_points', 'desc')
            ->take(10)
            ->get();

        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'missionsCompleted' => $missionsCompleted,
            'totalBadges' => $totalBadges,
            'totalMissions' => $totalMissions,
            'missionsByType' => $missionsByType,
            'totalLocations' => $totalLocations,
            'leaderboard' => $leaderboard,
        ]);
    }

    public function users()
    {
        $students = User::where('role', 'mahasiswa')
            ->orderBy('name', 'asc')
            ->paginate(15);

        return view('admin.users', ['students' => $students]);
    }
}
