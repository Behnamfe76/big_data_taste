<?php

use App\Http\Controllers\BigDataCachController;
use App\Http\Controllers\BigDataCacheController;
use App\Http\Controllers\BigDataCacheIndexController;
use App\Http\Controllers\BigDataController;
use App\Http\Controllers\BigDataIndexController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::resource('/ordinary-data', BigDataController::class)->middleware(['auth']);
Route::resource('/indexed-data', BigDataIndexController::class)->middleware(['auth']);
Route::resource('/cached-data', BigDataCacheController::class)->middleware(['auth']);
Route::resource('/cached-indexed-data', BigDataCacheIndexController::class)->middleware(['auth']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
