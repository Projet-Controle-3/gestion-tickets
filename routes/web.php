<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
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
        
        Route::prefix('profile')->group(function () {
            Route::get('/show', [UtilisateurController::class, 'showProfile'])->name('profile.show');
            Route::put('/edit', [UtilisateurController::class, 'updateProfile'])->name('profile.update');
            Route::delete('/photo/{id}', [UtilisateurController::class, 'deleteProfilePhoto'])->name('profile.photo.destroy');
        });
        
        // Routes pour les utilisateurs
        Route::middleware('utilisateur')->prefix('user')->name('utilisateur.')->group(function () {

            Route::get('/my-tickets', [TicketController::class, 'myTickets'])->name('tickets.my-tickets');
            Route::resource('comments', CommentController::class);
            Route::resource('tickets', TicketController::class)->except(['index' , 'edit', 'update', 'destroy']);

            // Pour annuler l'acces a le route de Post (POST : user/tickets)
            Route::get('tickets', function () {
                return redirect('/')->with('error', 'Accès direct non autorisé');
            });

        });

        // Routes pour les admins
        Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
            Route::resource('response', ResponseController::class);
            Route::resource('users', UtilisateurController::class);

        });

        // Routes spécifiques au support
        Route::middleware('support')->prefix('support')->name('support.')->group(function () {
                Route::patch('/tickets/{ticket}/statut', [TicketController::class, 'updateStatut'])->name('tickets.updateStatut');
                Route::resource('response', ResponseController::class);
                Route::resource('tickets', TicketController::class)->except(['create', 'store']);
        });
    });

// Changement de langue
Route::get('/locale/{lang}', function ($lang) {
    session(['lang' => $lang]);
    return redirect()->back();
})->name('locale.change');

});

Route::get('/phpinfo', function () {
    phpinfo();
});
