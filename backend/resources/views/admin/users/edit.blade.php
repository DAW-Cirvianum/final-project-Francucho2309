@extends('layouts.app')

@section('title', 'Editar Usuario')
@section('header', 'Usuarios')

@section('content')
<h1 class="text-2xl font-bold mb-4">Editar usuario</h1>

<form method="POST" action="{{ route('users.update', $user) }}" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
        <label>Nombre: </label>
        <input type="text" name="name" value="{{ $user->name }}" class="border p-2 w-full" required>
    </div>

    @error('name')
        <p class="text-red-600 text-sm">{{ $message }}</p>
    @enderror

    <div>
        <label>Correo electrónico: </label>
        <input type="email" name="email" value="{{ $user->email }}" class="border p-2 w-full" required>
    </div>

    @error('email')
        <p class="text-red-600 text-sm">{{ $message }}</p>
    @enderror

    <div>
        <label>Nueva contraseña (opcional): </label>
        <input type="password" name="password" class="border p-2 w-full" required>
    </div>
    
    <div>
        <label>Confirmar contraseña:</label>
        <input type="password" name="password_confirmation" class="border p-2 w-full" required>
    </div>
    
    @error('password')
        <p class="text-red-600 text-sm">{{ $message }}</p>
    @enderror

    <div>
        <label>Rol: </label>
        <select name="role" class="border p-2 w-full" required>
            <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>Usuario</option>
            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Administrador</option>
        </select>
    </div>

    <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Guardar</button>
</form>
@endsection