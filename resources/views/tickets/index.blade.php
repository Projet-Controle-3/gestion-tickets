@extends('layouts.app')

@section('content')

    <div class="container px-4 mx-auto">

        {{-- En tete --}}
        <div class="mb-8 text-center md:text-left">

            <h1 class="text-4xl font-bold text-transparent bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text">
                Liste des Tickets
            </h1>

            <p class="mt-3 text-lg text-gray-500 dark:text-gray-400">Gestion des demandes de support technique</p>

        </div>

        {{-- Notification de success --}}
        @if (session('success'))

            <div class="p-4 mb-8 rounded-lg bg-green-50 dark:bg-green-900/30">

                <div class="flex items-center">

                    <svg class="w-5 h-5 mr-2 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>

                    <span class="text-green-800 dark:text-green-200">{{ session('success') }}</span>

                </div>

            </div>

        @endif

        {{-- Carte contenant le tableau --}}
        <div class="overflow-hidden border border-gray-200 rounded-xl dark:border-gray-700">

            {{-- tableau --}}
            <div class="overflow-x-auto">

                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">

                    <thead class="bg-gray-50 dark:bg-gray-800">

                        <tr>
                            <th scope="col"
                                class="px-6 py-4 text-sm font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                                ID
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-sm font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                                Sujet
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-sm font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                                Statut
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-sm font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                                Catégorie
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-sm font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                                Actions
                            </th>
                        </tr>

                    </thead>

                    {{-- Body de tableau --}}
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">

                        @foreach($tickets as $ticket)

                            <tr class="transition-colors hover:bg-gray-50 dark:hover:bg-gray-700/50">

                                {{-- ID --}}
                                <td class="px-6 py-5 text-sm font-medium text-gray-900 dark:text-white">

                                    #{{ $ticket->id }}

                                </td>

                                {{-- Sujet avec descripition en parallele --}}
                                <td class="px-6 py-5">

                                    <div class="text-base font-medium text-gray-900 dark:text-white">
                                        {{ $ticket->sujet }}
                                    </div>

                                    <div class="mt-1 text-sm text-gray-500 dark:text-gray-400 line-clamp-2">
                                        {{ $ticket->description }}
                                    </div>

                                </td>

                                {{-- Statut --}}
                                <td class="px-6 py-5">

                                    <form action="{{ route('tickets.updateStatut', $ticket->id) }}" method="POST" class="relative">
                                        @csrf
                                        @method('PATCH')

                                        <div class="relative">

                                            <select name="statut"
                                                    onchange="this.form.submit()"
                                                    class="appearance-none pl-3 pr-8 py-2 text-sm rounded-lg border-0 shadow-sm focus:ring-opacity-50 focus:outline-none transition-all duration-200

                                                        @if($ticket->statut == 'en_cours') bg-green-100/70 text-green-700 focus:ring-green-500

                                                        @elseif($ticket->statut == 'fermés') bg-red-100/70 text-red-700 focus:ring-red-500

                                                        @else bg-yellow-100/70 text-yellow-700 focus:ring-yellow-500 @endif">

                                                <option value="en_attente" {{ $ticket->statut == 'en_attente' ? 'selected' : '' }}>En attente</option>

                                                <option value="en_cours" {{ $ticket->statut == 'en_cours' ? 'selected' : '' }}>En cours</option>

                                                <option value="fermés" {{ $ticket->statut == 'fermés' ? 'selected' : '' }}>Fermé</option>

                                            </select>

                                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 dark:text-gray-50">

                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                </svg>

                                            </div>

                                        </div>

                                        {{-- Indicateur de statut --}}
                                        <div class="absolute -top-2 -right-2">

                                            <span class="flex h-3 w-3">

                                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full

                                                    @if($ticket->statut == 'en_cours') bg-green-400 opacity-75

                                                    @elseif($ticket->statut == 'fermés') bg-red-400 opacity-75

                                                    @else bg-yellow-400 opacity-75 @endif">

                                                </span>

                                                <span class="relative inline-flex rounded-full h-3 w-3

                                                    @if($ticket->statut == 'en_cours') bg-green-500

                                                    @elseif($ticket->statut == 'fermés') bg-red-500

                                                    @else bg-yellow-500 @endif">

                                                </span>

                                            </span>

                                        </div>

                                    </form>

                                </td>



                                {{-- Categorie --}}
                                <td class="px-6 py-5">

                                    <span
                                        class="inline-flex items-center px-3 py-2 text-xs font-medium text-center text-gray-800 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-200">

                                        {{ $ticket->category->nom }}

                                    </span>

                                </td>

                                {{-- Actions --}}
                                <td class="px-6 py-5">

                                    <div class="flex space-x-3">

                                        <a href="{{ route(Auth::user()->role.'.tickets.edit', $ticket->id) }}"
                                            class="p-2 text-blue-600 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/30"
                                            title="Modifier">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>

                                        </a>

                                        {{-- form de suppression --}}
                                        <form action="{{ route(Auth::user()->role.'.tickets.destroy', $ticket->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="p-2 text-red-600 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/30"
                                                title="Supprimer"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce ticket ?');">

                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>

                                            </button>

                                        </form>




                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

@endsection
