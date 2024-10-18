@extends('layouts.app')

<title>Daftar Pokemon</title>

@section('content')
    <div class="container">
        <h2 class="my-2" style="color: white; font-weight: bold">Daftar Pokemon</h2>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <a href="{{ route('pokemon.create') }}" class="btn btn-success mb-3">Buat Pokemon</a>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Species</th>
                        <th>Primary Type</th>
                        <th>Power</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pokemons as $pokemon)
                        <tr>
                            <td>#{{ str_pad($pokemon->id, 4, '0', STR_PAD_LEFT) }}</td>
                            <td>
                                <a class="link-offset-2 link-offset-1-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
                                    href="{{ route('pokemon.show', $pokemon->id) }}">
                                    {{ $pokemon->name }}
                                </a>
                            </td>
                            <td>{{ $pokemon->species }}</td>
                            <td>{{ $pokemon->primary_type }}</td>
                            <td>{{ $pokemon->hp + $pokemon->attack + $pokemon->defense }}</td>
                            <td>
                                <a href="{{ route('pokemon.edit', $pokemon->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('pokemon.destroy', $pokemon->id) }}" method="POST"
                                    style="display:inline;" onsubmit="return confirm('Apakah Anda yakin?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data Pokemon</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-3">
            {{ $pokemons->links() }}
        </div>
    </div>
@endsection
