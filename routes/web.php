<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MissionController;
use App\Http\Controllers\Admin\BadgeController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\MarkerController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/users', [DashboardController::class, 'users'])->name('users');

        Route::resource('missions', MissionController::class);
        Route::resource('badges', BadgeController::class);
        Route::resource('locations', LocationController::class);

        Route::get('/penanda', [MarkerController::class, 'index'])->name('markers.index');
        Route::get('/penanda/lembar-cetak', [MarkerController::class, 'sheet'])->name('markers.sheet');
        Route::get('/penanda/{name}/gambar', [MarkerController::class, 'image'])->name('markers.image');
        Route::get('/penanda/{name}/pratinjau', [MarkerController::class, 'preview'])->name('markers.preview');
    });
});