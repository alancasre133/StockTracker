@extends('layouts.app')

@section('content')
    <h1>Search Stock</h1>

    @if($errors->any())
        <div>
            <p><strong>Please check the errors below:</strong></p>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('stocks.store') }}" method="POST">
        @csrf
        <label for="name">Stock Name:</label>
        <input type="text" name="name" id="name" placeholder="Example: AAPL" value="{{ old('name') }}" required>
        <br>

        <button type="submit">Search and Save</button>
    </form>

    <br>
    <a href="{{ route('stocks.index') }}">Return to stock list</a>
@endsection
