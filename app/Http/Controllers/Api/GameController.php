<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Badge;
use App\Models\Location;
use App\Models\Mission;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function getMissions()
    {
        $missions = Mission::with('badge')->latest()->get();
        return response()->json($missions);
    }

    public function getMissionDetail(Mission $mission)
    {
        $mission->load('badge');
        return response()->json($mission);
    }

    public function getBadges()
    {
        $badges = Badge::all();
        return response()->json($badges);
    }

    public function getLocations()
    {
        $locations = Location::all();
        return response()->json($locations);
    }
}