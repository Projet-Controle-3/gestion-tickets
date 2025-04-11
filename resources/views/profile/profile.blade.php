@extends('layouts.app')

@section('content')

<div class="max-w-2xl p-6 mx-auto">
    
    <!-- En-tête avec dégradé -->
    <div class="mb-8 text-center">
 
        <h2 class="text-3xl font-bold text-transparent bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text">
            Modifier mon profil
        </h2>
 
        <p class="mt-2 text-gray-500 dark:text-gray-400">
            Mettez à jour vos informations personnelles
        </p>
 
    </div>

    <!-- Carte du formulaire -->
    <div class="p-6 overflow-hidden bg-white shadow-md dark:bg-gray-800 rounded-xl">
 
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
 
            @csrf
            @method('PUT')

            <!-- Section Photo de profil -->
            <div class="flex flex-col items-center mb-10 space-y-4">

                <!-- Conteneur photo avec effets -->
                <div class="relative group">

                    <!-- Cercle décoratif en arrière-plan -->
                    <div class="absolute inset-0 w-40 h-40 transition-all duration-500 transform -translate-x-1 -translate-y-1 rounded-full opacity-0 bg-gradient-to-br from-blue-100 to-purple-100 group-hover:opacity-100 dark:from-blue-900/30 dark:to-purple-900/30"></div>
                    
                    <!-- Photo de profil -->
                    <div class="relative z-10 overflow-hidden transition-all duration-300 border-4 border-white rounded-full shadow-xl w-36 h-36 dark:border-gray-800 group-hover:shadow-2xl">

                        <img src="{{ asset($user->photo ? $user->image : $user->avatar) }}" 
                            alt="Photo de profil" 
                            class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-105">

                    </div>

                    <!-- Badge de rôle -->
                    <span class="absolute top-3 right-3 z-20 flex items-center justify-center w-5 h-5 rounded-full border-2 border-white dark:border-gray-800 shadow-sm
                    
                        @if($user->role === 'admin') bg-gradient-to-br from-red-500 to-red-600
                        
                        @elseif($user->role === 'support') bg-gradient-to-br from-yellow-400 to-yellow-500
                        
                        @else bg-gradient-to-br from-green-400 to-green-500 @endif">
                        
                        <span class="absolute inline-flex w-full h-full rounded-full opacity-75 animate-ping
                        
                            @if($user->role === 'admin') bg-red-400
                            
                            @elseif($user->role === 'support') bg-yellow-300
                            
                            @else bg-green-300 @endif">
                        
                        </span>
                    
                    </span>
                
                </div>

                <!-- Boutons d'action sous forme d'icônes côte à côte -->
                <div class="flex items-center justify-center space-x-4">
                
                    <!-- Bouton Changer la photo (version améliorée) -->
                    <label class="relative p-3 transition-all duration-300 bg-blue-100 rounded-full cursor-pointer group hover:bg-blue-200 dark:bg-blue-900/50 dark:hover:bg-blue-800/50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2">
                
                        <!-- Icône avec animation -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600 transition-transform duration-300 dark:text-blue-300 group-hover:scale-110 group-hover:-translate-y-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                        
                        <!-- Effet de pulsation subtil -->
                        <span class="absolute inset-0 transition-opacity duration-300 rounded-full opacity-0 bg-blue-200/50 dark:bg-blue-700/30 group-hover:opacity-100 group-hover:animate-ping"></span>
                        
                        <!-- Tooltip -->
                        <span class="absolute right-0 px-3 py-1 text-xs font-medium text-white transition-opacity duration-200 transform -translate-x-1/2 bg-gray-800 rounded opacity-0 -top-10 whitespace-nowrap group-hover:opacity-100">
                            Changer la photo
                        </span>
                        
                        <input type="file" name="photo" class="hidden" accept="image/*">

                    </label>
                
                    <!-- Bouton Supprimer la photo (version améliorée) -->
                    @if($user->photo)
                    
                        <button type="button" onclick="document.getElementById('delete-photo-form').submit()" 
                            class="relative p-3 transition-all duration-300 bg-red-100 rounded-full group hover:bg-red-200 dark:bg-red-900/50 dark:hover:bg-red-800/50 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-2" >
                            
                            <!-- Icône avec animation -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-600 transition-transform duration-300 dark:text-red-300 group-hover:scale-110 group-hover:rotate-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            
                            <!-- Effet de pulsation -->
                            <span class="absolute inset-0 transition-opacity duration-300 rounded-full opacity-0 bg-red-200/50 dark:bg-red-700/30 group-hover:opacity-100 group-hover:animate-ping"></span>
                            
                            <!-- Tooltip -->
                            <span class="absolute px-2 py-1 text-xs font-medium text-white transition-opacity duration-200 transform -translate-x-1/2 bg-gray-800 rounded opacity-0 -right-55 -top-10 whitespace-nowrap group-hover:opacity-100">
                                Supprimer la photo
                            </span>
                        
                        </button>

                    @endif
                </div>

                <!-- Indicateur texte -->
                <p class="text-xs font-medium text-gray-500 dark:text-gray-400 transition-all duration-300 transform group-hover:translate-y-0.5">
                    Formats supportés: JPG, PNG, WEBP (max. 5MB)
                </p>

            </div>

            <!-- Champ Nom -->
            <div class="mb-6">
                
                <label for="nom" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Nom
                </label>
                
                <input type="text" id="nom" name="nom" value="{{ old('nom', $user->nom) }}" 
                    class="w-full px-4 py-2 transition duration-300 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none focus:ring-2">
            
            </div>

            <!-- Champ Email -->
            <div class="mb-6">
                
                <label for="email" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Email
                </label>
                
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                    class="w-full px-4 py-2 transition duration-300 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none focus:ring-2">
            
            </div>

            <!-- Champ Mot de passe -->
            <div class="mb-6">
               
                <label for="password" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Nouveau mot de passe (laisser vide pour ne pas changer)
                </label>
               
                <input type="password" id="password" name="password"
                    class="w-full px-4 py-2 transition duration-300 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none focus:ring-2">
            
            </div>

            <!-- Confirmation Mot de passe -->
            <div class="mb-6">
               
                <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Confirmer le mot de passe
                </label>
               
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="w-full px-4 py-2 transition duration-300 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none focus:ring-2">
            
            </div>

            
            
            <!-- Bouton de soumission principal -->
            <div class="flex justify-end mt-8">
                
                <button type="submit"
                    class="relative px-8 py-3.5 overflow-hidden font-medium text-white transition-all duration-500 rounded-xl group bg-gradient-to-br from-blue-500 via-purple-500 to-purple-600 hover:from-blue-600 hover:via-purple-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:ring-offset-2 shadow-lg hover:shadow-xl active:scale-[0.98]">
                    
                    <!-- Effet de lumière animé -->
                    <span class="absolute top-0 left-0 w-8 h-full -translate-x-12 -skew-x-12 bg-white/30 transition-all duration-1000 group-hover:translate-x-[150px] group-hover:opacity-50"></span>
                    
                    <!-- Effet de fond animé -->
                    <span class="absolute inset-0 transition-all duration-500 opacity-0 bg-gradient-to-br from-blue-600 via-purple-600 to-purple-800 group-hover:opacity-100"></span>
                    
                    <!-- Contenu du bouton -->
                    <span class="relative z-10 flex items-center justify-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white transition-all duration-300 group-hover:rotate-[360deg]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-sm font-medium tracking-wider">Enregistrer les modifications</span>
                    </span>
                    
                    <!-- Effet de vague au hover -->
                    <span class="absolute bottom-0 left-0 w-full h-1 transition-all duration-700 origin-left transform scale-x-0 bg-white/40 group-hover:scale-x-100"></span>
                    
                    <!-- Bordure animée -->
                    <span class="absolute inset-0 transition-all duration-300 border-2 border-transparent rounded-xl group-hover:border-white/20"></span>
                
                </button>

            </div>

        </form>

        <!-- Formulaire de suppression de la photo (placé en dehors du formulaire principal) -->
        @if($user->photo)
        
            <form id="delete-photo-form" method="POST" action="{{ route('profile.photo.destroy', $user->id) }}" class="hidden">
            
                @csrf
                @method('DELETE')
            
            </form>
        
        @endif

    </div>

</div>

@endsection