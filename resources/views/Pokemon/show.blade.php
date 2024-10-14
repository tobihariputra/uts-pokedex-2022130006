@extends('layouts.app')

<title>Detail Pokemon</title>

@section('content')
    <div class="container my-3">
        <h2 class="mb-4">Detail Pokemon</h2>

        <div class="card mb-4" style="max-width: 600px;">
            @if ($pokemon->photo)
                <img src="{{ asset('storage/' . $pokemon->photo) }}" class="card-img-top" alt="{{ $pokemon->name }}">
            @else
                <img src="https://via.placeholder.com/600x300?text=No+Image" class="card-img-top" alt="No Image Available">
            @endif

            <div class="card-body">
                <h5 class="card-title mb-3">#{{ str_pad($pokemon->id, 4, '0', STR_PAD_LEFT) }}</h5>
                <h3 class="card-text mb-3 text-uppercase"><strong>{{ $pokemon->name }}</strong></h3>
                <p class="card-text"><strong>Species: {{ $pokemon->species }}</strong> </p>
                <p class="card-text"><strong>Primary Type: {{ $pokemon->primary_type }}</strong> </p>
                <p class="card-text"><strong>Power: {{ $pokemon->hp + $pokemon->attack + $pokemon->defense }}</strong> </p>
                <hr>

                <h6>Attributes</h6>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Weight:</strong> {{ $pokemon->weight }} kg</li>
                    <li class="list-group-item"><strong>Height:</strong> {{ $pokemon->height }} m</li>
                    <li class="list-group-item"><strong>HP:</strong> {{ $pokemon->hp }}</li>
                    <li class="list-group-item"><strong>Attack:</strong> {{ $pokemon->attack }}</li>
                    <li class="list-group-item"><strong>Defense:</strong> {{ $pokemon->defense }}</li>
                    <li class="list-group-item">
                        <strong>Legendary:</strong>
                        {{ $pokemon->is_legendary ? 'Yes' : 'No' }}
                    </li>
                </ul>
            </div>
        </div>
        <a href="{{ url('/') }}" class="btn btn-primary">Kembali ke Halaman Utama</a>
        <a href="{{ route('pokemon.edit', $pokemon->id) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('pokemon.destroy', $pokemon->id) }}" method="POST" style="display:inline;"
            onsubmit="return confirm('Apakah Anda yakin?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        <a href="{{ route('pokemon.index') }}" class="btn btn-secondary">Kembali ke Daftar Pokemon</a>
    </div>
@endsection
