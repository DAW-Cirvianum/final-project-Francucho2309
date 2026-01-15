@extends('layouts.app')

@section('title', 'Añadir liga')
@section('header', 'Ligas')

@section('content')
<h1 class="text-2xl font-bold mb-4">Añadir liga</h1>

<form method="POST" action="{{ route('leagues.store') }}" class="space-y-4">
    @csrf

    <div>
        <label>Nombre de la liga: </label>
        <input type="text" name="name" class="border p-2 w-full" required>
    </div>

    @error('name')
        <p class="text-red-600 text-sm">{{ $message }}</p>
    @enderror

    <div>
        <label>País: </label>
        <select name="country" class="border p-2 w-full" required>
            <option value="" disabled selected>Selecciona un país</option>
            @foreach($countries as $country)
            <option value="{{ $country }}">{{ $country }}</option>
            @endforeach
        </select>
    </div>

    @error('country')
        <p class="text-red-600 text-sm">{{ $message }}</p>
    @enderror

    <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Añadir</button>
</form>
@endsection