<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;



class UtilisateurController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:utilisateurs',
            'password' => 'required|min:6',
            // 'role' => 'required|in:admin,support,utilisateur',
        ]);

        Utilisateur::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // 'role' => $request->role,
        ]);

        return redirect()->route('register')->with('success', 'Inscription réussie ! Vous pouvez maintenant vous connecter.');
    }
    // afficher les utilisateurs dans le tableau
    function index()
    {
        $users = Utilisateur::all(); // Utilisez le même nom de variable
        return view('users.index', compact('users'));
    }

    //supprimer
    public function delete($id)
    {
        $users = Utilisateur::findOrFail($id);
        $users->delete();
        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès');
    }

    public function edit($id)
    {
        $user = Utilisateur::findOrFail($id);
        return view('users.edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        // Valider les données du formulaire
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'role' => 'required|in:admin,support,utilisateur', // Valider le rôle
        ]);

        // Trouver l'utilisateur par son ID
        $users = Utilisateur::find($id);

        // Mettre à jour les champs
        $users->update([
            'nom' => $request->nom,
            'email' => $request->email,
            'role' => $request->role
        ]);

        return redirect()->route('users.edit', $id)->with('success', 'Utilisateur mis à jour avec succès');
    }



}