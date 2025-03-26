@extends('layouts.app')

@section('content')

    <div class="p-6">
        <div class="max-w-3xl mx-auto overflow-hidden bg-gray-800 rounded-lg shadow-md">

            <!-- Tete -->
            <div class="px-6 py-4 bg-gray-700 border-b border-gray-600">
                <h1 class="text-2xl font-bold text-white">Créer un nouveau ticket</h1>
                <p class="mt-1 text-gray-300">Remplissez les détails de votre demande</p>
            </div>

            <!-- Formulaire -->
            <form action="{{ route('tickets.store') }}" method="POST" class="p-6" enctype="multipart/form-data">
                @csrf

                <!-- Informations utilisateur -->
                <div class="p-4 mb-6 bg-gray-700 rounded-lg">
                    <p class="flex items-center gap-1 text-lg text-white">

                        <svg class="w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill="currentColor" class="size-6">
                            <path fill-rule="evenodd"
                                d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                                clip-rule="evenodd" />
                        </svg>
                        User

                    </p>
                    <p class="text-sm text-lime-300">
                        {{ auth()->user()->nom }}
                    </p>
                </div>
                <!-- Champ Sujet -->
                <div class="mb-6">

                    <label for="sujet" class="block mb-2 text-lg font-medium text-white">Sujet</label>
                    <input type="text" id="sujet" name="sujet" required
                        class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400"
                        placeholder="Décrivez brièvement votre problème">

                    @error('sujet')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror

                </div>

                <!-- Champ Description -->
                <div class="mb-6">

                    <label for="description" class="block mb-2 text-lg font-medium text-white">Description détaillée</label>
                    <textarea id="description" name="description" rows="6" required
                        class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400"
                        placeholder="Décrivez votre problème en détail...">
                            </textarea>

                    @error('description')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror

                </div>

                <!-- Champ Pièce jointe -->
                <div class="mb-8">

                    <label for="piece_jointe" class="block mb-2 text-sm font-medium text-white">Pièce jointe
                        (optionnelle)
                    </label>

                    <div class="flex items-center justify-center w-full">
                        <label for="piece_jointe"
                            class="flex flex-col items-center justify-center w-full h-32 transition duration-200 bg-gray-700 border-2 border-gray-600 border-dashed rounded-lg cursor-pointer hover:bg-gray-600">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">

                                {{-- icon de telechargement --}}
                                <svg class="w-8 h-8 mb-4 text-gray-300" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                    <path fill-rule="evenodd"
                                        d="M10.5 3.75a6 6 0 0 0-5.98 6.496A5.25 5.25 0 0 0 6.75 20.25H18a4.5 4.5 0 0 0 2.206-8.423 3.75 3.75 0 0 0-4.133-4.303A6.001 6.001 0 0 0 10.5 3.75Zm2.25 6a.75.75 0 0 0-1.5 0v4.94l-1.72-1.72a.75.75 0 0 0-1.06 1.06l3 3a.75.75 0 0 0 1.06 0l3-3a.75.75 0 1 0-1.06-1.06l-1.72 1.72V9.75Z"
                                        clip-rule="evenodd" />
                                </svg>



                                {{-- guid --}}
                                <p class="mb-2 text-sm text-gray-400">
                                    <span class="font-semibold">Cliquez pour
                                        téléverser
                                    </span> ou glissez-déposez
                                </p>
                                <p class="text-xs text-gray-400">PDF, DOCX, JPG, PNG (MAX. 5MB)</p>
                            </div>

                            <input id="piece_jointe" name="piece_jointe" type="file" class="hidden" />
                        </label>
                    </div>
                    @error('piece_jointe')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                    <div id="file-name" class="hidden mt-2 text-sm text-gray-300"></div>
                </div>

                <!-- Champ Catégorie -->
                <div class="mb-8">

                    <label for="category_id" class="block mb-2 text-lg font-medium text-white">Catégorie</label>
                    <select id="category_id" name="category_id" required
                        class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        @foreach($categories as $categorie)
                            <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                        @endforeach
                    </select>

                    @error('category_id')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror

                </div>

                <!-- Bouton de soumission -->
                <div class="flex justify-end">

                    <button type="submit"
                        class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition duration-200 flex items-center gap-1">
                        Créer le ticket
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path fill-rule="evenodd"
                                d="M12 1.5a.75.75 0 0 1 .75.75V4.5a.75.75 0 0 1-1.5 0V2.25A.75.75 0 0 1 12 1.5ZM5.636 4.136a.75.75 0 0 1 1.06 0l1.592 1.591a.75.75 0 0 1-1.061 1.06l-1.591-1.59a.75.75 0 0 1 0-1.061Zm12.728 0a.75.75 0 0 1 0 1.06l-1.591 1.592a.75.75 0 0 1-1.06-1.061l1.59-1.591a.75.75 0 0 1 1.061 0Zm-6.816 4.496a.75.75 0 0 1 .82.311l5.228 7.917a.75.75 0 0 1-.777 1.148l-2.097-.43 1.045 3.9a.75.75 0 0 1-1.45.388l-1.044-3.899-1.601 1.42a.75.75 0 0 1-1.247-.606l.569-9.47a.75.75 0 0 1 .554-.68ZM3 10.5a.75.75 0 0 1 .75-.75H6a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 10.5Zm14.25 0a.75.75 0 0 1 .75-.75h2.25a.75.75 0 0 1 0 1.5H18a.75.75 0 0 1-.75-.75Zm-8.962 3.712a.75.75 0 0 1 0 1.061l-1.591 1.591a.75.75 0 1 1-1.061-1.06l1.591-1.592a.75.75 0 0 1 1.06 0Z"
                                clip-rule="evenodd" />
                        </svg>

                    </button>

                </div>
            </form>
        </div>
    </div>


    {{-- code sans design --}}
    {{-- <div class="container text-white">
        <h1>Créer un ticket</h1>
        <form action="{{ route('tickets.store') }}" method="POST">
            @csrf
            <div>
                <p class="text-sm text-gray-900 dark:text-white" role="none">
                    User : {{ auth()->user()->nom }}
                </p>
            </div>
            <div>
                <label for="sujet">Sujet</label>
                <input type="text" name="sujet" id="sujet" required>
            </div>
            <div>
                <label for="description">Description</label>
                <textarea name="description" id="description" required></textarea>
            </div>
            <div>
                <label for="piece_jointe">Pièce jointe (max 5MB)</label>
                <input type="file" class="form-control" id="piece_jointe" name="piece_jointe">
            </div>
            <div>
                <label for="category_id">Catégorie</label>
                <select name="category_id" id="category_id" required>
                    @foreach($categories as $categorie)
                    <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit">Créer</button>
        </form>
    </div> --}}
@endsection
