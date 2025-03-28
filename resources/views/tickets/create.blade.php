@extends('layouts.app')

@section('content')
    <div class="p-6">
        <div class="max-w-4xl mx-auto">

            {{-- En tete --}}
            <div class="mb-8">

                <h1 class="text-3xl font-bold text-transparent bg-gradient-to-r from-blue-500 to-purple-600 bg-clip-text">
                    Créer un nouveau ticket
                </h1>

                <p class="mt-2 text-gray-500 dark:text-gray-400">Remplissez les détails de votre demande d'assistance</p>

            </div>

            {{-- Carte du formulaire --}}
            <div class="overflow-hidden bg-white shadow-md rounded-xl dark:bg-gray-800">

                {{-- Formulaire --}}
                <form action="{{ route('tickets.store') }}" method="POST" class="p-6" enctype="multipart/form-data">
                    @csrf

                    {{-- Section Utilisateur --}}
                    <div
                        class="p-4 mb-6 rounded-lg bg-gradient-to-r from-blue-50 to-purple-50 dark:from-gray-700 dark:to-gray-700">

                        <div class="flex items-center gap-3">

                            {{-- logo utilisateur --}}
                            <div class="p-2 rounded-full bg-gradient-to-r from-blue-100 to-purple-100 dark:from-gray-600">
                                <svg class="w-5 h-5 text-blue-500 dark:text-blue-300" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>

                            <div>

                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Utilisateur</p>

                                <p class="text-lg font-semibold text-blue-600 dark:text-blue-300">
                                    {{ auth()->user()->nom }}
                                </p>

                            </div>

                        </div>

                    </div>

                    {{-- Champ sujet --}}
                    <div class="mb-6">

                        <label for="sujet"
                            class="block mb-2 text-lg font-medium text-gray-800 dark:text-white">Sujet</label>

                        <input type="text" id="sujet" name="sujet"
                            class="w-full px-4 py-3 placeholder-gray-400 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="Décrivez brièvement votre problème" />

                        @error('sujet')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror

                    </div>

                    {{-- Champ Description --}}
                    <div class="mb-6">

                        <label for="description"
                            class="block mb-2 text-lg font-medium text-gray-800 dark:text-white">Description
                            détaillée</label>

                        <textarea id="description" name="description" rows="6"
                            class="w-full px-4 py-3 placeholder-gray-400 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="Décrivez votre problème en détail...">
                                    </textarea>

                        @error('description')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror

                    </div>

                    {{-- Champ Catégorie --}}
                    <div class="mb-6">

                        <label for="category_id"
                            class="block mb-2 text-lg font-medium text-gray-800 dark:text-white">Catégorie</label>
                        <select id="category_id" name="category_id"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:text-white">

                            @foreach($categories as $categorie)
                                <option value="{{ $categorie->id }}">
                                    {{ $categorie->nom }}
                                </option>
                            @endforeach

                        </select>

                        @error('category_id')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror

                    </div>

                    {{-- Champ Priorité --}}
                    <div class="mb-8">

                        <label class="block mb-2 text-lg font-medium text-gray-800 dark:text-white">
                            Pièce jointe (optionnelle)
                        </label>

                        <label
                            class="flex flex-col items-center justify-center w-full p-8 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:border-purple-500 hover:bg-gray-50 dark:hover:bg-gray-700">

                            <div class="flex flex-col items-center justify-center">

                                <svg class="w-10 h-10 mb-3 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" fill="currentColor">

                                    <path fill-rule="evenodd"
                                        d="M10.5 3.75a6 6 0 0 0-5.98 6.496A5.25 5.25 0 0 0 6.75 20.25H18a4.5 4.5 0 0 0 2.206-8.423 3.75 3.75 0 0 0-4.133-4.303A6.001 6.001 0 0 0 10.5 3.75Zm2.25 6a.75.75 0 0 0-1.5 0v4.94l-1.72-1.72a.75.75 0 0 0-1.06 1.06l3 3a.75.75 0 0 0 1.06 0l3-3a.75.75 0 1 0-1.06-1.06l-1.72 1.72V9.75Z"
                                        clip-rule="evenodd" />
                                </svg>

                                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">

                                    <span class="font-semibold">Cliquez pour téléverser</span>
                                    ou glissez-déposez

                                </p>

                                <p class="text-xs text-gray-500 dark:text-gray-400">PDF, DOCX, JPG, PNG (MAX. 5MB)</p>

                            </div>

                            <input id="piece_jointe" name="piece_jointe" type="file" class="hidden" />

                        </label>

                        @error('piece_jointe')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror

                    </div>

                    {{-- Boutton d'envoyer --}}
                    <div class="flex justify-end">
                        <button type="submit"
                            class="flex items-center gap-2 px-6 py-3 text-lg font-medium text-white rounded-lg shadow-md bg-gradient-to-r from-purple-500 to-blue-500 hover:from-purple-600 hover:to-blue-600 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">

                            <span>Créer le ticket</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                <path fill-rule="evenodd" d="M12 1.5a.75.75 0 0 1 .75.75V4.5a.75.75 0 0 1-1.5 0V2.25A.75.75 0 0 1 12 1.5ZM5.636 4.136a.75.75 0 0 1 1.06 0l1.592 1.591a.75.75 0 0 1-1.061 1.06l-1.591-1.59a.75.75 0 0 1 0-1.061Zm12.728 0a.75.75 0 0 1 0 1.06l-1.591 1.592a.75.75 0 0 1-1.06-1.061l1.59-1.591a.75.75 0 0 1 1.061 0Zm-6.816 4.496a.75.75 0 0 1 .82.311l5.228 7.917a.75.75 0 0 1-.777 1.148l-2.097-.43 1.045 3.9a.75.75 0 0 1-1.45.388l-1.044-3.899-1.601 1.42a.75.75 0 0 1-1.247-.606l.569-9.47a.75.75 0 0 1 .554-.68ZM3 10.5a.75.75 0 0 1 .75-.75H6a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 10.5Zm14.25 0a.75.75 0 0 1 .75-.75h2.25a.75.75 0 0 1 0 1.5H18a.75.75 0 0 1-.75-.75Zm-8.962 3.712a.75.75 0 0 1 0 1.061l-1.591 1.591a.75.75 0 1 1-1.061-1.06l1.591-1.592a.75.75 0 0 1 1.06 0Z"
                                    clip-rule="evenodd" />
                            </svg>

                        </button>

                    </div>

                </form>


            </div>

        </div>

    </div>

@endsection