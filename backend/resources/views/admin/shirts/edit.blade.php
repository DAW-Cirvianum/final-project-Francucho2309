@extends('layouts.app')

@section('title', 'Editar camiseta')
@section('header', 'Camisetas')

@section('content')
<h1 class="text-2xl font-bold mb-4">Editar camiseta</h1>

<form method="POST" action="{{ route('shirts.update', $shirt) }}" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
        <label>Nombre de la camiseta: </label>
        <input type="text" name="name" value="{{ $shirt->name }}" class="border p-2 w-full" required>
    </div>

    @error('name')
        <p class="text-red-600 text-sm">{{ $message }}</p>
    @enderror

    <div>
        <label>Temporada: </label>
        <input type="text" name="season" value="{{ $shirt->season }}" class="border p-2 w-full" required>
    </div>

    @error('season')
        <p class="text-red-600 text-sm">{{ $message }}</p>
    @enderror

    <div>
        <label>Precio (€): </label>
        <input type="number" name="price" step="0.01" value="{{ $shirt->price }}" class="border p-2 w-full" required>
    </div>

    @error('price')
        <p class="text-red-600 text-sm">{{ $message }}</p>
    @enderror

    <div>
        <label>Equipo: </label>
        <select name="team_id" class="border p-2 w-full" required>
            <option value="" disabled selected>Selecciona un equipo</option>
            @foreach($teams as $team)
            <option value="{{ $team->id }}" {{ $shirt->team_id == $team->id ? 'selected' : '' }}>{{ $team->name }}</option>
            @endforeach
        </select>
    </div>

    @error('team_id')
        <p class="text-red-600 text-sm">{{ $message }}</p>
    @enderror

    <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Guardar</button>
</form>

<hr class="my-6">

<h1 class="text-lg font-bold mb-2">Imágenes</h1>

<form method="POST" action="{{ route('shirts.images.store', $shirt) }}" enctype="multipart/form-data" class="space-y-3">
    @csrf
    
    <input type="file" name="images[]" accept="image/*" class="border p-2 w-full" multiple>
    
    <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Subir imágenes</button>
</form>

<div class="flex flex-wrap gap-4 mt-4">
@foreach($shirt->images as $image)
    <div class="relative">
        <img src="{{ asset('storage/' . $image->image_path) }}" class="w-24 h-24 object-cover rounded border">

        <form method="POST" action="{{ route('shirts.images.destroy', $image) }}" class="absolute top-1 right-1">
            @csrf
            @method('DELETE')

            <button class="bg-red-600 text-white px-2 rounded text-sm">✕</button>
        </form>
    </div>
@endforeach
</div>
@endsection