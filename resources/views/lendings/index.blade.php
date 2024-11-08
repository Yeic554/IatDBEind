@extends('layouts.app')

@section('title', 'Mijn Uitleningen')

@section('content')
<div class="container">
    <h1>Mijn Uitleningen</h1>

    @if($lendings->isEmpty())
        <p>Je hebt momenteel geen uitleningen.</p>
    @else
        <div class="list-group">
            @foreach ($lendings as $lending)
                <div class="list-group-item">
                    <div class="product-card">
                        <h2>{{ $lending->product->name }}</h2>
                        <p><strong>Uitgeleend door:</strong> {{ $lending->lender->name }}</p>
                        <p><strong>Geleend door:</strong> {{ $lending->borrower->name }}</p>
                        <p><strong>Retourdatum:</strong> {{ \Carbon\Carbon::parse($lending->return_date)->format('d-m-Y') }}</p>
                        <p><strong>Status:</strong> {{ $lending->is_returned ? 'Teruggegeven' : 'Niet teruggegeven' }}</p>

                        @if ($lending->borrower_id == auth()->id() && !$lending->is_returned)
                            <form action="{{ route('lendings.return', $lending->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success">Geef terug</button>
                            </form>
                        @elseif ($lending->is_returned)
                            <p>Dit product is al teruggegeven.</p>
                        @else
                            <p>Je kunt dit product niet teruggeven, aangezien je de lener niet bent.</p>
                        @endif

                        {{-- Review knop (altijd zichtbaar voor de uitlener) --}}
                        @if ($lending->lender_id == auth()->id() && !$lending->review)
                            <a href="{{ route('lendings.show', $lending) }}" class="btn btn-primary">Schrijf een review voor de lener</a>
                        @elseif ($lending->review)
                            <p>Review: {{ $lending->review->content }} - Beoordeeld met {{ $lending->review->rating }} / 5</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        {{ $lendings->links() }}
    @endif
</div>
@endsection
