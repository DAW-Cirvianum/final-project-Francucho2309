@extends('layouts.auth')

@section('title', 'Recuperar contraseña')

@section('content')
<h1 class="text-2xl font-bold text-center mb-4">Recuperar contraseña</h1>

<p class="text-sm text-gray-600 mb-4 text-center">
    Introduce tu correo y te enviaremos un enlace para restablecer tu contraseña.
</p>

<form method="POST" action="{{ route('password.email') }}" class="space-y-4">
    @csrf

    <input type="email" name="email" class="border p-2 w-full rounded" required>

    @error('email')
    <p class="text-red-600 text-sm">{{ $message }}</p>
    @enderror

    <button class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">Enviar enlace</button>
</form>
@endsection