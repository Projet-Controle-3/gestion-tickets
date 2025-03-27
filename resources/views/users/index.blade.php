@extends('layouts.app')

@section('content')

    <style>
        .right {
            right: calc(var(--spacing)* 40);
        }

        .right-s {
            right: calc(var(--spacing)* 80)
        }

        .mt {
            margin-top: calc(var(--spacing)* -7);
        }

        .mt-s {
            margin-top: calc(var(--spacing)* -7)
        }
    </style>
    <div class="container p-4 mx-auto">

        <!-- Titre -->
        <h1 class="mb-2 text-2xl font-bold text-white">Gestion des Utilisateurs</h1>
        <p class="mb-6 text-gray-400">Liste de tous les utilisateurs</p>

        <!-- Notification de succès -->
        @if(session('success'))
            <div class="p-4 mb-6 text-green-800 bg-green-100 border-l-4 border-green-500 rounded-lg dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
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

        <!-- Carte des utilisateurs -->
        <div class="overflow-hidden bg-gray-800 rounded-lg">

            <!-- En-tête -->
            <div class="flex items-center p-4 bg-gray-700 border-b border-gray-600">
                <svg class="w-6 h-6 mr-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>

                <h2 class="text-xl font-semibold text-white">Utilisateurs</h2>
                <span class="px-2 py-1 ml-2 text-xs text-gray-300 bg-gray-600 rounded-full">
                    {{ $users->count() }} utilisateurs
                </span>
            </div>

            <!-- Liste des utilisateurs -->
            <div class="divide-y divide-gray-700">
                @foreach($users as $user)
                    <div class="flex items-center justify-between p-4 hover:bg-gray-700">

                        <!-- Info utilisateur -->
                        <div class="flex items-center">

                            {{-- Avatar Avec Icon(admin , support) Cercle green (utilisateur) --}}
                            <div class="relative mr-4">
                                <img class="w-10 h-10 rounded-full"
                                    src="{{ asset('images/' . ($user->role === 'admin' ? 'admin.png' : ($user->role === 'support' ? 'support.png' : 'User.png'))) }}"
                                    alt="{{ $user->role }}">

                                @if($user->role === 'utilisateur')
                                    <span
                                        class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-gray-800 rounded-full">
                                    </span>
                                @endif
                                @if ($user->role === 'admin')
                                    <span class="absolute bottom-0 right-0 w-4 h-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                                        </svg>
                                    </span>
                                @endif
                                @if ($user->role === 'support')
                                    <span class="absolute bottom-0 right-0 w-4 h-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="yellow" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                                        </svg>
                                    </span>
                                @endif
                            </div>

                            <!-- Nom et email -->
                            <div>
                                <h3 class="font-medium text-white">{{ $user->nom }}</h3>
                                <p class="text-sm text-gray-400">{{ $user->email }}</p>
                            </div>
                        </div>

                        <!-- Rôle et actions -->
                        <div class="flex items-center">

                            {{-- Badge role --}}
                            @if ($user->role === 'admin')
                                <span class="px-3 py-1 mr-4 text-xs text-red-300 bg-red-900 rounded-full ">
                                    {{-- ucfirst dans php = capitalize dans tailwindCss --}}
                                    {{ ucfirst($user->role) }}
                                </span>
                            @elseif ($user->role === 'support')
                                <span class="px-3 py-1 mr-4 text-xs text-yellow-300 bg-yellow-900 rounded-full ">
                                    {{ ucfirst($user->role) }}
                                </span>
                            @else
                                {{-- <span class="px-3 py-1 mr-4 text-xs text-green-300 bg-green-900 rounded-full ">
                                    {{ ucfirst($user->role) }}
                                </span> --}}

                                <span class="px-3 py-1 mr-4 text-xs text-green-300 capitalize bg-green-900 rounded-full">
                                    {{ $user->role }}
                                </span>
                            @endif


                            <!-- Menu actions -->
                            <details class="relative group">

                                {{-- Élément SUMMARY (déclencheur du menu déroulant sans Javascript) --}}
                                <summary class="text-gray-400 list-none cursor-pointer hover:text-white focus:outline-none">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z">
                                        </path>
                                    </svg>
                                </summary>

                                {{-- Lien de Modifier --}}
                                <div
                                    class="absolute z-10 w-32 bg-gray-800 border border-gray-700 rounded-md shadow-lg right mt">
                                    <a href="{{ route('users.edit', $user->id) }}"
                                        class="flex items-center justify-center gap-2 px-4 py-2 text-sm text-green-300 hover:bg-gray-700 hover:text-green-200">
                                        <span>Modifier</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-4 h-4">
                                            <path
                                                d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                            <path
                                                d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                        </svg>
                                    </a>
                                </div>

                                <!-- Formulaire Supprimer -->
                                <form action="{{ route('users.destroy', $user->id)}}" method="POST"
                                    class="absolute z-10 w-32 bg-gray-800 border border-gray-700 rounded-md shadow-lg right-s mt-s">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="flex items-center justify-center gap-2 px-4 py-2 text-sm text-red-300 hover:text-red-200 hover:bg-gray-700"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                                        <span>Supprimer</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-4 h-4">
                                            <path fill-rule="evenodd"
                                                d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </form>

                            </details>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Partie code sans design --}}
    {{-- <table border="2" style="color: white;">
        <thead>
            <tr>
                <th>id</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{$user->id}} </td>
                <td>{{$user->nom}} </td>
                <td>{{$user->email}} </td>
                <td>{{$user->role}}</td>
                <td class="px-4 py-3 space-x-2 text-center">
                    <button type="submit"><a href="{{ route('users.edit', $user->id) }}">Modifier</a>

                        <!-- <select name="role" onchange="this.form.submit()">
                                                        <option value="utilisateur" {{ $user->role === 'utilisateur' ? 'selected' : '' }}>Utilisateur</option>
                                                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                                        <option value="support" {{ $user->role === 'support' ? 'selected' : '' }}>Support</option>
                                                    </select>
                                                -->
                    </button>
                    <button type="submit"><a href="http://127.0.0.1:8000/delete/{{$user->id}}">supprimer</a></button>
                </td>
                @endforeach
                </td>
            </tr>
            <br>
        </tbody>
    </table>
    --}}
@endsection