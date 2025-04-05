<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket System - Plateforme de gestion de tickets</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
</head>

<body class="min-h-screen font-mono text-gray-100 bg-gradient-to-br from-gray-900 to-gray-800">
    <div class="container px-4 mx-auto">
        <!-- En-tête -->
        <header class="py-6">
            <div
                class="flex items-center justify-between p-4 border shadow-sm bg-white/10 backdrop-blur-sm rounded-xl border-white/10 ">
                <!-- Logo -->
                <a href="/" class="flex items-center gap-2">
                    <svg class="w-8 h-8 mr-2 text-blue-600 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M1.5 6.375c0-1.036.84-1.875 1.875-1.875h17.25c1.035 0 1.875.84 1.875 1.875v3.026a.75.75 0 0 1-.375.65 2.249 2.249 0 0 0 0 3.898.75.75 0 0 1 .375.65v3.026c0 1.035-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 0 1 1.5 17.625v-3.026a.75.75 0 0 1 .374-.65 2.249 2.249 0 0 0 0-3.898.75.75 0 0 1-.374-.65V6.375Zm15-1.125a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-1.5 0V6a.75.75 0 0 1 .75-.75Zm.75 4.5a.75.75 0 0 0-1.5 0v.75a.75.75 0 0 0 1.5 0v-.75Zm-.75 3a.75.75 0 0 1 .75.75v.75a.75.75 0 0 1-1.5 0v-.75a.75.75 0 0 1 .75-.75Zm.75 4.5a.75.75 0 0 0-1.5 0V18a.75.75 0 0 0 1.5 0v-.75ZM6 12a.75.75 0 0 1 .75-.75H12a.75.75 0 0 1 0 1.5H6.75A.75.75 0 0 1 6 12Zm.75 2.25a.75.75 0 0 0 0 1.5h3a.75.75 0 0 0 0-1.5h-3Z"
                            clip-rule="evenodd" />
                    </svg>
                    <span
                        class="text-2xl font-bold text-transparent bg-gradient-to-r from-blue-400 to-purple-500 bg-clip-text">Ticket
                        System</span>
                </a>

                <!-- Navigation -->
                <nav class="flex items-center gap-4">
                    @auth
                        <!-- Profil utilisateur -->
                        <div class="flex items-center gap-3">
                            <div class="relative">
                                <!-- <img class="w-10 h-10 border-2 rounded-full border-white/30"
                                    src="{{ asset('images/' . (Auth::user()->role === 'admin' ? 'admin.png' : (Auth::user()->role === 'support' ? 'support.png' : 'user.png'))) }}"
                                    alt="{{ Auth::user()->name }}"
                                    onerror="this.src='{{ asset('images/default-avatar.png') }}'">

                                <!-- Badge de rôle -->
                                <!-- <span>
                                    class="absolute -bottom-1 -right-1 flex items-center justify-center w-5 h-5 rounded-full border-2 border-white/30
                                                                                                                                                                                                                                                        @if(Auth::user()->role === 'admin') bg-red-500
                                                                                                                                                                                                                                                        @elseif(Auth::user()->role === 'support') bg-yellow-500
                                                                                                                                                                                                                                                        @else bg-green-500 @endif">
                                </span> -->
                                  <!-- Vérifie si l'utilisateur a une photo de profil -->
                   @if(Auth::check() && Auth::user()->photo)
                         <img src="{{ asset('uploads/photos/' . Auth::user()->photo) }}" alt="Photo de profil" class="rounded-circle" width="40" height="40">
                    @else
                                <!-- Si aucune photo, afficher une icône par défaut -->
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
                        @endif
                            </div>

                            <div class="hidden md:block">
                                <p class="text-sm font-medium">{{ Auth::user()->name }}</p>
                                <span
                                    class="text-xs px-2 py-0.5 rounded-full 
                                                                                                                                                                                                                                                        @if(Auth::user()->role === 'admin') bg-red-900/50 text-red-100
                                                                                                                                                                                                                                                        @elseif(Auth::user()->role === 'support') bg-yellow-900/50 text-yellow-100
                                                                                                                                                                                                                                                        @else bg-green-900/50 text-green-100 @endif">
                                    {{ ucfirst(Auth::user()->role) }}
                                </span>
                            </div>
                        </div>

                        <!-- Bouton Déconnexion -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="px-4 py-2 text-sm font-medium text-white transition-all duration-200 rounded-lg shadow-md bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700">
                                Déconnexion
                            </button>
                        </form>
                    @else
                        <!-- Boutons Connexion/Inscription -->
                        <div class="flex gap-3">
                            <a href="{{ route('login') }}"
                                class="px-4 py-2 text-sm font-medium text-white transition-all duration-200 rounded-lg shadow-md bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700">
                                Connexion
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="px-4 py-2 text-sm font-medium text-white transition-all duration-200 rounded-lg shadow-md bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700">
                                    Inscription
                                </a>
                            @endif
                        </div>
                    @endauth
                </nav>
            </div>
        </header>

        <!-- Contenu principal -->
        <main class="my-8">
            <div
                class="overflow-hidden border shadow-2xl rounded-xl bg-gradient-to-br from-gray-800/50 to-gray-900/50 backdrop-blur-sm border-white/10">
                <!-- Hero Section -->
                <div class="flex flex-col items-center p-8 text-center md:p-12 lg:flex-row lg:text-left">
                    <div class="lg:w-1/2 lg:pr-8">
                        <h1 class="mb-6 font-bold leading-tight text-8xl md:text-5xl">
                            <span
                                class="text-transparent bg-gradient-to-r from-blue-400 to-purple-500 bg-clip-text">Gérez
                                vos tickets</span><br>
                            en toute simplicité
                        </h1>
                        <p class="mb-8 text-gray-300 text-md">
                            Ticket System est la solution idéale pour suivre et résoudre les problèmes techniques
                            Une interface intuitive pour les utilisateurs et les équipes de support
                        </p>

                        <div
                            class="flex flex-col justify-center space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4 lg:justify-start">
                            @auth
                                @if (Auth::user()->role === 'utilisateur')
                                    <a href="{{ route('tickets.create') }}"
                                        class="px-6 py-3 font-medium text-gray-900 transition-all duration-200 rounded-lg shadow-md bg-gradient-to-r from-gray-100 to-white hover:from-gray-200 hover:to-gray-100 hover:shadow-lg">
                                        Créer un ticket
                                    </a>
                                @elseif (Auth::user()->role === 'admin')
                                    <a href="{{ route('users.index') }}"
                                        class="px-6 py-3 font-medium text-white transition-all duration-200 rounded-lg shadow-md bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 hover:shadow-lg">
                                        Voir les utilisateurs
                                    </a>
                                @elseif (Auth::user()->role === 'support')
                                    <a href="{{ route('tickets.index') }}"
                                        class="px-6 py-3 font-medium text-white transition-all duration-200 rounded-lg shadow-md bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 hover:shadow-lg">
                                        Voir les tickets
                                    </a>
                                @endif
                            @else
                                <a href="{{ route('login') }}"
                                    class="px-6 py-3 font-medium text-white transition-all duration-200 rounded-lg shadow-md bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 hover:shadow-lg">
                                    Commencer
                                </a>
                                <a href="{{ route('register') }}"
                                    class="px-6 py-3 font-medium text-gray-900 transition-all duration-200 rounded-lg shadow-md bg-gradient-to-r from-gray-100 to-white hover:from-gray-200 hover:to-gray-100 hover:shadow-lg">
                                    Créer un compte
                                </a>
                            @endauth
                        </div>
                    </div>

                    <div class="mt-8 lg:mt-0 lg:w-1/2">
                        <img src="{{ asset('images/home.png') }}" alt="Illustration Ticket System"
                            class="w-64 h-64 mx-auto animate__animated animate__pulse animate__infinite">
                    </div>
                </div>

                <!-- Features -->
                <div class="grid grid-cols-1 gap-6 p-8 bg-gray-900/50 md:grid-cols-2 lg:grid-cols-3">
                    <div class="p-6 rounded-lg bg-gray-800/50">
                        <div class="flex items-center mb-4">
                            <div class="p-2 mr-4 rounded-full bg-blue-500/20">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold">Suivi en temps réel</h3>
                        </div>
                        <p class="text-gray-400">Visualisez l'état de vos tickets et recevez des réponses en temps
                            réel</p>
                    </div>

                    <div class="p-6 rounded-lg bg-gray-800/50">
                        <div class="flex items-center mb-4">
                            <div class="p-2 mr-4 rounded-full bg-purple-500/20">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-purple-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold">Gestion simple</h3>
                        </div>
                        <p class="text-gray-400">Interface intuitive pour créer et gérer vos tickets facilement</p>
                    </div>

                    <div class="p-6 rounded-lg bg-gray-800/50">
                        <div class="flex items-center mb-4">
                            <div class="p-2 mr-4 rounded-full bg-green-500/20">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold">Multi-rôles</h3>
                        </div>
                        <p class="text-gray-400">Système de rôles pour administrateurs, support et utilisateurs</p>
                    </div>
                </div>
            </div>
        </main>

        <!-- Pied de page -->
        <footer class="py-6 text-center text-gray-400">
            <p> Ticket System | DEVOWFS202 </p>
            <p> Aymane Najibi | Fahd el yakhlifi | ilyass el oubadi | zouhir aitderb </p>
        </footer>
    </div>
</body>

</html>