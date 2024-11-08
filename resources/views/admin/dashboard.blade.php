@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <h1>Admin Dashboard</h1>
    
    <h2>Gebruikers Beheren</h2>
    <div class="users">
        @foreach($users as $user)
            <div class="user">
                <p>{{ $user->name }} ({{ $user->email }})</p>
                <p>Status: {{ $user->is_blocked ? 'Geblokkeerd' : 'Actief' }}</p>
                <form action="{{ route('users.toggle-block', $user) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit">{{ $user->is_blocked ? 'Deblokkeren' : 'Blokkeren' }}</button>
                </form>
            </div>
        @endforeach
    </div>

    <h2>Producten Beheren</h2>
    <div class="products">
        @foreach($products as $product)
            <div class="product">
                <p>{{ $product->name }} ({{ $product->category }})</p>
                <p>Status: {{ $product->is_available ? 'Beschikbaar' : 'Uitgeleend' }}</p>

                <form action="{{ route('products.delete', $product) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je dit product wilt verwijderen?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Verwijder Product</button>
                </form>
            </div>
        @endforeach
    </div>
@endsection
