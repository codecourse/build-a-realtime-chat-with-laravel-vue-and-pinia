<?php

use App\Http\Controllers\MessageIndexController;
use App\Http\Controllers\MessageStoreController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomShowController;
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

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/rooms/{room:slug}', RoomShowController::class)
        ->middleware(['auth', 'verified'])->name('room.show');

Route::get('/rooms/{room:slug}/messages', MessageIndexController::class)
    ->middleware(['auth', 'verified'])->name('room.show.messages');

Route::post('/rooms/{room:slug}/messages', MessageStoreController::class)
    ->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
