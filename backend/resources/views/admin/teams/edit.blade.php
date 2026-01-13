@extends('layouts.app')

@section('title', 'Editar equipo')
@section('header', 'Equipos')

@section('content')
<h1 class="text-2xl font-bold mb-4">Editar equipo</h1>

<form method="POST" action="{{ route('teams.update', $team) }}" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
        <label>Nombre del equipo: </label>
        <input name="name" value="{{ $team->name }}" class="border p-2 w-full" required>
    </div>

    @error('name')
        <p class="text-red-600 text-sm">{{ $message }}</p>
    @enderror

    <div>
        <label>Liga: </label>
        <select name="league_id" class="border p-2 w-full" required>
            @foreach($leagues as $league)
            <option value="{{ $league->id }}" {{ $team->league_id == $league->id ? 'selected' : '' }}>{{ $league->name }}</option>
            @endforeach
        </select>
    </div>

    <button class="bg-blue-600 text-white px-4 py-2 rounded">Guardar</button>
</form>
@endsection