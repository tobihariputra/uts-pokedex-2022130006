@extends('layouts.app')

@section('content')
    <div class="container my-2">
        <h2 class="mb-4" style="color: white; font-weight: bold">Pokedex</h2>

        <div class="row g-2">
            @forelse ($pokemons as $pokemon)
                <div class="col-4 col-md-4 col-lg-4">
                    <div class="card h-100" style="max-width: 475px; width: 100%; margin: 0 auto">
                        @if ($pokemon->photo)
                            <a href="{{ route('pokemon.show', $pokemon->id) }}" class="text-decoration-none">
                                <img src="{{ asset('storage/' . $pokemon->photo) }}" class="card-img-top"
                                    alt="{{ $pokemon->name }}">
                            </a>
                        @else
                            <a href="{{ route('pokemon.show', $pokemon->id) }}" class="text-decoration-none">
                                <img src="https://placehold.co/475" class="card-img-top" alt="No Image Available">
                            </a>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">
                                #{{ str_pad($pokemon->id, 4, '0', STR_PAD_LEFT) }}
                            </h5>
                            <h1 class="card-title">
                                <a href="{{ route('pokemon.show', $pokemon->id) }}"
                                    class="link-offset-2 link-offset-1-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">
                                    {{ $pokemon->name }}
                                </a>
                            </h1>
                            <span class="badge rounded-pill bg-success">{{ $pokemon->primary_type }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Belum ada data Pokemon</h5>
                            <p class="card-text">Data Pokemon belum tersedia. Silakan tambahkan data terlebih dahulu.</p>
                            <a href="{{ route('pokemon.create') }}" class="btn btn-success mb-3">Buat Pokemon</a>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $pokemons->links() }}
        </div>
    </div>
@endsection
