<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PokemonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pokemons = Pokemon::paginate(20);
        return view('pokemon.index', compact('pokemons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pokemon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:100',
            'primary_type' => 'required|string|in:Grass,Fire,Water,Bug,Normal,Poison,Electric,Ground,Fairy,Fighting,Psychic,Rock,Ghost,Ice,Dragon,Dark,Steel,Flying|max:50',
            'weight' => 'numeric|between:0,99999999.99',
            'height' => 'numeric|between:0,99999999.99',
            'hp' => 'integer|between:0,9999',
            'attack' => 'integer|between:0,9999',
            'defense' => 'integer|between:0,9999',
            'is_legendary' => 'boolean',
            'photo' => 'nullable|image|max:2048|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
            $validated['photo'] = $path;
        }

        Pokemon::create($validated);
        return redirect()->route('pokemon.index')->with('success', 'Pokemon berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pokemon = Pokemon::find($id);
        $previous = $pokemon ? Pokemon::where('id', '<', $pokemon->id)->orderBy('id', 'desc')->first() : null;
        $next = $pokemon ? Pokemon::where('id', '>', $pokemon->id)->orderBy('id', 'asc')->first() : null;
        return view('pokemon.show', compact('pokemon', 'previous', 'next'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pokemon = Pokemon::findOrFail($id);
        return view('pokemon.edit', compact('pokemon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pokemon = Pokemon::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'species' => 'required|string|max:100',
            'primary_type' => 'required|string|in:Grass,Fire,Water,Bug,Normal,Poison,Electric,Ground,Fairy,Fighting,Psychic,Rock,Ghost,Ice,Dragon,Dark,Steel,Flying|max:50',
            'weight' => 'numeric|between:0,99999999.99',
            'height' => 'numeric|between:0,99999999.99',
            'hp' => 'integer|between:0,9999',
            'attack' => 'integer|between:0,9999',
            'defense' => 'integer|between:0,9999',
            'is_legendary' => 'boolean',
            'photo' => 'nullable|image|max:2048|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($request->hasFile('photo')) {
            if ($pokemon->photo) {
                Storage::disk('public')->delete($pokemon->photo);
            }
            $path = $request->file('photo')->store('photos', 'public');
            $validated['photo'] = $path;
        }

        $pokemon->update($validated);

        return redirect()->route('pokemon.index')->with('success', 'Pokemon berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pokemon = Pokemon::findOrFail($id);

        if ($pokemon->photo) {
            Storage::disk('public')->delete($pokemon->photo);
        }

        $pokemon->delete();
        return redirect()->route('pokemon.index')->with('success', 'Pokemon berhasil dihapus.');
    }

    public function deletePhoto($id)
    {
        $pokemon = Pokemon::findOrFail($id);

        if ($pokemon->photo) {
            Storage::disk('public')->delete($pokemon->photo);
            $pokemon->photo = null;
            $pokemon->save();
        }

        return redirect()->route('pokemon.edit', $pokemon->id)->with('success', 'Foto berhasil dihapus.');
    }
}
