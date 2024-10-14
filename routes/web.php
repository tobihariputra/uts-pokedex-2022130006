<?php

use App\Http\Controllers\PokedexController;
use App\Http\Controllers\PokemonController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', PokedexController::class);

Route::resource('pokemon', PokemonController::class);

Route::get('/pokemon/{id}/delete-photo', [PokemonController::class, 'deletePhoto'])->name('pokemon.deletePhoto');
