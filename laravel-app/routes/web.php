<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DonationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/donations', function () {
    return view('admin');
});

// Explicit API-style routes so /api/* works reliably in production
Route::prefix('api')->group(function () {
    Route::get('/team', [TeamController::class, 'index']);
    Route::get('/projects', [ProjectController::class, 'index']);
    Route::get('/projects/{project}', [ProjectController::class, 'show']);
    Route::get('/settings', [SettingsController::class, 'index']);
    Route::get('/stats', [SettingsController::class, 'stats']);
    Route::get('/donations', [DonationController::class, 'index']);
    Route::post('/donations', [DonationController::class, 'store']);
    Route::post('/contact', [ContactController::class, 'store']);
});
