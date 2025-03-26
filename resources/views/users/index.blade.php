@extends('layouts.app')

@section('content')

    <h1 class="text-white">ICI L'interface de Liste des Utilisateurs </h1>
    <table border="2" style="color: white;">
        <thead>
        <tr>
            <th>id</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
            <tr>
            <td>{{$user->id}} </td>
            <td>{{$user->nom}} </td>
                <td>{{$user->email}} </td>
                <td>{{$user->role}}</td>
                <td class="px-4 py-3 space-x-2 text-center">
<button type="submit"><a href="{{ route('users.edit', $user->id) }}">Modifier</a></button>
    <form action="{{ route('users.delete', $user->id) }}" method="POST" >
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Supprimer</button>
    </form>

</td>


@endforeach
</td>
</tr><br>
    </tbody>
</table>

@endsection
