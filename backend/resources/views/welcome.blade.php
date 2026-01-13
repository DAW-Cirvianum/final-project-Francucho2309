<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TopFlex</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded shadow text-center w-full max-w-md">
        <h1 class="text-3xl font-bold mb-6">TopFlex</h1>

        @auth
            <p class="mb-4">Bienvenido, {{ auth()->user()->name }}</p>

            <a href="{{ url('/dashboard') }}"
               class="block bg-blue-600 text-white px-4 py-2 rounded mb-2">
                Dashboard
            </a>

            @if(auth()->user()->role === 'admin')
                <a href="{{ url('/admin/dashboard') }}"
                   class="block bg-gray-800 text-white px-4 py-2 rounded">
                    Panel Admin
                </a>
            @endif
        @else
            <a href="{{ route('login') }}"
               class="block bg-blue-600 text-white px-4 py-2 rounded mb-2">
                Iniciar sesión
            </a>
        @endauth
    </div>
</body>
</html>