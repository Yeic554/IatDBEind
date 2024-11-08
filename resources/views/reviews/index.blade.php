@extends('layouts.app')

@section('title', 'Mijn Reviews')

@section('content')
    <h1>Reviews</h1>
    <div class="reviews">
        @foreach($reviews as $review)
            <div class="review">
                <h3>Review voor {{ $review->reviewed->name }}</h3>
                <p>Rating: {{ $review->rating }} / 5</p>
                <p>{{ $review->content }}</p>
            </div>
        @endforeach
    </div>
@endsection
