@extends('layouts.auth')

@section('title', 'Registrate')

@section('content')
<h1 class="text-2xl font-bold text-center mb-4">Crear cuenta</h1>

<form method="POST" action="{{ route('register') }}" class="space-y-4">
    @csrf

    <div>
        <label class="block text-sm font-medium mb-1">Nombre:</label>
        <input type="text" name="name" value="{{ old('name') }}" class="border p-2 w-full rounded" required>

        @error('name')
        <p class="text-red-600 text-sm">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Correo electrónico:</label>
        <input type="email" name="email" value="{{ old('email') }}" class="border p-2 w-full rounded" required>

        @error('email')
        <p class="text-red-600 text-sm">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Contraseña</label>
        <input type="password" name="password" class="border p-2 w-full rounded" required>
        
        @error('password')
        <p class="text-red-600 text-sm">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Confirmar contraseña</label>
        <input type="password" name="password_confirmation" class="border p-2 w-full rounded" required>
    </div>

    <button class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">Registrarse</button>

    <div class="text-center text-sm mt-4">
        ¿Ya tienes cuenta? <a href="{{ route('login') }}" class="text-green-600 hover:underline">Inicia sesión</a>
    </div>
</form>
@endsection