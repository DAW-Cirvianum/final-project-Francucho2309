@extends('layouts.app')

@section('title', 'Añadir liga')
@section('header', 'Equipos')

@section('content')
<h1 class="text-2xl font-bold mb-4">Añadir equipo</h1>

<form method="POST" action="{{ route('teams.store') }}" class="space-y-4">
    @csrf

    <div>
        <label>Nombre del equipo: </label>
        <input type="text" name="name" class="border p-2 w-full" required>
    </div>

    @error('name')
        <p class="text-red-600 text-sm">{{ $message }}</p>
    @enderror

    <div>
        <label>Liga: </label>
        <select name="league_id" class="border p-2 w-full" required>
            <option value="" disabled selected>Selecciona una liga</option>
            @foreach($leagues as $league)
            <option value="{{ $league->id }}">{{ $league->name }}</option>
            @endforeach
        </select>
    </div>

    @error('league_id')
        <p class="text-red-600 text-sm">{{ $message }}</p>
    @enderror

    <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Añadir</button>
</form>
@endsection