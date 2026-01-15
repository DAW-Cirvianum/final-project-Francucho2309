<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('TopFlex_logo_1.png') }}">
    <title>TopFlex</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full text-center">
        <div class="flex justify-center mb-4">
            <img src="{{ asset('TopFlex_logo_1.png') }}" alt="TopFlex" class="h-16">
        </div>

        <h1 class="text-3xl font-bold mb-2">TopFlex</h1>
        <p class="text-gray-600 mb-6">
            Gestión y venta de camisetas de fútbol.
        </p>

        <div class="space-y-3">
            @auth
            <a href="{{ route('admin.dashboard') }}" class="block bg-green-600 text-white py-2 rounded hover:bg-green-700">Ir al panel</a>
            @else
            <a href="{{ route('login') }}" class="block bg-green-600 text-white py-2 rounded hover:bg-green-700">Iniciar sesión</a>
            <a href="{{ route('register') }}" class="block bg-green-600 text-white py-2 rounded hover:bg-green-700">Registrate</a>
            @endauth
        </div>

        <p class="text-xs text-gray-400 mt-6">Franco Ramos - Laravel - 2do DAW</p>
    </div>
</body>
</html>