<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket System</title>
    <!-- Tailwind CSS via CDN -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Animation CSS (via CDN) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
</head>

<body class="flex flex-col items-center min-h-screen p-6 font-mono text-gray-900 bg-gray-100 lg:p-8 lg:justify-center">
    <!-- Header avec boutons de connexion/déconnexion -->
    <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6">
        <nav class="flex items-center justify-end gap-4">
            @if (Route::has('login'))
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="px-5 py-1.5 text-gray-900 border border-gray-400 rounded-sm text-sm transition duration-300 hover:bg-gray-200 hover:shadow-sm">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="px-5 py-1.5 text-gray-900 border border-gray-400 rounded-sm text-sm transition duration-300 hover:bg-gray-200 hover:shadow-sm">
                        Login
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="px-5 py-1.5 text-gray-900 border border-gray-400 rounded-sm text-sm transition duration-300 hover:bg-gray-200 hover:shadow-sm">
                            Register
                        </a>
                    @endif
                @endauth
            @endif
        </nav>
    </header>

    <!-- Conteneur principal -->
    <div class="flex flex-col items-center w-full transition-opacity opacity-100 duration-750">
        <!-- Logo en haut -->
        <div
            class="bg-white rounded-t-lg w-full lg:max-w-4xl max-w-[335px] p-6 flex items-center justify-center shadow-md">
            <img src="https://static.vecteezy.com/system/resources/previews/028/101/204/non_2x/support-ticket-icon-free-vector.jpg"
                alt="Logo du projet" class="w-32 h-32 animate__animated animate__pulse animate__infinite">
        </div>

        <!-- Carte en noir -->
        <div class="bg-black text-white shadow-md rounded-b-lg w-full lg:max-w-4xl max-w-[335px] p-6">

            <h1 class="mb-4 text-2xl font-bold text-center">Bienvenue sur Ticket System</h1>
            <p class="mb-6 text-center text-gray-300">
                Ticket System est une plateforme de gestion de tickets pour les équipes de support et les utilisateurs.
                Créez, suivez et résolvez vos tickets en toute simplicité.
            </p>

            <ul class="flex flex-col mb-6 lg:mb-8">
                <li class="flex items-center gap-4 py-2">
                    <span class="w-3.5 h-3.5 bg-gray-500 rounded-full"></span>
                    Créez des tickets pour signaler des problèmes.
                </li>
                <li class="flex items-center gap-4 py-2">
                    <span class="w-3.5 h-3.5 bg-gray-500 rounded-full"></span>
                    Suivez l'état de vos tickets en temps réel.
                </li>
            </ul>

            <div class="text-center">
                @auth
                    @if (Auth::user()->role === 'utilisateur')
                        <a href="{{ route('tickets.create') }}"
                            class="inline-block px-5 py-2 text-sm text-black transition duration-300 bg-white rounded-md hover:bg-gray-300 hover:shadow-sm">
                            Commencer
                        </a>
                    @elseif (Auth::user()->role === 'admin')
                        <a href="{{ route('users.index') }}"
                            class="inline-block px-5 py-2 text-sm text-black transition duration-300 bg-white rounded-md hover:bg-gray-300 hover:shadow-sm">
                            Commencer
                        </a>
                    @elseif (Auth::user()->role === 'support')
                        <a href="{{ route('tickets.index') }}"
                            class="inline-block px-5 py-2 text-sm text-black transition duration-300 bg-white rounded-md hover:bg-gray-300 hover:shadow-sm">
                            Commencer
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}"
                        class="inline-block px-5 py-2 text-sm text-black transition duration-300 bg-white rounded-md hover:bg-gray-300 hover:shadow-sm">
                        Commencer
                    </a>
                @endauth
            </div>
        </div>
    </div>
</body>

</html>