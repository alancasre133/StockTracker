@extends('layouts.app')

@section('content')
<h1>{{ isset($user) ? 'Edit User' : 'Add User' }}</h1>

<form action="{{ isset($user) ? route('users.update', $user->name) : route('users.store') }}" method="POST">
    @csrf
    @if(isset($user))
    @method('PUT')
    @endif

    <label for="name">Name:</label>
    <input type="text" name="name" value="{{ $user->name ?? '' }}" {{ isset($user) ? 'readonly' : '' }} required>

    <label for="email">Email:</label>
    <input type="email" name="email" value="{{ $user->email ?? '' }}" required>

    <label for="password">Password:</label>
    <input type="password" name="password" {{ isset($user) ? '' : 'required' }}>

    <button type="submit">{{ isset($user) ? 'Update' : 'Add' }}</button>
</form>
@endsection
