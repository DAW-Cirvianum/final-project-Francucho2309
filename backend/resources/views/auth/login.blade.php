@extends('layouts.auth')

@section('title', 'Iniciar sesión')

@section('content')
<h1 class="text-2xl font-bold text-center mb-4">Iniciar sesión</h1>

<form method="POST" action="{{ route('login') }}" class="space-y-4">
    @csrf

    <div>
        <label class="block text-sm font-medium mb-1">Correo electrónico:</label>
        <input type="email" name="email" value="{{ old('email') }}" class="border p-2 w-full rounded" autofocus required>
        
        @error('email')
        <p class="text-red-600 text-sm">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Contraseña:</label>
        <input type="password" name="password" class="border p-2 w-full rounded" required>

        @error('password')
        <p class="text-red-600 text-sm">{{ $message }}</p>
        @enderror
    </div>

    <button class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">Entrar</button>
</form>
@endsection