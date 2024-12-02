@extends('layouts.app')

@section('content')
    <h1>Editar Relación</h1>
    <form action="{{ route('stock_and_user.update', $stockAndUser) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="id_stock">Stock:</label>
        <select name="id_stock" required>
            @foreach($stocks as $stock)
                <option value="{{ $stock->name }}" {{ $stockAndUser->id_stock == $stock->name ? 'selected' : '' }}>
                    {{ $stock->name }}
                </option>
            @endforeach
        </select>

        <label for="id_user">Usuario:</label>
        <select name="id_user" required>
            @foreach($users as $user)
                <option value="{{ $user->name }}" {{ $stockAndUser->id_user == $user->name ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>

        <button type="submit">Actualizar</button>
    </form>
@endsection
