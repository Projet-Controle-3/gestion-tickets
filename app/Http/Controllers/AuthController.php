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

                    return redirect()->route('users.index');

                case 'support':

                    return redirect()->route('tickets.index');

                case 'utilisateur':


                    return redirect()->route('tickets.create');

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
    
    public function editer()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }
    
    public function updater(Request $request)
    {
    $user = Auth::user();

    // Validation des données
    $request->validate([
        'nom' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Gestion de la photo
    $photoName = $user->photo; // Par défaut, conserver l'ancienne photo

    if ($request->hasFile('photo')) {
        if ($user->photo && file_exists(public_path('uploads/photos/' . $user->photo))) {
            unlink(public_path('uploads/photos/' . $user->photo));
        }

        // Sauvegarder la nouvelle photo
        $file = $request->file('photo');
        $photoName = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/photos'), $photoName);
    }

        $user->update([
            'nom' => $request->nom,
            'email' => $request->email,
            'photo' => $photoName,
        ]);

    return redirect()->route('profile.edit')->with('success', 'Profil mis à jour avec succès.');
}

    

}