@extends('layouts.app')

@section('content')

    <div class="flex items-center justify-center min-h-[83vh] font-mono dark:bg-gray-900">

        <div
            class="w-full max-w-md p-8 border shadow-lg rounded-xl backdrop-blur-sm bg-white/80 dark:bg-gray-800/80 border-white/20">

            {{-- En tete --}}
            <div class="flex flex-col items-center mb-8">

                <div class="p-3 mb-4 rounded-full shadow-md bg-gradient-to-r from-blue-500 to-purple-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                </div>

                <h2
                    class="text-3xl font-bold text-center text-transparent bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text">
                    Inscription
                </h2>

                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Rejoignez notre communauté</p>
            </div>

            {{-- Notification de succes --}}
            @if(session('success'))
                <div
                    class="flex items-center p-4 mb-6 text-sm text-green-700 transition-all duration-300 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>

                    {{-- session de succès (Controller) --}}
                    <span>{{ session('success') }}</span>

                </div>
            @endif

            {{-- Formulaire d'inscription --}}
            <form method="POST" action="{{ route('register.submit') }}" class="space-y-5">
                @csrf

                {{-- Nom --}}
                <div>
                    <label for="name" class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Nom complet
                    </label>

                    <input type="text" name="nom" id="name" placeholder="Votre nom"
                        class="block w-full px-4 py-3 placeholder-gray-400 transition duration-200 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        required autofocus />
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Adresse Email
                    </label>

                    <input type="email" name="email" id="email" placeholder="votre@email.com"
                        class="block w-full px-4 py-3 placeholder-gray-400 transition duration-200 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        required />
                </div>

                {{-- Mot de passe --}}
                <div>
                    <label for="password" class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Mot de passe
                    </label>

                    <input type="password" name="password" id="password" placeholder="password"
                        class="block w-full px-4 py-3 placeholder-gray-400 transition duration-200 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        required />
                </div>

                {{-- Confirmation mot de passe --}}
                <div>
                    <label for="password_confirmation"
                        class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Confirmer le mot de passe
                    </label>

                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="password"
                        class="block w-full px-4 py-3 placeholder-gray-400 transition duration-200 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        required />
                </div>

                {{-- Bouton d'inscription --}}
                <div class="pt-2">
                    <button type="submit"
                        class="w-full px-6 py-3 text-lg font-medium text-white transition duration-200 rounded-lg shadow-md bg-gradient-to-r from-purple-500 to-blue-500 hover:from-purple-600 hover:to-blue-600 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                        S'inscrire
                    </button>
                </div>
            </form>

            {{-- Lien de connexion --}}
            <div class="mt-8 text-center">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Déjà inscrit ?
                    <a href="{{ route('login') }}"
                        class="font-medium text-purple-600 transition duration-150 hover:text-purple-500 dark:text-purple-400 dark:hover:text-purple-300">
                        Se connecter
                    </a>

                </p>

            </div>

        </div>

    </div>

@endsection