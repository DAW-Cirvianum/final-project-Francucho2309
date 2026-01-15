@extends('layouts.app')

@section('title', 'Equipos')
@section('header', 'Gestión de equipos')

@section('content')
<div class="mb-4">
    <a href="{{ route('teams.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Añadir equipo</a>
</div>

<div class="bg-white shadow rounded">
    <table class="w-full">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2">ID</th>
                <th class="p-2">Nombre</th>
                <th class="p-2">Liga</th>
                <th class="p-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($teams as $team)
            <tr class="border-t">
                <td class="p-2 text-center">{{ $team->id }}</td>
                <td class="p-2 text-center">{{ $team->name }}</td>
                <td class="p-2 text-center">{{ $team->league->name }}</td>
                <td class="p-2">
                    <div class="flex justify-center gap-2">
                        <a href="{{ route('teams.edit', $team) }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Editar</a>

                        <form method="POST" action="{{ route('teams.destroy', $team) }}">
                            @csrf
                            @method('DELETE')
                            <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700" onclick="return confirm('¿Seguro que quieres eliminar este equipo?')">Eliminar</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection