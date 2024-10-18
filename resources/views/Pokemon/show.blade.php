@extends('layouts.app')

<title>Detail Pokemon</title>

@section('content')
    <div class="container my-1 d-flex justify-content-center">
        <div style="max-width: 600px; width: 100%;">
            <h2 class="mb-4 text-center" style="color: white; font-weight: bold; text-shadow: 1px 1px 5px #3b4cca;">
                Detail Pokemon
            </h2>

            <div class="card mb-4" style="background-color: #f8f9fa;">
                @if ($pokemon)
                    @if ($pokemon->photo)
                        <img src="{{ asset('storage/' . $pokemon->photo) }}" class="card-img-top mt-3"
                            alt="{{ $pokemon->name }}" style="height: auto; width: 50%; margin: 0 auto;">
                    @else
                        <img src="https://placehold.co/475" class="card-img-top mt-3" alt="No Image Available"
                            style="height: auto; width: 50%; margin: 0 auto;">
                    @endif
                @else
                    <img src="https://placehold.co/475" class="card-img-top mt-3 mb-3   " alt="No Image Available"
                        style="height: auto; width: 50%; margin: 0 auto;">
                @endif
            </div>

            @if ($pokemon)
                <div class="card-body" style="background-color: #fff; border-radius: 10px; padding: 20px;">
                    <h5 class="card-title mb-2" style="color: #3b4cca;">
                        #{{ str_pad($pokemon->id, 4, '0', STR_PAD_LEFT) }}
                    </h5>
                    <h4 class="card-text mb-2 text-uppercase" style="font-weight: bold; color: #3b4cca;">
                        {{ $pokemon->name }}
                    </h4>
                    <p class="card-text mb-2"><strong>Species:</strong> {{ $pokemon->species }}</p>
                    <p class="card-text mb-2"><strong>Primary Type:</strong> {{ $pokemon->primary_type }}</p>
                    <p class="card-text mb-2"><strong>Power:</strong>
                        {{ $pokemon->hp + $pokemon->attack + $pokemon->defense }}</p>
                    <hr>

                    <h6 style="font-weight: bold; color: #3b4cca;">Stats</h6>
                    <ul class="list-group list-group-flush" style="padding-left: 0; border-radius: 10px;">
                        <li class="list-group-item py-1" style="background-color: #f8f9fa;"><strong>Weight:</strong>
                            {{ $pokemon->weight }} kg</li>
                        <li class="list-group-item py-1" style="background-color: #f8f9fa;"><strong>Height:</strong>
                            {{ $pokemon->height }} m</li>
                        <li class="list-group-item py-1" style="background-color: #f8f9fa;"><strong>HP:</strong>
                            {{ $pokemon->hp }}</li>
                        <li class="list-group-item py-1" style="background-color: #f8f9fa;"><strong>Attack:</strong>
                            {{ $pokemon->attack }}</li>
                        <li class="list-group-item py-1" style="background-color: #f8f9fa;"><strong>Defense:</strong>
                            {{ $pokemon->defense }}</li>
                        <li class="list-group-item py-1" style="background-color: #f8f9fa;">
                            <strong>Legendary:</strong> {{ $pokemon->is_legendary ? 'Yes' : 'No' }}
                        </li>
                    </ul>
                </div>
            @else
                <div class="card-body">
                    <p class="text-center">Pokemon details not available.</p>
                </div>
            @endif
        </div>
    </div>

    <div class="text-center d-flex justify-content-center align-items-center flex-wrap gap-3 mt-3">
        @if ($previous)
            <a href="{{ route('pokemon.show', $previous->id) }}" class="btn btn-secondary mx-2 mb-2">
                &larr; Previous ({{ $previous->name }})
            </a>
        @else
            <button class="btn btn-secondary mx-2 mb-2" disabled>&larr; Previous</button>
        @endif

        @if ($pokemon)
            <a href="{{ route('pokemon.edit', $pokemon->id) }}" class="btn btn-primary mx-2 mb-2">Edit</a>

            <form action="{{ route('pokemon.destroy', $pokemon->id) }}" method="POST" style="display:inline;"
                class="mx-2 mb-2" onsubmit="return confirm('Apakah Anda yakin?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        @endif

        @if ($next)
            <a href="{{ route('pokemon.show', $next->id) }}" class="btn btn-secondary mx-2 mb-2">
                Next ({{ $next->name }}) &rarr;
            </a>
        @else
            <button class="btn btn-secondary mx-2 mb-2" disabled>Next &rarr;</button>
        @endif
    </div>
@endsection
