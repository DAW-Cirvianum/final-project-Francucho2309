@extends('layouts.auth')

@section('title', 'Verificar email')

@section('content')
<h1 class="text-2xl font-bold text-center mb-4">Verifica tu correo electrónico</h1>

<p class="text-sm text-gray-600 text-center mb-6">
    Gracias por registrarte en <strong>TopFlex</strong>.
    Antes de continuar, revisa tu correo y haz clic en el enlace de verificación que te hemos enviado.
</p>

@if (session('status') === 'verification-link-sent')
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-sm text-center">
        Se ha enviado un nuevo enlace de verificación a tu correo.
    </div>
@endif

<div class="space-y-3">
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf

        <button type="submit" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">
            Reenviar correo de verificación
        </button>
    </form>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="w-full bg-gray-200 text-gray-800 py-2 rounded hover:bg-gray-300">
            Cerrar sesión
        </button>
    </form>

</div>

<p class="text-xs text-gray-400 text-center mt-6">
    Si no encuentras el correo, revisa la carpeta de spam.
</p>
@endsection