@extends('layouts.app')

@section('title', 'Ligas')
@section('header', 'Gestión de ligas')

@section('content')
<div class="mb-4">
    <a href="{{ route('leagues.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Añadir liga</a>
</div>

<div class="bg-white shadow rounded">
    <table class="w-full">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2">ID</th>
                <th class="p-2">Nombre</th>
                <th class="p-2">País</th>
                <th class="p-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($leagues as $league)
            <tr class="border-t">
                <td class="p-2 text-center">{{ $league->id }}</td>
                <td class="p-2 text-center">{{ $league->name }}</td>
                <td class="p-2 text-center">{{ $league->country }}</td>
                <td class="p-2">
                    <div class="flex justify-center gap-2">
                        <a href="{{ route('leagues.edit', $league) }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Editar</a>

                        <form method="POST" action="{{ route('leagues.destroy', $league) }}">
                            @csrf
                            @method('DELETE')
                            <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700" onclick="return confirm('¿Seguro que quieres eliminar esta liga?')">Eliminar</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection