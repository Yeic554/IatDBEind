<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time2Share - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<header>
    <nav>
        @if (!request()->is('login') && !request()->is('register'))
            <a href="{{ route('products.index') }}">Home</a>
        @endif
        @auth
            <a href="{{ route('products.create') }}">Product Aanmaken</a>
            <a href="{{ route('lendings.index') }}">Mijn Uitleningen</a>
            <a href="{{ route('reviews.index') }}">Reviews</a>
            @if(auth()->user()->is_admin)
                <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
            @endif
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn-logout">Uitloggen</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="login">Inloggen</a>
            <a href="{{ route('register') }}" class="register">Registreren</a>
        @endauth
    </nav>
</header>
    <main>
        @yield('content')
    </main>
    <footer>
        <p>Time2Share © 2024</p>
    </footer>
</body>
</html>
