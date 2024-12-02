@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tracked Stocks - {{ Auth::user()->name }}</h2>
    <a href="{{ route('stock_and_user.create') }}" class="btn btn-primary mb-3">Add Stock to track</a>
            <button onclick="window.location='{{ route('stocks.refresh') }}'" class="btn btn-warning">
                <i class="bi bi-arrow-clockwise"></i> Update Prices
            </button>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Stock</th>
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
                            <form action="{{ route('stock_and_user.erase', ['stockName' => $stock->name, 'userEmail' => Auth::user()->name]) }}" method="POST" class="d-inline">
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
