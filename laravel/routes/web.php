<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Route;


Route::middleware(['guest.custom', 'prevent-back'])->group(function () {
    // Rutas register
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.note');

    // Rutas login
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.note');
});


// Rutas notas
Route::middleware(['auth', 'prevent-back'])->group(function() {
    Route::resource('notes', NotesController::class);
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'updatePassword'])->name('profile.update');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});