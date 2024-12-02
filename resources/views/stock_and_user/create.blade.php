@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Add stock to track</h2>

        {{-- Mostrar errores --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('stock_and_user.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="stock_id" class="form-label">Select a Stock</label>
                <select name="stock_id" id="stock_id" class="form-control" required>
                    @foreach($stocks as $stock)
                        <option value="{{ $stock->name }}" {{ old('stock_id') == $stock->name ? 'selected' : '' }}>
                            {{ $stock->name }} - ${{ $stock->price }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">User</label>
                <input type="text" class="form-control" value="{{ Auth::user()->email }}" disabled>
                <input type="hidden" name="user_id" value="{{ Auth::user()->email }}">
            </div>

            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>
@endsection
