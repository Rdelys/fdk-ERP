<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

// Page d'accueil = login prospecteur
Route::get('/', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.attempt'); // ← nommée
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// --- ESPACE PROSPECTEUR ---
Route::middleware('auth')->prefix('prospecteur')->name('prospecteur.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Prospecteur\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('prospects', \App\Http\Controllers\Prospecteur\ProspectController::class);
    Route::get('/projets', [\App\Http\Controllers\Prospecteur\ProjectController::class, 'index'])->name('projets');
    Route::get('/parametres', [\App\Http\Controllers\Prospecteur\ParametreController::class, 'index'])->name('parametres');
    Route::post('/parametres', [\App\Http\Controllers\Prospecteur\ParametreController::class, 'update'])->name('parametres.update');
});

// --- ESPACE ADMIN ---
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.attempt'); // ← nommée
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::resource('projects', \App\Http\Controllers\Admin\ProjectController::class);
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    });
});