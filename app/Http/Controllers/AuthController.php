<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Utilisateur; // Utilisez le modèle Utilisateur
use PharIo\Manifest\Author;
use Illuminate\Support\Facades\File;;

class AuthController extends Controller
{
    // Afficher le formulaire de connexion
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Traiter la connexion
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
       //verifie si l'email s'existe dans la base de donne
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();

            //Recuperer l'utilisateur connecter
            $user = Auth::user();

            //Redericter les utilisateurs en fonction de son role
            switch ($user->role) {

                case 'admin':

                    return redirect()->route(Auth::user()->role.'.users.index');

                case 'support':

                    return redirect()->route(Auth::user()->role.'.tickets.index');

                case 'utilisateur':


                    return redirect()->route(Auth::user()->role.'.tickets.create');

                default:

                    return redirect('/');
            }
        }

        return back()->withErrors([
            'email' => 'Les identifiants fournis ne correspondent pas à nos enregistrements.',
        ]);
    }

    // Déconnexion
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}