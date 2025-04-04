@extends('layouts.app')

@section('content')

<div class="container max-w-4xl px-4 mx-auto">

    {{-- En-tête --}}
    <div class="mb-8 text-center md:text-left">
        <h1 class="text-3xl font-bold text-transparent bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text">
            Détails du Ticket
        </h1>
        <p class="mt-2 text-lg text-gray-500 dark:text-gray-400">
            Ticket #{{ $ticket->id }} - Statut :
            <span class="font-semibold text-blue-600 dark:text-blue-300">
                {{ ucfirst($ticket->statut) }}
            </span>
        </p>
    </div>

    {{-- Carte d'affichage des informations du ticket --}}
    <div class="p-6 bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-gray-800 dark:border-gray-700">

        {{-- Informations générales --}}
        <div class="p-4 mb-6 rounded-lg bg-gradient-to-r from-blue-50 to-purple-50 dark:from-gray-700 dark:to-gray-700">
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
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Créé le {{ $ticket->created_at->format('d/m/Y H:i') }}
                    </p>
                    <p class="text-lg font-semibold text-blue-600 dark:text-blue-300">
                        Par : {{ $ticket->utilisateur->nom ?? 'Utilisateur inconnu' }}
                    </p>
                </div>
            </div>
        </div>

        {{-- Sujet --}}
        <div class="mb-4">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Sujet</h2>
            <p class="mt-1 text-gray-600 dark:text-gray-300">{{ $ticket->sujet }}</p>
        </div>

        {{-- Description --}}
        <div class="mb-4">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Description</h2>
            <p class="mt-1 text-gray-600 dark:text-gray-300">{{ $ticket->description }}</p>
        </div>

        {{-- Catégorie --}}
        <div class="mb-4">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Catégorie</h2>
            <p class="mt-1 text-gray-600 dark:text-gray-300">
                {{ $ticket->category->nom ?? 'Non spécifiée' }}
            </p>
        </div>

        {{-- Pièce jointe --}}
        @if($ticket->piece_jointe)
            <div class="mb-4">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Pièce jointe</h2>
                <a href="{{ asset('storage/' . $ticket->piece_jointe) }}" target="_blank"
                    class="text-blue-500 hover:underline">
                    Télécharger la pièce jointe
                </a>
            </div>
        @endif
    </div>

    {{-- Réponses --}}
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Réponses</h2>
        @if($ticket->responses->count() > 0)
            @foreach($ticket->responses as $response)
                <div class="p-4 mt-4 bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-gray-800 dark:border-gray-700">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                        Réponse de {{ $response->utilisateur->nom ?? 'Anonyme' }} -
                        <span class="text-blue-500">{{ $response->created_at->format('d/m/Y H:i') }}</span>
                    </p>
                    <p class="mt-2 text-gray-600 dark:text-gray-300">{{ $response->message }}</p>
                </div>
            @endforeach
        @else
            <p class="mt-4 text-gray-600 dark:text-gray-400">Aucune réponse pour le moment.</p>
        @endif
    </div>

    {{-- Boutons d'action --}}
    <div class="flex flex-col pt-6 space-y-4 md:flex-row md:space-y-0 md:space-x-4 md:justify-end">
        <a href="{{ route('tickets.my-tickets') }}"
            class="flex items-center justify-center gap-2 px-6 py-3 text-lg font-medium text-gray-300 transition-all duration-300 ease-in-out border border-gray-500 rounded-lg shadow-sm bg-gray-700/50 hover:bg-gray-700 hover:text-white hover:scale-105 group focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:bg-gray-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5 transition-transform group-hover:rotate-90">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
            Retour
        </a>

    </div>

</div>

@endsection
