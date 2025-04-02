<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Middleware\LocalizationMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', LocalizationMiddleware::class])->group(function () {
    // Page d'accueil
    Route::get('/', function () {
        return view('home');
    })->name('home');

    // Routes publiques pour l'authentification
    Route::middleware('guest')->group(function () {
        Route::get('/register', [UtilisateurController::class, 'showRegisterForm'])->name('register');
        Route::post('/register', [UtilisateurController::class, 'register'])->name('register.submit');
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    });

    // Déconnexion
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Routes protégées par authentification
    Route::middleware('auth')->group(function () {

        // Routes pour les utilisateurs
        Route::middleware('utilisateur')->group(function () {
            Route::resource('tickets', TicketController::class)->except(['index', 'show', 'edit', 'update', 'destroy']);
        });

        // Routes pour les admins
        Route::middleware('admin')->group(function () {
            Route::resource('users', UtilisateurController::class);
        });

        // Routes spécifiques au support
        Route::middleware('support')->group(function () {
            Route::resource('tickets', TicketController::class)->except(['create', 'store']);
            Route::resource('response', ResponseController::class);
        });
    });
});

// Changement de langue
Route::get('/locale/{lang}', function ($lang) {
    session(['lang' => $lang]);
    return redirect()->back();
})->name('locale.change');