@extends('layouts.app')

<title>Buat Pokemon</title>

@section('content')
    <div class="container">
        <h2 class="my-4">Buat Pokemon</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pokemon.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="species" class="form-label">Species</label>
                <input type="text" name="species" class="form-control" value="{{ old('species') }}">
                @error('species')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="primary_type" class="form-label">Primary Type</label>
                <select name="primary_type" class="form-select">
                    @foreach (['Grass', 'Fire', 'Water', 'Bug', 'Normal', 'Poison', 'Electric', 'Ground', 'Fairy', 'Fighting', 'Psychic', 'Rock', 'Ghost', 'Ice', 'Dragon', 'Dark', 'Steel', 'Flying'] as $type)
                        <option value="{{ $type }}" {{ old('primary_type') == $type ? 'selected' : '' }}>
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
                <input type="number" step="0.01" name="weight" class="form-control" value="{{ old('weight') }}">
                @error('weight')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="height" class="form-label">Height (m)</label>
                <input type="number" step="0.01" name="height" class="form-control" value="{{ old('height') }}">
                @error('height')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="hp" class="form-label">HP</label>
                <input type="number" name="hp" class="form-control" value="{{ old('hp') }}">
                @error('hp')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="attack" class="form-label">Attack</label>
                <input type="number" name="attack" class="form-control" value="{{ old('attack') }}">
                @error('attack')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="defense" class="form-label">Defense</label>
                <input type="number" name="defense" class="form-control" value="{{ old('defense') }}">
                @error('defense')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="is_legendary" class="form-check-input" value="1" {{ old('is_legendary') ? 'checked' : '' }}>
                <label class="form-check-label" for="is_legendary">Legendary</label>
            </div>

            <div class="mb-3">
                <label for="photo" class="form-label">Photo</label>
                <input type="file" name="photo" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('pokemon.index') }}" class="btn btn-secondary">Kembali ke Daftar Pokemon</a>
        </form>
    </div>
@endsection
