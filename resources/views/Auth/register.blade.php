@extends('layouts.app')

@section('content')

    <style>
        .min-h-screen {
            min-height: 83vh;
        }
    </style>

    <div class="flex items-center justify-center min-h-screen font-mono dark:bg-gray-900">
        <div class="w-full max-w-md p-8 rounded-lg shadow-md bg-slate-100 scrollable-form">
            <h2 class="mb-6 text-2xl font-black text-center text-black">Inscription</h2>

            <!-- Formulaire d'inscription -->
            <form method="POST" action="{{ route('register.submit') }}">
                @csrf

                <!-- Nom -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-black">Nom</label>
                    <input type="text" name="nom" id="name"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-black focus:border-black"
                        required autofocus>
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-black">Email</label>
                    <input type="email" name="email" id="email"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-black focus:border-black"
                        required autofocus>
                </div>

                <!-- Mot de passe -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-black">Mot de passe</label>
                    <input type="password" name="password" id="password"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-black focus:border-black"
                        required autofocus>
                </div>

                <!-- Confirmation du mot de passe -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-black">Confirmer le mot de
                        passe</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-black focus:border-black"
                        required autofocus>
                </div>

                <!-- Rôle -->
                {{-- <div class="mb-6">
                    <label for="role" class="block text-sm font-medium text-black">Rôle</label>
                    <div class="relative">
                        <select name="role" id="role"
                            class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-black focus:border-black"
                            required autofocus>

                            <option value="utilisateur">Utilisateur</option>
                            <option value="support">Support</option>
                            <option value="admin">Administrateur</option>

                        </select>
                    </div>
                </div> --}}

                <!-- Bouton d'inscription -->
                <div>
                    <button type="submit"
                        class="w-full px-4 py-2 text-white bg-gray-800 rounded-md hover:bg-black focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2">
                        S'inscrire
                    </button>
                </div>
            </form>

            <!-- Lien vers la connexion -->
            <div class="mt-6 text-center">
                <p class="text-sm text-black">Déjà inscrit ? <a href="{{ route('login') }}"
                        class="text-gray-600 underline hover:text-gray-900">Connectez-vous</a></p>
            </div>
        </div>
    </div>
@endsection