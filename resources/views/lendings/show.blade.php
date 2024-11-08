@extends('layouts.app')

@section('title', 'Uitlening Details')

@section('content')
<div class="container">
<div class="auth-container">
    <div class="card">
        <div class="card-header">
            <h3>{{ $lending->product->name }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Uitgeleend door:</strong> {{ $lending->lender->name }}</p>
            <p><strong>Uitgeleend aan:</strong> {{ $lending->borrower->name }}</p>
            <p><strong>Retourdatum:</strong> {{ $lending->return_date->format('d-m-Y') }}</p>
            <p><strong>Status:</strong> {{ $lending->is_returned ? 'Teruggebracht' : 'Nog niet teruggebracht' }}</p>

            {{-- Controleer of er al een review is geschreven --}}
            @if ($lending->review)
                <div class="alert alert-success">
                    <strong>Review:</strong> {{ $lending->review->content }}
                    <br>
                    <strong>Rating:</strong> {{ $lending->review->rating }} / 5
                </div>
            @else
                @if(Auth::user()->id === $lending->lender_id)
                    <h4>Schrijf een review voor de lener</h4>
                    <form action="{{ route('reviews.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="lending_id" value="{{ $lending->id }}">
                        <input type="hidden" name="reviewed_id" value="{{ $lending->borrower->id }}">
                        
                        <div class="form-group">
                            <label for="content">Review:</label>
                            <textarea name="content" id="content" rows="4" class="form-control" required></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="rating">Rating:</label>
                            <select name="rating" id="rating" class="form-control" required>
                                <option value="1">1 - Slecht</option>
                                <option value="2">2</option>
                                <option value="3">3 - Gemiddeld</option>
                                <option value="4">4</option>
                                <option value="5">5 - Uitstekend</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Review Opslaan</button>
                    </form>
                @else
                    <p>Je kunt geen review achterlaten omdat je niet de uitleverende partij bent.</p>
                @endif
            @endif
        </div>
    </div>
</div>
</div>
@endsection
