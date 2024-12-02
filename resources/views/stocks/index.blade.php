@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Stocks List</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('stocks.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Search Stock
            </a>
            <button onclick="window.location='{{ route('stocks.refresh') }}'" class="btn btn-warning">
                <i class="bi bi-arrow-clockwise"></i> Update Prices
            </button>
        </div>

        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stocks as $stock)
                    <tr>
                        <td>{{ $stock->name }}</td>
                        <td>${{ number_format($stock->price, 2) }}</td>
                        <td>
                            <a href="{{ route('stocks.show', $stock->name) }}" class="btn btn-info btn-sm">
                                <i class="bi bi-eye"></i> Watch
                            </a>

                            <form action="{{ route('stocks.destroy', $stock->name) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
