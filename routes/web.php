<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UtilController;
use App\Http\Controllers\StudioController;
use Illuminate\Support\Facades\Route;


Route::get('/', [UtilController::class, 'home'])->name('utils.home');
Route::fallback([UtilController::class, 'fallback']);

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard.index');

Route::get('/studios/create', [StudioController::class, 'create'])->name('studios.create')->middleware('auth');
Route::post('/studios', [StudioController::class, 'store'])->name('studios.store')->middleware('auth');
