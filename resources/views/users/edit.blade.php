@extends('layouts.app')

@section('content')
<!-- resources/views/users/update.blade.php -->

<form action="{{ route('users.update', $user->id) }}" method="POST" >

    @csrf
    @method('PUT')

    <!-- Champ pour le nom -->
    <div>
        <label for="nom" style="color: whitesmoke;">Nom:</label>
        <input type="text" name="nom" id="nom" value="{{ $user->nom }}" required style="color: whitesmoke;">
    </div>

    <!-- Champ pour l'email -->
    <div>
        <label for="email"style="color: whitesmoke;">Email:</label>
        <input type="email" name="email" id="email" value="{{ $user->email }}" required style="color: whitesmoke;">
    </div>

    <!-- Menu déroulant pour le rôle -->
    <div>
        <label for="role"style="color: whitesmoke";>Rôle:</label>
        <select name="role" id="role" required style="color: whitesmoke;">
            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }} >Admin</option>
            <option value="support" {{ $user->role === 'support' ? 'selected' : '' }} >Support</option>
            <option value="utilisateur" {{ $user->role === 'utilisateur' ? 'selected' : '' }} >Utilisateur</option>
        </select>
    </div>

    <!-- Bouton de soumission -->
    <div>
        <button type="submit" style="color: whitesmoke;">Mettre à jour</button>
    </div>
</form>

@endsection
