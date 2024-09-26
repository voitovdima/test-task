<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RegistrationController::class, 'showRegistrationForm']);
Route::post('/register', [RegistrationController::class, 'register'])->name('register.link');

Route::get('/special/{link}', [DashboardController::class, 'showSpecialPage'])->name('dashboard');
Route::post('/special/{link}/regenerate', [DashboardController::class, 'regenerateLink'])->name('regenerate.link');
Route::post('/special/{link}/deactivate', [DashboardController::class, 'deactivateLink'])->name('deactivate.link');
Route::post('/special/{link}/imfeelinglucky', [DashboardController::class, 'imFeelingLucky'])->name('imfeelinglucky');
Route::get('/special/{link}/history', [DashboardController::class, 'showHistory'])->name('history');
