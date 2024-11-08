@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="container">
<div class="auth-container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>{{ $product->name }}</h2>
                </div>
                <div class="card-body">
                    <p><strong>Categorie:</strong> {{ $product->category }}</p>
                    <p><strong>Beschrijving:</strong> {{ $product->description }}</p>
                    <p><strong>Afbeelding:</strong></p>
                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="img-fluid">
                    
                    @if($product->is_available)

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('lendings.store', $product) }}" method="POST">
                             @csrf
                            <div class="form-group">
                                <label for="return_date">Retourdatum:</label>
                                    <input type="date" name="return_date" id="return_date" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-2">Leen dit product</button>
                        </form>
                    @else
                        <p>Dit product is momenteel niet beschikbaar.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
