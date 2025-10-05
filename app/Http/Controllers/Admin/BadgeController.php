<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Badge;
use Illuminate\Http\Request;

class BadgeController extends Controller
{
    public function index()
    {
        $badges = Badge::latest()->paginate(10);
        return view('admin.badges.index', compact('badges'));
    }

    public function create()
    {
        return view('admin.badges.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:badges',
            'icon_url' => 'required|string|max:255',
        ]);

        Badge::create($request->all());

        return redirect()->route('admin.badges.index')
            ->with('success', 'Lencana berhasil ditambahkan.');
    }

    public function edit(Badge $badge)
    {
        return view('admin.badges.edit', compact('badge'));
    }

    public function update(Request $request, Badge $badge)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:badges,name,' . $badge->id,
            'icon_url' => 'required|string|max:255',
        ]);

        $badge->update($request->all());

        return redirect()->route('admin.badges.index')
            ->with('success', 'Lencana berhasil diperbarui.');
    }

    public function destroy(Badge $badge)
    {
        $badge->delete();

        return redirect()->route('admin.badges.index')
            ->with('success', 'Lencana berhasil dihapus.');
    }
}