@extends('layouts.app')

@section('title', 'Añadir usuario')
@section('header', 'Usuarios')

@section('content')
<h1 class="text-2xl font-bold mb-4">Crear usuario</h1>

<form method="POST" action="{{ route('users.store') }}" class="space-y-4">
    @csrf

    <div>
        <label>Nombre: </label>
        <input type="text" name="name" class="border p-2 w-full" required>
    </div>

    @error('name')
        <p class="text-red-600 text-sm">{{ $message }}</p>
    @enderror

    <div>
        <label>Correo electrónico: </label>
        <input type="email" name="email" class="border p-2 w-full" required>
    </div>

    @error('email')
        <p class="text-red-600 text-sm">{{ $message }}</p>
    @enderror

    <div>
        <label>Contraseña: </label>
        <input type="password" name="password" class="border p-2 w-full" required>
    </div>

    <div>
        <label>Confirmar contraseña: </label>
        <input type="password" name="password_confirmation" class="border p-2 w-full" required>
    </div>

    @error('password')
        <p class="text-red-600 text-sm">{{ $message }}</p>
    @enderror

    <div>
        <label>Rol: </label>
        <select name="role" class="border p-2 w-full" required>
            <option value="user">Usuario</option>
            <option value="admin">Administrador</option>
        </select>
    </div>

    <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Añadir</button>
</form>
@endsection