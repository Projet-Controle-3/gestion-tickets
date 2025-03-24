@extends('layouts.app')

@section('content')

<div class="container text-white">
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
            <label for="category_id">Catégorie</label>
            <select name="category_id" id="category_id" required>
                @foreach($categories as $categorie)
                    <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Créer</button>
    </form>
</div>
@endsection


