@extends('layouts.app')

<title>Edit Pokemon</title>

@section('content')
    <div class="container">
        <h2 class="my-4">Edit Pokemon</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pokemon.update', $pokemon->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $pokemon->name) }}">
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="species" class="form-label">Species</label>
                <input type="text" name="species" class="form-control" value="{{ old('species', $pokemon->species) }}">
                @error('species')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="primary_type" class="form-label">Primary Type</label>
                <select name="primary_type" class="form-select">
                    @foreach (['Grass', 'Fire', 'Water', 'Bug', 'Normal', 'Poison', 'Electric', 'Ground', 'Fairy', 'Fighting', 'Psychic', 'Rock', 'Ghost', 'Ice', 'Dragon', 'Dark', 'Steel', 'Flying'] as $type)
                        <option value="{{ $type }}"
                            {{ old('primary_type', $pokemon->primary_type) == $type ? 'selected' : '' }}>
                            {{ $type }}
                        </option>
                    @endforeach
                </select>
                @error('primary_type')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="weight" class="form-label">Weight (kg)</label>
                <input type="number" step="0.01" name="weight" class="form-control"
                    value="{{ old('weight', $pokemon->weight) }}">
                @error('weight')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="height" class="form-label">Height (m)</label>
                <input type="number" step="0.01" name="height" class="form-control"
                    value="{{ old('height', $pokemon->height) }}">
                @error('height')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="hp" class="form-label">HP</label>
                <input type="number" name="hp" class="form-control" value="{{ old('hp', $pokemon->hp) }}">
                @error('hp')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="attack" class="form-label">Attack</label>
                <input type="number" name="attack" class="form-control" value="{{ old('attack', $pokemon->attack) }}">
                @error('attack')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="defense" class="form-label">Defense</label>
                <input type="number" name="defense" class="form-control" value="{{ old('defense', $pokemon->defense) }}">
                @error('defense')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="is_legendary" class="form-check-input" value="1"
                    {{ old('is_legendary', $pokemon->is_legendary) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_legendary">Legendary</label>
            </div>

            <div class="mb-3">
                <label for="photo" class="form-label">Current Photo</label>
                @if ($pokemon->photo)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $pokemon->photo) }}" alt="Pokemon Photo" width="150">
                    </div>
                    <a href="{{ route('pokemon.deletePhoto', $pokemon->id) }}" class="btn btn-danger mb-3">Hapus Foto</a>
                @else
                    <p>Tidak ada foto yang diupload.</p>
                @endif

                <br>
                <label for="photo" class="form-label">Ganti Foto</label>
                <input type="file" name="photo" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('pokemon.index') }}" class="btn btn-secondary">Kembali ke Daftar Pokemon</a>
        </form>
    </div>
@endsection
