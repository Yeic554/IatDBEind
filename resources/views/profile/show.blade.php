@extends('layouts.app')

@section('title', 'Mijn Profiel')

@section('content')
    <h1>Profiel van {{ $user->name }}</h1>
    <h2>Mijn Producten</h2>
    <div class="products">
        @foreach($user->products as $product)
            <div class="product">
                <h3>{{ $product->name }}</h3>
                <p>{{ $product->description }}</p>
                <a href="{{ route('products.show', $product) }}">Bekijken</a>
            </div>
        @endforeach
    </div>

    <h2>Mijn Uitleningen</h2>
    <div class="lendings">
        @foreach($user->lendings as $lending)
            <div class="lending">
                <p>Product: {{ $lending->product->name }}</p>
                <p>Retourdatum: {{ $lending->return_date->format('d-m-Y') }}</p>
                <p>Status: {{ $lending->is_returned ? 'Teruggebracht' : 'Uitgeleend' }}</p>
            </div>
        @endforeach
    </div>
@endsection