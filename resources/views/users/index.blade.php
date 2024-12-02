@extends('layouts.app')

@section('content')
<h1>Users List</h1>
<a href="{{ route('users.create') }}">Add New User</a>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <a href="{{ route('users.show', $user->name) }}">Watch</a>
                <a href="{{ route('users.edit', $user->name) }}">Edit</a>
                <form action="{{ route('users.destroy', $user->name) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
