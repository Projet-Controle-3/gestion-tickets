<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;
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

    Route::middleware('auth')->group(function () {

        // Partie Liste des Ticket (Zouhir)
        Route::get('/tickets', function () {
            return view('tickets.index');
        })->name('tickets.index');



        // Partie Creation des Ticket (Fahd)
        Route::resource('tickets', TicketController::class);



        // Partie Details d'un Ticket (Fahd)




        // Partie Reponse aux Tickets (Aymane)
        Route::get('/tickets/response', function () {
            return view('tickets.response');
        })->name('tickets.response');



        // Partie Mes Tickets (Aymane)
        Route::get('/tickets/my-tickets', function () {
            return view('tickets.my-tickets');
        })->name('tickets.my-tickets');



        // Gestion des Utilisateurs (ilyass)
        //route pour afficher la listes des utilisateurs
        Route::get('/users', [UtilisateurController::class, 'index'])->name('users.index');
       // Route pour modifier le role

       Route::get('/users/{id}/edit', [UtilisateurController::class, 'edit'])->name('users.edit');

       Route::put('/users/{id}', [UtilisateurController::class, 'update'])->name('users.update');

        //route pour suprrimer
        Route::get('/delete/{id}', [UtilisateurController::class, 'delete']);
    });

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
