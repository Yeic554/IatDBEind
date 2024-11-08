@extends('layouts.app')

@section('title', 'Producten')

@section('content')
<div class="container">
<div class="auth-container">
    <h1>Alle Beschikbare Producten</h1>

    <form method="GET" action="{{ route('products.index') }}">
        <div class="form-group">
            <label for="category">Categorie</label>
            <select name="category" id="category" class="form-control">
                <option value="">Alle Categorieën</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->category }}" {{ request('category') == $category->category ? 'selected' : '' }}>
                        {{ $category->category }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="search">Zoeken</label>
            <input type="text" name="search" id="search" class="form-control" value="{{ request('search') }}">
        </div>

        <button type="submit" class="btn btn-primary">Zoeken</button>
    </form>

    <hr>

    @foreach ($products as $product)
        <div class="product">
            <div class="product-card">
            <h2>{{ $product->name }}</h2>
            <p>{{ $product->description }}</p>
            <p>Categorie: {{ $product->category }}</p>
            <p>Beschikbaar: {{ $product->is_available ? 'Ja' : 'Nee' }}</p>
            <a href="{{ route('products.show', $product) }}">Bekijk Product</a>
        </div>
</div>
    @endforeach

    {{ $products->links() }}
</div>
</div>
@endsection
