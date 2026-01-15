@extends('layouts.app')

@section('title', 'Camisetas')
@section('header', 'Gestión de camisetas')

@section('content')
<div class="mb-4">
    <a href="{{ route('shirts.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Añadir camiseta</a>
</div>

<div class="bg-white shadow rounded">
    <table class="w-full">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2">ID</th>
                <th class="p-2">Nombre</th>
                <th class="p-2">Equipo</th>
                <th class="p-2">Temporada</th>
                <th class="p-2">Precio</th>
                <th class="p-2">Imagen</th>
                <th class="p-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($shirts as $shirt)
            <tr class="border-t">
                <td class="p-2 text-center">{{ $shirt->id }}</td>
                <td class="p-2 text-center">{{ $shirt->name }}</td>
                <td class="p-2 text-center">{{ $shirt->team->name }}</td>
                <td class="p-2 text-center">{{ $shirt->season }}</td>
                <td class="p-2 text-center">{{ $shirt->price }}</td>
                <td class="p-2">
                    <div class="flex justify-center gap-4 mt-4">
                        @foreach($shirt->images as $image)
                            <div class="relative">
                                <img src="{{ asset('storage/' . $image->image_path) }}" class="w-24 h-24 object-cover rounded">
                            </div>
                        @endforeach
                    </div>
                </td>
                <td class="p-2">
                    <div class="flex justify-center gap-2">
                        <a href="{{ route('shirts.edit', $shirt) }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Editar</a>

                        <form method="POST" action="{{ route('shirts.destroy', $shirt) }}">
                            @csrf
                            @method('DELETE')
                            <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700" onclick="return confirm('¿Seguro que quieres eliminar esta camiseta?')">Eliminar</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection