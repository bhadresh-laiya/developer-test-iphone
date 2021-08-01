<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AchievementsController;

Route::get('/users/{user}/achievements', [AchievementsController::class, 'index']);
Route::get('/users/{user}/achievementunlock', [AchievementsController::class, 'achievementUnlocked']); // added by bhadresh laiya
Route::get('/users/{user}/badgeunlock', [AchievementsController::class, 'badgeUnlock']);  // added by bhadresh laiya
