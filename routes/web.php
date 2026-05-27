<?php

use App\Http\Controllers\Admin\MatchResultController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\PredictionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RankingController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect()->route('matches.index');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('matches.index');
    })->name('dashboard');

    Route::get('/partidas', [MatchController::class, 'index'])->name('matches.index');
    Route::post('/partidas/{match}/palpite', [PredictionController::class, 'upsert'])->name('predictions.upsert');

    Route::get('/ranking', [RankingController::class, 'index'])->name('ranking.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/partidas', [MatchResultController::class, 'index'])->name('matches.index');
        Route::patch('/partidas/{match}', [MatchResultController::class, 'update'])->name('matches.update');
    });
});

require __DIR__.'/auth.php';

