@extends('layouts.app')

@section('content')
    <div class="container max-w-md p-6 mx-auto">

        <!-- Notification de succès -->
        @if(session('success'))
            <div class="p-4 mb-6 text-green-800 bg-green-100 border-l-4 border-green-500 rounded-lg dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
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

        <div class="p-6 bg-gray-800 rounded-lg shadow-md">
            <h1 class="mb-6 text-2xl font-bold text-white">Modifier l'utilisateur</h1>

            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Champ Nom -->
                <div class="mb-4">
                    <label for="nom" class="block mb-2 text-gray-300">Nom</label>
                    <input type="text" name="nom" id="nom" value="{{ $user->nom }}" required
                        class="w-full px-4 py-2 text-white bg-gray-700 border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Champ Email -->
                <div class="mb-4">
                    <label for="email" class="block mb-2 text-gray-300">Email</label>
                    <input type="email" name="email" id="email" value="{{ $user->email }}" required
                        class="w-full px-4 py-2 text-white bg-gray-700 border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Sélecteur de Rôle -->
                <div class="mb-6">
                    <label for="role" class="block mb-2 text-gray-300">Rôle</label>
                    <select name="role" id="role" required
                        class="w-full px-4 py-2 text-white bg-gray-700 border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">

                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }} class="bg-gray-800">
                            Admin
                        </option>

                        <option value="support" {{ $user->role === 'support' ? 'selected' : '' }} class="bg-gray-800">Support
                        </option>
                        <option value="utilisateur" {{ $user->role === 'utilisateur' ? 'selected' : '' }} class="bg-gray-800">
                            Utilisateur</option>
                    </select>
                </div>

                <!-- Boutons -->
                <div class="flex justify-between">
                    <a href="{{ route('users.index') }}"
                        class="flex items-center justify-center gap-2 px-4 py-2 text-white transition bg-gray-600 rounded-md hover:bg-gray-500">
                        Annuler
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </a>
                    <button type="submit"
                        class="flex items-center justify-center gap-2 px-4 py-2 text-white transition bg-blue-600 rounded-md hover:bg-blue-500">
                        Mettre à jour
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection