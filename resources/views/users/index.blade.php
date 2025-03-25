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
<button type="submit"><a href="{{ route('users.edit', $user->id) }}">Modifier</a>

<!-- <select name="role" onchange="this.form.submit()">
        <option value="utilisateur" {{ $user->role === 'utilisateur' ? 'selected' : '' }}>Utilisateur</option>
        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
        <option value="support" {{ $user->role === 'support' ? 'selected' : '' }}>Support</option>
    </select>--></button>
    <button type="submit"><a href="http://127.0.0.1:8000/delete/{{$user->id}}">supprimer</a></button>

</td>


@endforeach
</td>
</tr><br>
    </tbody>
</table>

@endsection
