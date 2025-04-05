@extends('layouts.app')

@section('content')

    <div class="container px-4 py-8 mx-auto">

        {{-- En tete --}}
        <div class="mb-12 text-center">
            <h1 class="mb-3 text-4xl font-bold text-transparent bg-gradient-to-r from-blue-500 to-purple-600 bg-clip-text">
                Réponses aux Tickets
            </h1>

            <p class="text-lg text-gray-500 dark:text-gray-400">Suivi et résolution des demandes clients</p>
        </div>


        <div class="space-y-8">

            @foreach($tickets as $ticket)

                <div
                    class="overflow-hidden transition-all duration-300 bg-white shadow-md dark:bg-gray-800 rounded-xl hover:shadow-lg">

                    <div class="p-6 border-b border-gray-100 dark:border-gray-700">

                        <div class="flex flex-col md:flex-row md:items-center md:justify-between">

                            <div class="mb-4 md:mb-0">

                                <div class="flex items-center">

                                    <h2 class="mr-3 text-2xl font-bold text-gray-800 dark:text-white">#{{ $ticket->id }}</h2>

                                    <span
                                        class="px-3 py-1 text-sm font-semibold rounded-full

                                        @if($ticket->statut == 'en_cours') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-100

                                        @elseif($ticket->statut == 'fermés') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-100

                                        @else bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-100

                                        @endif">

                                        {{ $ticket->statut }}

                                    </span>

                                </div>

                                <h3 class="mt-2 text-xl font-semibold text-gray-800 dark:text-white">
                                    {{ $ticket->sujet }}
                                </h3>

                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">

                                    <span class="font-medium">Créé par :</span>

                                    {{ $ticket->utilisateur ? $ticket->utilisateur->nom : 'Utilisateur inconnu' }} •
                                    {{ $ticket->created_at->format('d/m/Y à H:i') }}

                                </p>

                            </div>

                        </div>

                        {{-- Description --}}
                        <div class="pl-4 mt-6 border-l-4 border-blue-500 dark:border-blue-400">
                            <p class="text-gray-700 dark:text-gray-300">{{ $ticket->description }}</p>
                        </div>
                    </div>

                    {{-- Section des reponses --}}
                    <div class="p-6 bg-gray-50 dark:bg-gray-700/30">

                        <div class="flex items-center mb-6">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>

                            <h4 class="text-lg font-semibold text-gray-800 dark:text-white">Réponses
                                ({{ $ticket->responses->count() }})
                            </h4>

                        </div>

                        {{-- Liste des réponses --}}
                        <div class="space-y-6">

                            @forelse($ticket->responses as $response)

                                <div class="space-y-3">

                                    {{-- Réponse du support --}}
                                    <div class="flex">

                                        <div class="flex-shrink-0 mr-3">
                                            <img class="w-10 h-10 rounded-full" src="{{ asset('images/support.png') }}" alt="Support">
                                        </div>

                                        <div class="flex-1 min-w-0">

                                            <div class="p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">

                                                <div class="flex items-center justify-between mb-2">

                                                    <p class="font-medium text-gray-900 dark:text-white">
                                                        {{ $response->utilisateur->nom }} (Support)
                                                    </p>

                                                    <span class="text-xs text-gray-500">{{ $response->created_at->diffForHumans() }}</span>

                                                </div>

                                                <p class="text-gray-700 dark:text-gray-300">{{ $response->message }}</p>

                                            </div>

                                        </div>

                                    </div>

                                    {{-- Section des commentaires --}}
                                    <div class="pl-4 space-y-3 border-l-2 border-gray-200 ml-14 dark:border-gray-600">

                                        @foreach($response->comments as $comment)

                                            <div class="flex group">

                                                <div class="flex-shrink-0 mr-3">
                                                    <img class="w-8 h-8 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($comment->utilisateur->nom) }}&background=random" alt="Utilisateur">
                                                </div>

                                                <div class="flex-1 min-w-0">

                                                    <div class="relative p-3 transition-colors bg-gray-100 rounded-lg shadow-xs dark:bg-gray-600 group-hover:bg-gray-200 dark:group-hover:bg-gray-500">

                                                        <div class="flex items-center justify-between mb-1">

                                                            <p class="text-sm font-medium text-gray-900 dark:text-white">
                                                                {{ $comment->utilisateur->nom }}
                                                            </p>

                                                            <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>

                                                        </div>

                                                        <p class="text-sm text-gray-700 dark:text-gray-300">{{ $comment->messages }}</p>

                                                        {{-- Options (suppression, etc.) --}}
                                                        {{-- @if($comment->utilisateur_id == auth()->id())

                                                            <div class="absolute transition-opacity opacity-0 top-2 right-2 group-hover:opacity-100">

                                                                <button class="p-1 text-gray-400 hover:text-red-500">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                    </svg>
                                                                </button>

                                                            </div>

                                                        @endif --}}

                                                    </div>

                                                </div>

                                            </div>

                                        @endforeach

                                    </div>

                                </div>

                            @empty

                                <div class="py-6 text-center text-gray-500 bg-white rounded-lg dark:text-gray-400 dark:bg-gray-800">
                                    Aucune réponse du support pour le moment
                                </div>

                            @endforelse

                        </div>

                        {{-- Formulaire de reponse --}}
                        <form action="{{ route(Auth::user()->role.'.response.store') }}" method="POST" class="mt-8">
                            @csrf

                            <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

                            <div class="flex gap-4">

                                {{-- Avatar --}}
                                <div class="flex-shrink-0">

                                    <img class="w-10 h-10 rounded-full" src="{{ asset('images/support.png') }}"

                                        alt="Support" />

                                </div>

                                {{-- Champ de réponse --}}
                                <div class="flex-1">

                                    <input type="hidden" name="message" value="{{ $ticket->id }}">

                                    <div class="relative flex-1">

                                        <input type="text" name="message" class="w-full py-2 pl-4 pr-12 text-sm border rounded-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                            placeholder="Ajouter un reponse..." >

                                        <button type="submit" class="absolute p-1 text-gray-400 transform -translate-y-1/2 right-2 top-1/2 hover:text-blue-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>

                                    </div>



                                    <div class="flex justify-end mt-3">

                                        <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-medium rounded-xl shadow-md hover:from-blue-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-300 flex items-center">

                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                                            </svg>

                                            Envoyer la réponse

                                        </button>

                                    </div>

                                </div>

                            </div>

                        </form>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

@endsection
