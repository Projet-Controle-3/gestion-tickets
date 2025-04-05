@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6">
    <!-- En-tête avec dégradé -->
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
            Modifier mon profil
        </h2>
        <p class="mt-2 text-gray-500 dark:text-gray-400">
            Mettez à jour vos informations personnelles
        </p>
    </div>

    <!-- Carte du formulaire -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden p-6">
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf

            <!-- Section Photo de profil -->
            <div class="flex flex-col items-center mb-8">
                <div class="relative mb-4">
                    <img src="{{ asset('uploads/photos/' . $user->photo) }}" 
                         alt="Photo de profil" 
                         class="w-32 h-32 rounded-full object-cover border-4 border-white dark:border-gray-700 shadow-lg">
                    <div class="absolute bottom-0 right-0 bg-blue-500 rounded-full p-2 shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                </div>
                <label class="relative cursor-pointer group">
    
                    <div class="px-5 py-2.5 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-medium rounded-lg shadow-md hover:from-blue-600 hover:to-purple-700 transition-all duration-300 flex items-center justify-center group-hover:shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                        Changer la photo
                    </div>
                    
                    <span class="absolute inset-0 overflow-hidden rounded-lg">
                        <span class="absolute top-0 left-0 w-full h-full bg-gradient-to-r from-blue-400/20 to-purple-400/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></span>
                    </span>
                    
                    <input type="file" name="photo" class="hidden" accept="image/*">
                </label>
            </div>

            <!-- Champ Nom -->
            <div class="mb-6">
                <label for="nom" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Nom
                </label>
                <input type="text" id="nom" name="nom" value="{{ old('nom', $user->nom) }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
            </div>

            <!-- Champ Email -->
            <div class="mb-6">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Email
                </label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
            </div>

            <!-- Bouton de soumission -->
            <div class="flex justify-end mt-8">
                <button type="submit"
                    class="px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-medium rounded-lg shadow-md hover:from-blue-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-300">
                    Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
</div>
@endsection