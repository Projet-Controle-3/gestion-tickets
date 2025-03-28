@extends('layouts.app')

@section('content')

    <div class="container max-w-md p-4 mx-auto">

        <div class="p-8 my-8 border border-gray-700 shadow-2xl bg-gradient-to-br from-gray-800 to-gray-900 rounded-xl">

            {{-- Notification de succes --}}
            @if(session('success'))

                <div class="p-4 mb-6 text-green-100 border border-green-600 rounded-lg bg-green-800/80 backdrop-blur-sm"
                    role="alert">

                    <div class="flex items-center">

                        <svg class="w-5 h-5 mr-2 shrink-0" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>

                        <strong class="font-medium">Succès !</strong>

                    </div>

                    <div class="mt-2 text-sm">
                        {{ session('success') }}
                    </div>

                </div>

            @endif

            {{-- Titre de page Modifier l'utilisateur --}}
            <div class="flex items-center mb-8">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-3 text-blue-400" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>

                <h1 class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-blue-300">
                    Modifier l'utilisateur
                </h1>

            </div>

            {{-- Formulaires de modification de l'utilisateur --}}
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Champ Nom --}}
                <div class="mb-6">

                    <label for="nom" class="block mb-3 text-sm font-medium text-gray-300">Nom</label>

                    <input type="text" name="nom" id="nom" value="{{ $user->nom }}"
                        class="w-full px-4 py-3 text-white placeholder-gray-500 transition duration-200 bg-gray-800 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">

                </div>

                {{-- Champ Email --}}
                <div class="mb-6">

                    <label for="email" class="block mb-3 text-sm font-medium text-gray-300">Email</label>

                    <input type="email" name="email" id="email" value="{{ $user->email }}"
                        class="w-full px-4 py-3 text-white placeholder-gray-500 transition duration-200 bg-gray-800 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">

                </div>

                {{-- Selecteur de role --}}
                <div class="mb-6">

                    <label for="role" class="block mb-2 text-sm font-medium text-gray-300">Rôle</label>

                    <div class="relative">

                        <select name="role" id="role"
                            class="w-full p-3 text-white bg-gray-800 border border-gray-600 rounded-lg appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">

                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>
                                Admin
                            </option>

                            <option value="support" {{ $user->role === 'support' ? 'selected' : '' }}>
                                Support
                            </option>

                            <option value="utilisateur" {{ $user->role === 'utilisateur' ? 'selected' : '' }}>
                                Utilisateur
                            </option>

                        </select>

                        {{-- Icone selecteur --}}
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">

                            <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>

                        </div>

                    </div>
                </div>

                {{-- Button --}}
                <div class="flex justify-between pt-4 mt-6 border-t border-gray-700/50">

                    <a href="{{ route('users.index') }}"
                        class="flex items-center justify-center gap-2 px-6 py-3 text-gray-300 transition rounded-lg bg-gray-700/50 hover:bg-gray-700 hover:text-white group">

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 transition-transform group-hover:rotate-90">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>

                        Annuler

                    </a>

                    <button type="submit"
                        class="flex items-center justify-center gap-2 px-6 py-3 text-white transition rounded-lg shadow-lg bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-500 hover:to-blue-400 hover:shadow-blue-500/20">

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                        </svg>

                        Mettre à jour

                    </button>
                </div>

            </form>

        </div>

    </div>

@endsection