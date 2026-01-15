@extends('layouts.app')

@section('title', 'Añadir camiseta')
@section('header', 'Camisetas')

@section('content')
<h1 class="text-2xl font-bold mb-4">Añadir camiseta</h1>

<form method="POST" action="{{ route('shirts.store') }}" class="space-y-4">
    @csrf

    <div>
        <label>Nombre de la camiseta: </label>
        <input type="text" name="name" class="border p-2 w-full" required>
    </div>

    @error('name')
        <p class="text-red-600 text-sm">{{ $message }}</p>
    @enderror
    
    <div>
        <label>Temporada: </label>
        <input type="text" name="season" class="border p-2 w-full" required>
    </div>

    @error('season')
        <p class="text-red-600 text-sm">{{ $message }}</p>
    @enderror

    <div>
        <label>Precio (€): </label>
        <input type="number" name="price" step="0.01" class="border p-2 w-full" required>
    </div>

    @error('price')
        <p class="text-red-600 text-sm">{{ $message }}</p>
    @enderror

    <div>
        <label>Equipo: </label>
        <select name="team_id" class="border p-2 w-full" required>
            <option value="" disabled selected>Selecciona un equipo</option>
            @foreach($teams as $team)
            <option value="{{ $team->id }}">{{ $team->name }}</option>
            @endforeach
        </select>
    </div>

    @error('team_id')
        <p class="text-red-600 text-sm">{{ $message }}</p>
    @enderror

    <div>
        <label>Imágenes: </label>
        <input type="file" name="images[]" accept="image/" class="border p-2 w-full" multiple>
    </div>

    <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Añadir</button>
</form>
@endsection