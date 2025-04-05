@extends('layouts.app')

@section('content')

    <style>
        .right {
            right: calc(var(--spacing)* 40);
        }

        .right-s {
            right: calc(var(--spacing)* 60);
        }

        .mt {
            margin-top: calc(var(--spacing)* -7);
        }

        .mt-s {
            margin-top: calc(var(--spacing)* -9);
        }
    </style>

    <div class="container p-6 mx-auto">

        {{-- Titre --}}
        <div class="mb-8">

            <h1 class="text-3xl font-bold text-transparent bg-gradient-to-r from-blue-500 to-purple-600 bg-clip-text">
                Gestion des Utilisateurs
            </h1>

            <p class="mt-2 text-gray-500 dark:text-gray-400">Liste complète des utilisateurs du système</p>

        </div>

        {{-- Notification de succes --}}
        @if(session('success'))

            <div
                class="flex items-center p-4 mb-6 text-green-700 transition-all duration-300 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800">

                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd"></path>
                </svg>

                <div>

                    <strong class="font-medium">Succès !</strong>

                    <div class="mt-1 text-sm">
                        {{ session('success') }}
                    </div>

                </div>

            </div>
        @endif

        {{-- Carte principale --}}
        <div class="overflow-hidden bg-white shadow-md rounded-xl dark:bg-gray-800">


            <div class="flex items-center justify-between p-6 border-b bg-gray-50 dark:bg-gray-700 dark:border-gray-600">

                <div class="flex items-center">

                    <div
                        class="p-2 mr-3 rounded-lg bg-gradient-to-r from-blue-100 to-purple-100 dark:from-blue-900 dark:to-purple-900">

                        <svg class="w-6 h-6 text-blue-500 dark:text-blue-300" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>

                    </div>

                    <div>

                        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Utilisateurs</h2>

                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $users->count() }} utilisateurs enregistrés
                        </p>

                    </div>

                </div>

                <a href=""
                    class="px-4 py-2 text-sm font-medium text-white transition-colors duration-200 rounded-lg bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600">
                    + Nouvel utilisateur
                </a>

            </div>

            {{-- Liste des Utilisateurs --}}
            <div class="divide-y divide-gray-200 dark:divide-gray-700">

                @foreach($users as $user)

                    <div
                        class="flex items-center justify-between p-4 transition-colors duration-150 hover:bg-gray-50 dark:hover:bg-gray-700">

                        {{-- Info Utilisateur --}}
                        <div class="flex items-center flex-1 min-w-0">

                            {{-- Avatar avec badge de rôle --}}
                            <div class="relative flex-shrink-0 mr-4">


                                @if(Auth::user()->photo)
                                    
                                    <img class="w-8 h-8 rounded-full" src="{{ asset('uploads/photos/' . $user->photo) }}" alt="Photo de profil" class="rounded-circle" width="40" height="40">
                                    
                                    {{-- statut --}}
                                        <span class="absolute bottom-0 right-0 w-2.5 h-2.5 rounded-full border-2 border-white dark:border-gray-800
                                        
                                            @if($user->role === 'admin') bg-red-500

                                            @elseif($user->role === 'support') bg-yellow-500

                                            @else bg-green-500 @endif">

                                        </span>

                                    @else
                                    
                                    <!-- Si aucune photo, afficher une icône par défaut -->
                                    <div class="relative">
                                        
                                       <img class="w-10 h-10 rounded-full"
                                           src="{{ asset($user->profil) }}"
                                           alt="{{ $user->role }}" />

                                        
                                        {{-- statut --}}
                                        <span class="absolute bottom-0 right-0 w-2.5 h-2.5 rounded-full border-2 border-white dark:border-gray-800

                                            @if($user->role === 'admin') bg-red-500

                                            @elseif($user->role === 'support') bg-yellow-500

                                            @else bg-green-500 @endif">

                                        </span>

                                    </div>
                                                                   
                                @endif

                            </div>

                            

                            {{-- Details de l'utilisateur --}}
                            <div class="min-w-0">

                                <h3 class="text-sm font-medium text-gray-900 truncate dark:text-white">{{ $user->nom }}</h3>
                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">{{ $user->email }}</p>

                                {{-- Date de creation des comptes --}}
                                <div class="flex items-center mt-1 text-xs text-gray-400 dark:text-gray-500">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>

                                    <span title="Date de création du compte">
                                        Inscrit le {{ $user->created_at->format('d/m/Y') }}
                                        - {{ $user->created_at->diffForHumans() }}
                                    </span>

                                </div>

                            </div>

                        </div>

                        {{-- Actions --}}
                        <div class="flex items-center ml-4">
                            <!-- Badge de rôle -->
                            <span
                                class="px-3 py-1 text-xs font-medium rounded-full 

                                                                                    @if($user->role === 'admin') text-red-800 bg-red-100 dark:text-red-100 dark:bg-red-800

                                                                                    @elseif($user->role === 'support') text-yellow-800 bg-yellow-100 dark:text-yellow-100 dark:bg-yellow-800

                                                                                    @else text-green-800 bg-green-100 dark:text-green-100 dark:bg-green-800 @endif">

                                {{ ucfirst($user->role) }}

                            </span>

                            {{-- Menu deroulante avec details\summary --}}
                            <div class="relative ml-4">

                                <details class="group">

                                    <summary
                                        class="flex items-center justify-center w-8 h-8 list-none rounded-full cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-600">

                                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400 group-hover:text-gray-700 dark:group-hover:text-gray-300"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z">
                                            </path>
                                        </svg>

                                    </summary>

                                    <div
                                        class="absolute z-10 w-48 origin-top-right bg-white rounded-md shadow-lg right mt dark:bg-gray-800 ring-1 ring-black ring-opacity-5">

                                        {{-- Lien Modifier --}}
                                        <a href="{{ route(Auth::user()->role.'.users.edit', $user->id) }}"
                                            class="flex items-center px-10 py-2 text-sm text-gray-700 transition-colors dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>

                                            Modifier

                                        </a>

                                        {{-- Formulaires de suppression --}}
                                        <form action="{{ route(Auth::user()->role.'.users.destroy', $user->id)}}" method="POST"
                                            class="absolute z-10 w-48 origin-top-right bg-white rounded-md shadow-lg right-s mt-s dark:bg-gray-800 ring-1 ring-black ring-opacity-5">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="flex items-center w-full px-10 py-2 text-sm text-left text-red-600 transition-colors dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" viewBox="0 0 20 20"
                                                    fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                        clip-rule="evenodd" />
                                                </svg>

                                                Supprimer

                                            </button>

                                        </form>

                                    </div>

                                </details>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </div>

@endsection