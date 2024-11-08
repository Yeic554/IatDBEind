@extends('layouts.app')

@section('title', 'Product Aanmaken')

@section('content')
<div class="container">
<div class="auth-container">
    <h1>Nieuw Product Aanmaken</h1>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Productnaam</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Beschrijving</label>
            <textarea name="description" id="description" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label for="category">Categorie</label>
            <input type="text" name="category" id="category" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="image">Afbeelding</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Product Opslaan</button>
    </form>
</div>
</div>
@endsection
