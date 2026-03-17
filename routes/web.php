<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UtilController;
use Illuminate\Support\Facades\Route;


Route::get('/', [UtilController::class, 'home'])->name('utils.home');
Route::fallback([UtilController::class, 'fallback']);
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard.index');
