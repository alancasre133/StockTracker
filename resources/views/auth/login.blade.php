@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Welcome!</h2>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->has('loginError'))
        <div class="alert alert-danger">
            {{ $errors->first('loginError') }}
        </div>
    @endif
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="correo" class="form-label">Email</label>
            <input type="text" class="form-control" name="correo" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Log In</button>
    </form>

    <div class="mt-3">
        <p>¿Dont have an account? 
            <a href="{{ route('register') }}" class="btn btn-link">Register</a>
        </p>
    </div>
</div>
@endsection
