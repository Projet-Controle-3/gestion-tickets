@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center min-h-screen font-mono dark:bg-gray-900">
        <div class="w-full max-w-md p-8 rounded-lg shadow-md bg-slate-100">
            <h2 class="mb-6 text-2xl font-bold text-center text-black">Connexion</h2>

            <!-- Formulaire de connexion -->
            <form method="POST" action="{{ route('login.submit') }}">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-black">Email</label>
                    <input type="email" name="email" id="email"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-black focus:border-black"
                        required autofocus>
                </div>

                <!-- Mot de passe -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-black">Mot de passe</label>
                    <input type="password" name="password" id="password"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-black focus:border-black"
                        required>
                </div>

                <!-- Bouton de connexion -->
                <div>
                    <button type="submit"
                        class="w-full px-4 py-2 text-white bg-gray-800 rounded-md hover:bg-black focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2">
                        Se connecter
                    </button>
                </div>
            </form>

            <!-- Lien vers l'inscription -->
            <div class="mt-6 text-center">
                <p class="text-sm text-black">Pas encore de compte ? <a href="{{ route('register') }}"
                        class="text-black underline hover:text-gray-800">Inscrivez-vous</a></p>
            </div>
        </div>
    </div>
@endsection