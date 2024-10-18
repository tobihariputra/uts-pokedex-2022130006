@extends('layouts.app')

<title>Detail Pokemon</title>

@section('content')
    <div class="container my-1 d-flex justify-content-center">
        <div style="max-width: 600px; width: 100%;">
            <h2 class="mb-4 text-center" style="color: white; font-weight: bold">Detail Pokemon</h2>

            <div class="card mb-4">
                @if ($pokemon->photo)
                    <img src="{{ asset('storage/' . $pokemon->photo) }}" class="card-img-top" alt="{{ $pokemon->name }}"
                        style="height: 50%; width: 50%; margin: 0 auto">
                @else
                    <img src="https://placehold.co/475" class="card-img-top" alt="No Image Available">
                @endif

                <div class="card-body">
                    <h5 class="card-title mb-2">#{{ str_pad($pokemon->id, 4, '0', STR_PAD_LEFT) }}</h5>
                    <h4 class="card-text mb-2 text-uppercase"><strong>{{ $pokemon->name }}</strong></h4>
                    <p class="card-text mb-2"><strong>Species: {{ $pokemon->species }}</strong> </p>
                    <p class="card-text mb-2"><strong>Primary Type: {{ $pokemon->primary_type }}</strong> </p>
                    <p class="card-text mb-2"><strong>Power:
                            {{ $pokemon->hp + $pokemon->attack + $pokemon->defense }}</strong>
                    </p>
                    <hr>

                    <h6><strong>Stats</strong></h6>
                    <ul class="list-group list-group-flush" style="padding-left: 0;">
                        <li class="list-group-item py-1"><strong>Weight:</strong> {{ $pokemon->weight }} kg</li>
                        <li class="list-group-item py-1"><strong>Height:</strong> {{ $pokemon->height }} m</li>
                        <li class="list-group-item py-1"><strong>HP:</strong> {{ $pokemon->hp }}</li>
                        <li class="list-group-item py-1"><strong>Attack:</strong> {{ $pokemon->attack }}</li>
                        <li class="list-group-item py-1"><strong>Defense:</strong> {{ $pokemon->defense }}</li>
                        <li class="list-group-item py-1">
                            <strong>Legendary:</strong>
                            {{ $pokemon->is_legendary ? 'Yes' : 'No' }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center d-flex justify-content-center align-items-center flex-wrap gap-3">
        @if ($previous)
            <a href="{{ route('pokemon.show', $previous->id) }}" class="btn btn-secondary mx-2 mb-2">
                &larr; Previous ({{ $previous->name }})
            </a>
        @else
            <button class="btn btn-secondary mx-2 mb-2" disabled>&larr; Previous</button>
        @endif

        <a href="{{ route('pokemon.edit', $pokemon->id) }}" class="btn btn-primary mx-2 mb-2">Edit</a>

        <form action="{{ route('pokemon.destroy', $pokemon->id) }}" method="POST" style="display:inline;"
            class="mx-2 mb-2" onsubmit="return confirm('Apakah Anda yakin?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>

        @if ($next)
            <a href="{{ route('pokemon.show', $next->id) }}" class="btn btn-secondary mx-2 mb-2">
                Next ({{ $next->name }}) &rarr;
            </a>
        @else
            <button class="btn btn-secondary mx-2 mb-2" disabled>Next &rarr;</button>
        @endif
    </div>
@endsection
