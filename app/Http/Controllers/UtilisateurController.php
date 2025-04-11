<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
        $users = Utilisateur::all();
        return view('users.index', compact('users'));
    }

    //supprimer
    public function destroy($id)
    {
        $users = Utilisateur::findOrFail($id);
        $users->delete();
        return redirect()->route(Auth::user()->role.'.users.index')->with('success', 'Utilisateur supprimé avec succès');
    }

    public function edit($id)
    {
        $user = Utilisateur::findOrFail($id);
        return view('users.edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'role' => 'required|in:admin,support,utilisateur', // Valider le rôle
        ]);

        // Trouver l'utilisateur par son ID
        $users = Utilisateur::findOrFail($id);

        // Mettre à jour les champs
        $users->update([
            'nom' => $request->nom,
            'email' => $request->email,
            'role' => $request->role
        ]);

        return redirect()->route(Auth::user()->role.'.users.edit', $id)->with('success', 'Utilisateur mis à jour avec succès');
    }

    public function showProfile()
    {
        $user = Auth::user();
        return view('profile.profile', compact('user'));
    }
    
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
                
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|min:1024|max:5120',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->nom = $request->nom;
        $user->email = $request->email;
        
        if ($request->password) {
           $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('photo')) {
           
           if ($user->photo) {
            Storage::delete($user->photo);
           } 

           $date = date('Y-m-d_H-i-s');
           $originalName = $request->photo->getClientOriginalName();
           
           
           $fileName = $date . '_' . $originalName;
           $request->photo->storeAs('photos', $fileName, 'public');
           $user->photo = $fileName;
           
        }

        Utilisateur::where('id', $user->id)->update([
            'nom' => $user->nom,
            'email' => $user->email,
            'photo' => $user->photo,
            'password' => $user->password,
        ]);
        
        return back()->with('success', 'Profil mis à jour avec succès');

    } 

    public function deleteProfilePhoto($id)
    {

        $user = Utilisateur::findOrFail($id);

        if (Auth::id() !== $user->id) {
            abort(403);
        }

        if ($user->photo && Storage::disk('public')->exists('photos/' . $user->photo )) {
            
            Storage::disk('public')->delete('photos/' . $user->photo);

            $user->photo = null;
            $user->save();

            return back()->with('succes', 'Photo de profil supprimée avec succès');
        }

        return back()->with('error', 'Aucune photo de profil à supprimer');

    }
}