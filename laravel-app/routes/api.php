<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SettingsController;

Route::get('/team', [TeamController::class, 'index']);
Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/{project}', [ProjectController::class, 'show']);
Route::get('/settings', [SettingsController::class, 'index']);
Route::get('/stats', [SettingsController::class, 'stats']);
Route::post('/contact', [ContactController::class, 'store']);
