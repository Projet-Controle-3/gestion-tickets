@extends('layouts.app')

@section('content')
<div class="container text-white">
    <h1>Modifier le Ticket</h1>

    <form action="{{ route('tickets.update', $ticket->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="sujet">Sujet</label>
            <input type="text" name="sujet" id="sujet" value="{{ $ticket->sujet }}" required>
        </div>

        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description" required>{{ $ticket->description }}</textarea>
        </div>

        <div>
            <label for="category_id">Catégorie</label>
            <select name="category_id" id="category_id" required>
                @foreach($categories as $categorie)
                    <option value="{{ $categorie->id }}" {{ $ticket->category_id == $categorie->id ? 'selected' : '' }}>
                        {{ $categorie->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="statut">Statut</label>
            <select name="statut" id="statut" required>
                <option value="en_cours" {{ $ticket->statut == 'en_cours' ? 'selected' : '' }}>En cours</option>
                <option value="fermés" {{ $ticket->statut == 'fermés' ? 'selected' : '' }}>Fermé</option>
                <option value="en_attente" {{ $ticket->statut == 'en_attente' ? 'selected' : '' }}>En attente</option>
            </select>
        </div>

        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Mettre à jour
        </button>
    </form>
</div>
@endsection
