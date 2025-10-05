<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserMission;
use App\Models\Badge;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('role', 'mahasiswa')->count();
        $missionsCompleted = UserMission::where('status', 'completed')->count();
        $totalBadges = Badge::count();

        $leaderboard = User::where('role', 'mahasiswa')
            ->orderBy('total_points', 'desc')
            ->take(10)
            ->get();

        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'missionsCompleted' => $missionsCompleted,
            'totalBadges' => $totalBadges,
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
