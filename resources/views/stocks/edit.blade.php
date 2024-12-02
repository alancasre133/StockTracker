@extends('layouts.app')

@section('content')
    <h1>Editar Stock</h1>
    <form action="{{ route('stocks.update', $stock->name) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Nombre:</label>
        <input type="text" name="name" value="{{ $stock->name }}" disabled>
        <label>Precio:</label>
        <input type="number" step="0.01" name="price" value="{{ $stock->price }}" required>
        <button type="submit">Actualizar</button>
    </form>
@endsection
