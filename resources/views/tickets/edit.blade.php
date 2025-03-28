@extends('layouts.app')

@section('content')

    <div class="container max-w-4xl px-4 mx-auto">

        {{-- En tete --}}
        <div class="mb-8 text-center md:text-left">

            <h1 class="text-3xl font-bold text-transparent bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text">
                Modifier le Ticket
            </h1>

            <p class="mt-2 text-lg text-gray-500 dark:text-gray-400">
                Mise à jour des informations du ticket
                #{{ $ticket->id }}
            </p>

        </div>

        {{-- Carte du formulaire --}}
        <div class="p-6 bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-gray-800 dark:border-gray-700">

            <form action="{{ route('tickets.update', $ticket->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Section des informations --}}
                <div
                    class="p-4 mb-6 rounded-lg bg-gradient-to-r from-blue-50 to-purple-50 dark:from-gray-700 dark:to-gray-700">

                    <div class="flex items-center gap-3">

                        <div class="p-2 rounded-full bg-gradient-to-r from-blue-100 to-purple-100 dark:from-gray-600">

                            <svg class="w-5 h-5 text-blue-500 dark:text-blue-300" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.25 2.25a3 3 0 00-3 3v4.318a3 3 0 00.879 2.121l9.58 9.581c.92.92 2.39 1.186 3.548.428a18.849 18.849 0 005.441-5.44c.758-1.16.492-2.629-.428-3.548l-9.58-9.581a3 3 0 00-2.122-.879H5.25zM6.375 7.5a1.125 1.125 0 100-2.25 1.125 1.125 0 000 2.25z"
                                    clip-rule="evenodd" />
                            </svg>

                        </div>

                        <div>

                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Ticket #{{ $ticket->id }}</p>

                            {{-- Date de Creation de Tickets --}}
                            <p class="text-lg font-semibold text-blue-600 dark:text-blue-300">
                                Créé le {{ $ticket->created_at->format('d/m/Y') }}
                            </p>

                        </div>
                    </div>
                </div>

                {{-- Champ Sujet --}}
                <div>

                    <label for="sujet" class="block mb-2 text-lg font-medium text-gray-800 dark:text-white">Sujet</label>

                    <input type="text" name="sujet" id="sujet" value="{{ old('sujet', $ticket->sujet) }}"
                        class="w-full px-4 py-3 placeholder-gray-400 transition duration-200 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        placeholder="Décrivez brièvement votre problème" />

                    @error('sujet')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror

                </div>

                {{-- Champ description --}}
                <div>

                    <label for="description" class="block mb-2 text-lg font-medium text-gray-800 dark:text-white">
                        Description détaillée
                    </label>

                    <textarea name="description" id="description" rows="6"
                        class="w-full px-4 py-3 placeholder-gray-400 transition duration-200 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        placeholder="Décrivez votre problème en détail...">{{ old('description', $ticket->description) }}
                        </textarea>

                    @error('description')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror

                </div>

                {{-- Champ Categorie --}}
                <div>

                    <label for="category_id" class="block mb-2 text-lg font-medium text-gray-800 dark:text-white">
                        Catégorie
                    </label>

                    <select name="category_id" id="category_id"
                        class="w-full px-4 py-3 transition duration-200 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">

                        @foreach($categories as $categorie)
                            <option value="{{ $categorie->id }}" {{ old('category_id', $ticket->category_id) == $categorie->id ? 'selected' : '' }}>
                                {{ $categorie->nom }}

                            </option>
                        @endforeach

                    </select>

                    @error('category_id')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror

                </div>

                {{-- Champ Statut --}}
                <div>

                    <label for="statut" class="block mb-2 text-lg font-medium text-gray-800 dark:text-white">
                        Statut
                    </label>

                    <select name="statut" id="statut"
                        class="w-full px-4 py-3 transition duration-200 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">

                        <option value="en_cours" {{ old('statut', $ticket->statut) == 'en_cours' ? 'selected' : '' }}>
                            En cours
                        </option>

                        <option value="fermés" {{ old('statut', $ticket->statut) == 'fermés' ? 'selected' : '' }}>
                            Fermé
                        </option>

                        <option value="en_attente" {{ old('statut', $ticket->statut) == 'en_attente' ? 'selected' : '' }}>
                            En attente
                        </option>

                    </select>

                    @error('statut')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror

                </div>

                {{-- Boutons d'actions --}}
                <div class="flex flex-col pt-4 space-y-4 md:flex-row md:space-y-0 md:space-x-4 md:justify-end">

                    <a href="{{ route('tickets.index') }}"
                        class="flex items-center justify-center gap-2 px-6 py-3 text-lg font-medium text-gray-300 transition-all duration-300 ease-in-out border border-gray-500 rounded-lg shadow-sm bg-gray-700/50 hover:bg-gray-700 hover:text-white hover:scale-105 group focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:bg-gray-600">

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 transition-transform group-hover:rotate-90">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>

                        Annuler

                    </a>

                    <button type="submit"
                        class="flex items-center justify-center gap-2 px-6 py-3 text-lg font-medium text-white transition-all duration-300 ease-in-out transform rounded-lg shadow-md group bg-gradient-to-r from-purple-500 to-blue-500 hover:from-purple-600 hover:to-blue-600 hover:shadow-lg hover:scale-105 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">

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