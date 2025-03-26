@extends('layouts.app')

@section('content')
<div class="container text-white">
    <h1>Liste des Tickets</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Sujet</th>
                <th>Description</th>
                <th>Statut</th>
                <th>Catégorie</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tickets as $ticket)
            <tr>
                <td>{{ $ticket->id }}</td>
                <td>{{ $ticket->sujet }}</td>
                <td>{{ $ticket->description }}</td>
                <td>{{ $ticket->statut }}</td>
                <td>{{ $ticket->category->nom}}</td>
                <td>
                    <a href="{{ route('tickets.edit', $ticket->id) }}">
                        Modifier
                    </a>
                    <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce ticket ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit">
                            Supprimer
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
