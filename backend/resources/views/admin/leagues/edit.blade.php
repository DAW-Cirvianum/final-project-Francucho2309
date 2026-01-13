@extends('layouts.app')

@section('title', 'Editar liga')
@section('header', 'Ligas')

@section('content')
<h1 class="text-2xl font-bold mb-4">Editar liga</h1>

<form method="POST" action="{{ route('leagues.update', $league) }}" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
        <label>Nombre de la liga: </label>
        <input name="name" value="{{ $league->name }}" class="border p-2 w-full" required>
    </div>

    @error('name')
        <p class="text-red-600 text-sm">{{ $message }}</p>
    @enderror

    <div>
        <label>País: </label>
        <select name="country" class="border p-2 w-full" required>
            @foreach($countries as $country)
            <option value="{{ $country }}" {{ $league->country == $country ? 'selected' : '' }}>{{ $country }}</option>
            @endforeach
        </select>
    </div>

    <button class="bg-blue-600 text-white px-4 py-2 rounded">Guardar</button>
</form>
@endsection