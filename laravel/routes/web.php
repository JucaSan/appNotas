<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NotasController;
use App\Http\Controllers\PerfilController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Invitados
|--------------------------------------------------------------------------
*/
Route::middleware(['guest.custom', 'prevent-back'])->group(function () {

    Route::controller(AuthController::class)->group(function () {
        Route::get('/', 'index')->name('login');
        Route::post('/login', 'login')->name('login.note');
        Route::get('/register', 'registerForm')->name('register');
        Route::post('/register', 'register')->name('register.note');
    });
});

/*
|--------------------------------------------------------------------------
| Autenticados
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'prevent-back'])->group(function () {

    Route::prefix('notes')->controller(NotasController::class)->group(function () {
        Route::get('/', 'index')->name('notes.index');
        Route::get('/create', 'create')->name('notes.create');
        Route::post('/', 'store')->name('notes.store');
        Route::get('/{id}', 'show')->name('notes.show');
        Route::get('/{id}/edit', 'edit')->name('notes.edit');
        Route::put('/{id}', 'update')->name('notes.update');
        Route::delete('/{id}', 'destroy')->name('notes.destroy');

        // Rutas adicionales
        Route::get('/{id}/export', 'export')->name('notes.export');
        Route::get('/{id}/sync', 'sync')->name('notes.sync');
    });

    /*
    |--------------------------------------------------------------------------
    | Perfil
    |--------------------------------------------------------------------------
    */
    Route::controller(PerfilController::class)->group(function () {
        Route::get('/profile', 'index')->name('profile');
        Route::post('/profile', 'updatePassword')->name('profile.update');
    });

    /*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------
    */
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});
