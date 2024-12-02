@extends('layouts.app')

@section('content')
    <h1>Stock Details</h1>
    <p><strong>Nombre:</strong> {{ $stock->name }}</p>
    <p><strong>Precio:</strong> {{ $stock->price }}</p>
    <a href="{{ route('stocks.index') }}">Return to list</a>
@endsection
