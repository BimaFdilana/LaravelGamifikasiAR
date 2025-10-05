<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mission;
use App\Models\Badge;
use Illuminate\Http\Request;

class MissionController extends Controller
{

    public function index()
    {
        $missions = Mission::with('badge')->latest()->paginate(10);
        return view('admin.missions.index', compact('missions'));
    }

    public function create()
    {
        $badges = Badge::all();
        return view('admin.missions.create', compact('badges'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'points_reward' => 'required|integer|min:0',
            'badge_reward_id' => 'nullable|exists:badges,id'
        ]);

        Mission::create($request->all());

        return redirect()->route('admin.missions.index')
            ->with('success', 'Misi berhasil ditambahkan.');
    }

    public function edit(Mission $mission)
    {
        $badges = Badge::all();
        return view('admin.missions.edit', compact('mission', 'badges'));
    }

    public function update(Request $request, Mission $mission)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'points_reward' => 'required|integer|min:0',
            'badge_reward_id' => 'nullable|exists:badges,id'
        ]);

        $mission->update($request->all());

        return redirect()->route('admin.missions.index')
            ->with('success', 'Misi berhasil diperbarui.');
    }

    public function destroy(Mission $mission)
    {
        $mission->delete();

        return redirect()->route('admin.missions.index')
            ->with('success', 'Misi berhasil dihapus.');
    }
}
