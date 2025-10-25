<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GameController;
use App\Http\Controllers\Api\ProgressController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/missions', [GameController::class, 'getMissions']);
    Route::get('/missions/{mission}', [GameController::class, 'getMissionDetail']);
    Route::get('/badges', [GameController::class, 'getBadges']);
    Route::get('/locations', [GameController::class, 'getLocations']);

    Route::get('/profile', [ProgressController::class, 'getProfile']);
    Route::post('/missions/{mission}/complete', [ProgressController::class, 'completeMission']);
});