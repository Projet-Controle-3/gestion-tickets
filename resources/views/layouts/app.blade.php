<!DOCTYPE html>
<html lang="fr" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ticket System</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css'])
    <style>
        .no-scroll {
            overflow: hidden;
            height: 100vh;
        }
    </style>

</head>

<body class="bg-gray-50 font-mono dark:bg-gray-900 min-h-full @if(request()->routeIs(['login'])) no-scroll @endif">

    {{-- barre de navigation --}}
    <nav
        class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <div class="px-4 py-3 lg:px-6">
            <div class="flex items-center justify-between">

                {{-- Logo et titre --}}
                <div class="flex items-center">
                    <a href="/" class="flex items-center">

                        <svg class="w-8 h-8 mr-2 text-blue-600 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="M1.5 6.375c0-1.036.84-1.875 1.875-1.875h17.25c1.035 0 1.875.84 1.875 1.875v3.026a.75.75 0 0 1-.375.65 2.249 2.249 0 0 0 0 3.898.75.75 0 0 1 .375.65v3.026c0 1.035-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 0 1 1.5 17.625v-3.026a.75.75 0 0 1 .374-.65 2.249 2.249 0 0 0 0-3.898.75.75 0 0 1-.374-.65V6.375Zm15-1.125a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-1.5 0V6a.75.75 0 0 1 .75-.75Zm.75 4.5a.75.75 0 0 0-1.5 0v.75a.75.75 0 0 0 1.5 0v-.75Zm-.75 3a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-1.5 0v-.75a.75.75 0 0 1 .75-.75Zm.75 4.5a.75.75 0 0 0-1.5 0V18a.75.75 0 0 0 1.5 0v-.75ZM6 12a.75.75 0 0 1 .75-.75H12a.75.75 0 0 1 0 1.5H6.75A.75.75 0 0 1 6 12Zm.75 2.25a.75.75 0 0 0 0 1.5h3a.75.75 0 0 0 0-1.5h-3Z" clip-rule="evenodd" />
                        </svg>

                        <span class="self-center text-2xl font-bold text-gray-800 whitespace-nowrap dark:text-white">

                            <span class="text-transparent bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text">
                                Ticket
                            </span>
                            System

                        </span>

                    </a>
                </div>


                <div class="flex items-center space-x-4">

                    {{-- Bouton de connexion --}}
                    @auth
                        <div class="relative group">
                            <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:outline-none"
                                id="user-menu-button">

                                {{-- Image de profil en fonction de role --}}
                                <div class="relative">

                                    <img class="w-8 h-8 rounded-full"
                                        src="{{ asset(auth()->user()->profil) }}"
                                        alt="{{ auth()->user()->role }}" />


                                    @if(Auth::check() && Auth::user()->photo)
                                            
                                        <img  class="w-10 h-10 rounded-full" src="{{ asset('uploads/photos/' . Auth::user()->photo) }}" alt="Photo de profil" class="rounded-circle" width="40" height="40" 
                                        />
                                        {{-- statut --}}
                                        <span class="absolute bottom-0 right-0 w-2.5 h-2.5 rounded-full border-2 border-white dark:border-gray-800

                                            @if(auth()->user()->role === 'admin') bg-red-500

                                            @elseif(auth()->user()->role === 'support') bg-yellow-500

                                            @else bg-green-500 @endif">

                                        </span>
                                            
                                        @else
                                
                                        <div class="relative">
                                                
                                            <img class="w-8 h-8 rounded-full"
                                                    src="{{ asset('images/' . (auth()->user()->role === 'admin' ? 'admin.png' : (auth()->user()->role === 'support' ? 'support.png' : 'User.png'))) }}"
                                                    alt="{{ auth()->user()->role }}" />

                                            
                                                    {{-- statut --}}
                                            <span class="absolute bottom-0 right-0 w-2.5 h-2.5 rounded-full border-2 border-white dark:border-gray-800

                                                @if(auth()->user()->role === 'admin') bg-red-500

                                                @elseif(auth()->user()->role === 'support') bg-yellow-500

                                                @else bg-green-500 @endif">

                                            </span>

                                        </div>

                                    @endif

                                </div>
                                
                            </button>

                            {{-- Menu deroulante --}}
                            <div
                                class="absolute right-0 z-10 hidden w-48 py-1 mt-2 bg-white rounded-md shadow-lg dark:bg-gray-800 ring-1 ring-black ring-opacity-5 group-hover:block group-focus-within:block">

                                {{-- Nom et email --}}
                                <div class="px-4 py-3">

                                    <p class="text-sm text-gray-900 dark:text-white">
                                        {{ auth()->user()->nom }}
                                    </p>
                                    <p class="text-sm font-medium text-gray-500 truncate dark:text-gray-300">
                                        {{ auth()->user()->email }}
                                    </p>

                                    {{-- Role --}}
                                    <span class="inline-flex items-center px-2.5 py-0.5 mt-1 text-xs font-medium rounded-full

                                        @if(auth()->user()->role === 'admin') text-red-800 bg-red-100 dark:text-red-100 dark:bg-red-800

                                        @elseif(auth()->user()->role === 'support') text-yellow-800 bg-yellow-100 dark:text-yellow-100 dark:bg-yellow-800

                                        @else text-green-800 bg-green-100 dark:text-green-100 dark:bg-green-800 @endif">

                                        {{-- role avec la premiere lettre majiscule --}}
                                        {{ ucfirst(auth()->user()->role) }}

                                    </span>

                                </div>

                                {{-- Liens du menu --}}
                                <a href="{{ route('profile.edit') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                                    Profil
                                </a>
                                <!-- <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                                    Paramètres
                                </a> -->

                                {{-- Form de deconnexion --}}
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                                        Déconnexion
                                    </button>
                                </form>

                            </div>
                        </div>
                    @else

                        {{-- Lien de connexion --}}
                        <a href="{{ route('login') }}"
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Connexion
                        </a>

                    @endauth

                </div>

            </div>

        </div>

    </nav>

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    {{-- Main content --}}
    <main class="min-h-screen p-4 pt-16 sm:ml-64">
        <div class="p-4 rounded-lg">
            @yield('content')
        </div>
    </main>

</body>

</html>
