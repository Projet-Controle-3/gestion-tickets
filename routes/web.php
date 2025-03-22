<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Middleware\LocalizationMiddleware;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;





Route::middleware(LocalizationMiddleware::class)->group(function () {

    Route::get('/', function () {
        return view('home');
    })->name('home');

    // Inscription
    Route::get('/register', [UtilisateurController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [UtilisateurController::class, 'register'])->name('register.submit');

    // Connexion
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    // Déconnexion
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});




/* -------------------------------------------------------------------------- */
/*                   Route pour changer la langue via l'URL                   */
/* -------------------------------------------------------------------------- */
Route::get('/locale/{lang}', function ($lang) {
    session(['lang' => $lang]);
    return redirect()->back();
});



/* -------------------------------------------------------------------------- */
/*               Route pour changer la langue via un formulaire               */
/* -------------------------------------------------------------------------- */
Route::get('/locale', function (Request $request) {
    $lang = $request->query('lang');
    session(['lang' => $lang]);
    return redirect()->back();
});