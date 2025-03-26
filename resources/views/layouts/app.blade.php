<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ticket System</title>
    <!-- Tailwind CSS via CDN (ou utilisez Vite pour une intégration locale) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .no-scroll {
            overflow: hidden;
            height: 100vh;
        }
    </style>
</head>

<body class="bg-gray-100 dark:bg-gray-900 font-mono @if(request()->routeIs(['login'])) no-scroll @endif">

    <!-- Barre de navigation -->
    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">

        <div class="px-3 py-3 lg:px-5 lg:pl-3">

            <div class="flex items-center justify-between">

                <div class="flex items-center justify-start rtl:justify-end">
                    <a href="/" class="flex ms-2 md:me-24">
                        <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">
                            Ticket System
                        </span>
                    </a>
                </div>

                <div class="flex items-center">
                    <!-- Lien de connexion (visible uniquement si l'utilisateur n'est pas connecté) -->
                    @guest
                        <a href="{{ route('login') }}"
                            class="mr-4 text-base text-gray-700 dark:text-gray-500 hover:text-blue-600 dark:hover:text-gray-200">
                            Connexion
                        </a>
                    @endguest

                    <!-- Menu utilisateur (visible uniquement si l'utilisateur est connecté) -->
                    @auth
                        <div class="flex items-center ms-3">
                            <div>
                                <button type="button"
                                    class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                                    aria-expanded="false" data-dropdown-toggle="dropdown-user">

                                    <span class="sr-only">Open user menu</span>

                                    <!-- Image de profil en fonction du rôle -->
                                    @if(auth()->user()->role === 'admin')
                                        <img class="w-10 h-10 rounded-full" src="{{ asset('images/admin.png') }}" alt="Admin">

                                    @elseif(auth()->user()->role === 'support')
                                        <img class="w-8 h-8 rounded-full" src="{{ asset('images/support.png') }}" alt="Support">

                                    @else
                                        <img class="w-8 h-8 rounded-full" src="{{ asset('images/User.png') }}"
                                            alt="Utilisateur">
                                    @endif
                                </button>
                            </div>
                            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-sm shadow-sm dark:bg-gray-700 dark:divide-gray-600"
                                id="dropdown-user">

                                <div class="px-4 py-3" role="none">
                                    <p class="text-sm text-gray-900 dark:text-white" role="none">
                                        {{ auth()->user()->nom }}
                                    </p>
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                        {{ auth()->user()->email }}
                                    </p>
                                    <p class="flex items-center gap-1 text-sm truncate font-extralight text-lime-300 dark:text-gray-500"
                                        role="none">

                                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                            fill="currentColor" class="size-6">
                                            <path fill-rule="evenodd"
                                                d="M11.097 1.515a.75.75 0 0 1 .589.882L10.666 7.5h4.47l1.079-5.397a.75.75 0 1 1 1.47.294L16.665 7.5h3.585a.75.75 0 0 1 0 1.5h-3.885l-1.2 6h3.585a.75.75 0 0 1 0 1.5h-3.885l-1.08 5.397a.75.75 0 1 1-1.47-.294l1.02-5.103h-4.47l-1.08 5.397a.75.75 0 1 1-1.47-.294l1.02-5.103H3.75a.75.75 0 0 1 0-1.5h3.885l1.2-6H5.25a.75.75 0 0 1 0-1.5h3.885l1.08-5.397a.75.75 0 0 1 .882-.588ZM10.365 9l-1.2 6h4.47l1.2-6h-4.47Z"
                                                clip-rule="evenodd" />
                                        </svg>


                                        {{ auth()->user()->role }}
                                    </p>
                                </div>

                                <ul class="py-1" role="none">
                                    <li>
                                        <a href="#"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                            role="menuitem">Profil</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                            role="menuitem">Paramètres</a>
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit"
                                                class="block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                                role="menuitem">Déconnexion</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    @include('layouts.sidebar')

    <!-- Main Content -->
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
</body>

</html>