@extends('layouts.app')

@section('content')

    <div class="flex items-center justify-center min-h-[83vh]  font-mono dark:bg-gray-900">

        <div
            class="w-full max-w-md p-8 border shadow-lg rounded-xl backdrop-blur-sm bg-white/80 dark:bg-gray-800/80 border-white/20">

            {{-- En tete --}}
            <div class="flex flex-col items-center mb-8">
                <div class="p-3 mb-4 rounded-full shadow-md bg-gradient-to-r from-blue-500 to-purple-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>

                {{-- Button de connexion --}}
                <h2
                    class="text-3xl font-bold text-center text-transparent bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text">
                    Connexion
                </h2>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Accédez à votre espace personnel</p>
            </div>

            {{-- Formulaire de connexion --}}
            <form method="POST" action="{{ route('login.submit') }}" class="space-y-6">
                @csrf

                {{-- Champ Email --}}
                <div>
                    <label for="email" class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Adresse
                        Email</label>
                    <input type="email" name="email" id="email" placeholder="votre@email.com"
                        class="block w-full px-4 py-3 placeholder-gray-400 transition duration-200 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        required autofocus>
                </div>

                {{-- Champ Mot de passe --}}
                <div>
                    <label for="password" class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Mot de
                        passe</label>
                    <input type="password" name="password" id="password" placeholder="password"
                        class="block w-full px-4 py-3 placeholder-gray-400 transition duration-200 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        required>
                </div>

                {{-- Bouton de connexion avec degrade de couleur --}}
                <div>
                    <button type="submit"
                        class="w-full px-6 py-3 text-lg font-medium text-white transition duration-200 rounded-lg shadow-md bg-gradient-to-r from-purple-500 to-blue-500 hover:from-purple-600 hover:to-blue-600 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                        Se connecter
                    </button>
                </div>
            </form>

            {{-- Lien vers l'inscription --}}
            <div class="mt-8 text-center">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Pas encore de compte ?
                    <a href="{{ route('register') }}"
                        class="font-medium text-purple-600 transition duration-150 hover:text-purple-500 dark:text-purple-400 dark:hover:text-purple-300">
                        Créer un compte
                    </a>

                </p>

            </div>

        </div>

    </div>

@endsection