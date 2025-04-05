@extends('layouts.app')

@section('content')
    <div class="container max-w-4xl px-4 py-8 mx-auto">

        {{-- En-tête --}}
        <div class="mb-10 text-center">
        
            <h1 class="mb-3 text-4xl font-bold text-transparent bg-gradient-to-r from-blue-500 to-purple-600 bg-clip-text">
                Détails du Ticket
            </h1>
        
            <div class="flex items-center justify-center space-x-4">
        
                <span class="px-4 py-1.5 text-sm font-medium rounded-full 
        
                    @if($ticket->statut == 'en_cours') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-100
                    
                    @elseif($ticket->statut == 'fermés') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-100
                    
                    @else bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-100 @endif">
                    
                    {{ ucfirst($ticket->statut) }}
                
                </span>
                
                <span class="text-lg text-gray-500 dark:text-gray-400">
                    Ticket #{{ $ticket->id }}
                </span>

            </div>

        </div>

        
        <div class="overflow-hidden bg-white shadow-xl rounded-2xl dark:bg-gray-800">
        
            {{-- En-tête de la carte --}}
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
        
                <div class="flex items-center space-x-4">
        
                    <div class="p-3 rounded-full bg-gradient-to-r from-blue-100 to-purple-100 dark:from-gray-700">
        
                        <svg class="w-6 h-6 text-blue-500 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.25 2.25a3 3 0 00-3 3v4.318a3 3 0 00.879 2.121l9.58 9.581c.92.92 2.39 1.186 3.548.428a18.849 18.849 0 005.441-5.44c.758-1.16.492-2.629-.428-3.548l-9.58-9.581a3 3 0 00-2.122-.879H5.25zM6.375 7.5a1.125 1.125 0 100-2.25 1.125 1.125 0 000 2.25z" clip-rule="evenodd" />
                        </svg>
        
                    </div>
        
                    <div>
        
                        <h2 class="text-xl font-bold text-gray-800 dark:text-white">{{ $ticket->sujet }}</h2>
        
                        <p class="text-gray-500 dark:text-gray-400">
                            Créé par <span class="font-medium text-blue-600 dark:text-blue-400">{{ $ticket->utilisateur->nom ?? 'Utilisateur inconnu' }}</span> 
                            le {{ $ticket->created_at->format('d/m/Y à H:i') }}
                        </p>
        
                    </div>
        
                </div>
        
            </div>

            {{-- Contenu du ticket --}}
            <div class="p-6 space-y-6">
            
                {{-- Description --}}
                <div>
            
                    <h3 class="flex items-center mb-3 text-lg font-semibold text-gray-800 dark:text-white">
            
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
            
                        Description
            
                    </h3>
            
                    <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-700/50">
                        
                        <p class="text-gray-700 dark:text-gray-300">{{ $ticket->description }}</p>
                    
                    </div>
            
                </div>

                {{-- Informations supplémentaires --}}
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    
                    {{-- Catégorie --}}
                    <div>
                    
                        <h3 class="mb-2 text-sm font-medium text-gray-500 dark:text-gray-400">Catégorie</h3>
                    
                        <p class="px-3 py-2 text-gray-700 bg-gray-100 rounded-lg dark:bg-gray-700 dark:text-gray-400">
                            {{ $ticket->category->nom ?? 'Non spécifiée' }}
                        </p>
                    
                    </div>

                    {{-- Pièce jointe --}}
                    @if($ticket->piece_jointe)
                    
                        <div>
                        
                            <h3 class="mb-2 text-sm font-medium text-gray-500 dark:text-gray-400">Pièce jointe</h3>
                        
                            <a href="{{ asset('storage/' . $ticket->piece_jointe) }}" target="_blank"
                                class="inline-flex items-center px-3 py-2 text-blue-600 transition-colors rounded-lg bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/30 dark:text-blue-400 dark:hover:bg-blue-900/50">
                        
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                                </svg>
                        
                                Télécharger
                        
                            </a>
                        
                        </div>
                    
                    @endif
                </div>
            </div>
        </div>

        {{-- Section des réponses --}}
        <div class="mt-10">
        
            <div class="flex items-center justify-between mb-6">
        
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Réponses</h2>
        
                <span class="px-3 py-1 text-sm font-medium text-gray-800 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-200">
                    {{ $ticket->responses->count() }} réponse(s)
                </span>
        
            </div>

            @if($ticket->responses->count() > 0)
                
                <div class="space-y-4">
                
                    @foreach($ticket->responses as $response)
                
                    <div class="p-6 bg-white shadow-sm rounded-xl dark:bg-gray-800">
                
                        <div class="flex items-start">
                
                            {{-- Avatar --}}
                            <div class="flex-shrink-0 mr-4">
                
                                <div class="flex items-center justify-center w-10 h-10 font-bold text-white rounded-full bg-gradient-to-r from-blue-400 to-purple-500">
                                    {{ substr($response->utilisateur->nom ?? 'A', 0, 1) }}
                                </div>
                
                            </div>
                            
                            <div class="flex-1 min-w-0">
                
                                {{-- En-tête réponse --}}
                                <div class="flex items-center justify-between mb-2">
                
                                    <p class="font-medium text-gray-900 dark:text-white">
                                        {{ $response->utilisateur->nom ?? 'Anonyme' }}
                                    </p>
                
                                    <span class="text-sm text-gray-500">
                                        {{ $response->created_at->diffForHumans() }}
                                    </span>
                
                                </div>
                                
                                {{-- Contenu de la réponse --}}
                                <div class="prose-sm prose text-gray-600 max-w-none dark:text-gray-300">
                
                                    {{ $response->message }}
                
                                </div>
                
                            </div>
                
                        </div>
                
                    </div>
                
                    @endforeach
                
                </div>
            
            @else
                
                <div class="p-8 text-center bg-white rounded-xl dark:bg-gray-800">
                
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                
                    <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">Aucune réponse</h3>
                
                    <p class="mt-1 text-gray-500 dark:text-gray-400">Soyez le premier à répondre à ce ticket</p>
                
                </div>
            
            @endif
        </div>

        {{-- Boutons d'action --}}
        <div class="flex flex-wrap justify-end gap-4 mt-8">
            
            <a href="{{ route(Auth::user()->role.'.tickets.my-tickets') }}" 
            class="inline-flex items-center px-6 py-3 text-sm font-medium text-gray-700 transition-colors bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700">
            
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            
                Retour aux tickets
            
            </a>
        
        </div>

    </div>
@endsection