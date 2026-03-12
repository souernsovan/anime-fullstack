<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\EpisodeController;



Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});



Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

});

// Blade admin routes

Route::prefix('admin')->name('animes.')->group(function () {

    // List all anime
    Route::get('animes', [AnimeController::class, 'webIndex'])->name('index');

    // Create new anime
    Route::get('animes/create', [AnimeController::class, 'create'])->name('create');
    Route::post('animes', [AnimeController::class, 'store'])->name('store');

    // Edit anime
    Route::get('animes/{id}/edit', [AnimeController::class, 'edit'])->name('edit');
    Route::put('animes/{id}', [AnimeController::class, 'update'])->name('update');

    // Delete anime
    Route::delete('animes/{id}', [AnimeController::class, 'destroy'])->name('destroy');

});

// ---------------- Episode Admin ----------------
Route::prefix('admin')->name('episodes.')->group(function () {
    Route::get('episodes', [EpisodeController::class, 'webIndex'])->name('index');
    Route::get('episodes/create', [EpisodeController::class, 'create'])->name('create');
    Route::post('episodes', [EpisodeController::class, 'store'])->name('store');
    Route::get('episodes/{id}/edit', [EpisodeController::class, 'edit'])->name('edit');
    Route::put('episodes/{id}', [EpisodeController::class, 'update'])->name('update');
    Route::delete('episodes/{id}', [EpisodeController::class, 'destroy'])->name('destroy');
});

