<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Mi Aplicación') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Mi Aplicación') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    @if(Auth::check())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('stock_and_user.index') }}">Stocks</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('stocks.create') }}">Search Stock</a>
                        </li>
                    @endif
                </ul>
                @if(Auth::check())
                    <form action="{{ route('logout') }}" method="POST" class="ms-auto d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Log Out</button>
                    </form>
                @endif
            </div>
        </div>
    </nav>

    <div class="container py-4">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
