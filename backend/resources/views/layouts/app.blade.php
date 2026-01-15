<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('TopFlex_logo_1.png') }}">
    <title>@yield('title', 'Panel de administración')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    
    <div class="flex h-screen">
        <!-- SIDEBAR -->
        <aside class="w-64 bg-black text-white flex flex-col">
            <div class="p-6 text-xl font-bold border-b text-green-600 border-green-700">
                TopFlex
            </div>
            
            <nav class="flex-1 font-bold p-4 space-y-2">
                <a href="{{ url('/admin/dashboard') }}" class="block px-4 py-2 rounded hover:bg-zinc-900">
                    Dashboard
                </a>
                <a href="{{ route('users.index') }}" class="block px-4 py-2 rounded hover:bg-zinc-900">
                    Usuarios
                </a>
                <a href="{{ route('leagues.index') }}" class="block px-4 py-2 rounded hover:bg-zinc-900">
                    Ligas
                </a>
                <a href="{{ route('teams.index') }}" class="block px-4 py-2 rounded hover:bg-zinc-900">
                    Equipos
                </a>
                <a href="{{ route('shirts.index') }}" class="block px-4 py-2 rounded hover:bg-zinc-900">
                    Camisetas
                </a>
                <a href="{{ route('orders.index') }}" class="block px-4 py-2 rounded hover:bg-zinc-900">
                    Pedidos
                </a>
            </nav>
        </aside>

        <!-- MAIN -->
        <div class="flex-1 flex flex-col">
            <header class="bg-black shadow px-6 py-6 flex justify-between items-center">
                <h1 class="text-xl text-green-600 font-bold">
                    @yield('header', 'Panel de administración')
                </h1>

                <div class="relative text-green-600 font-bold">
                    <button onclick="document.getElementById('dropdown').classList.toggle('hidden')" class="flex items-center gap-2 focus:outline-none">
                        <span>{{ auth()->user()->name }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div id="dropdown" class="hidden absolute right-0 mt-2 w-40 bg-black rounded shadow border">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="w-full text-left px-4 py-2 hover:bg-zinc-900">Cerrar sesión</button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- CONTENT -->
            <main class="flex-1 p-6 overflow-y-auto">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>