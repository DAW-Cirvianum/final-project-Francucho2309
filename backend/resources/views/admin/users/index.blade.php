@extends('layouts.app')

@section('title', 'Usuarios')
@section('header', 'Gestion de usuarios')

@section('content')
<div class="mb-4">
    <a href="{{ route('users.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Añadir usuario</a>
</div>

<div class="bg-white shadow rounded">
    <table class="w-full">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2">ID</th>
                <th class="p-2">Nombre</th>
                <th class="p-2">Email</th>
                <th class="p-2">Rol</th>
                <th class="p-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr class="border-t">
                <td class="p-2 text-center">{{ $user->id }}</td>
                <td class="p-2 text-center">{{ $user->name }}</td>
                <td class="p-2 text-center">{{ $user->email }}</td>
                <td class="p-2 text-center">{{ $user->role }}</td>
                <td class="p-2">
                    <div class="flex justify-center gap-2">
                        <a href="{{ route('users.edit', $user) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Editar</a>

                        <form action="{{ route('users.destroy', $user) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700" onclick="return confirm('¿Seguro que quieres eliminar este usuario?')">Eliminar</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection