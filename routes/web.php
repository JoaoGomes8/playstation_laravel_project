<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UtilController;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;

// ROTAS PÚBLICAS
Route::get('/', [UtilController::class, 'home'])->name('utils.home');


// ROTAS PROTEGIDAS (Só entram utilizadores com Login)
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/studios/create', [StudioController::class, 'create'])->name('studios.create');
    Route::post('/studios', [StudioController::class, 'store'])->name('studios.store');
    Route::get('/studios/{id}', [StudioController::class, 'show'])->name('studios.show');
    Route::get('/studios/{id}/edit', [StudioController::class, 'edit'])->name('studios.edit');
    Route::put('/studios/{id}', [StudioController::class, 'update'])->name('studios.update');
    Route::delete('/studios/{id}', [StudioController::class, 'destroy'])->name('studios.destroy');

    Route::get('/games/create', [GameController::class, 'create'])->name('games.create');
    Route::post('/games', [GameController::class, 'store'])->name('games.store');
    Route::delete('/games/{id}', [GameController::class, 'destroy'])->name('games.destroy');
    Route::get('/games/{id}/edit', [GameController::class, 'edit'])->name('games.edit');
    Route::put('/games/{id}', [GameController::class, 'update'])->name('games.update');
});

Route::fallback([UtilController::class, 'fallback']);
