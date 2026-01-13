<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel de administración')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    
    <div class="flex h-screen">
        <!-- SIDEBAR -->
        <aside class="w-64 bg-gray-900 text-white flex flex-col">
            <div class="p-6 text-xl font-bold border-b border-gray-700">
                TopFlex
            </div>
            
            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ url('/admin/dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-700">
                    Dashboard
                </a>
                <a href="{{ route('users.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">
                    Usuarios
                </a>
                <a href="{{ route('leagues.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">
                    Ligas
                </a>
                <a href="{{ route('teams.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">
                    Equipos
                </a>
                <a href="{{ route('shirts.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700">
                    Camisetas
                </a>
            </nav>
        </aside>

        <!-- MAIN -->
        <div class="flex-1 flex flex-col">
            <header class="bg-white shadow px-6 py-6 flex justify-between items-center">
                <h1 class="text-xl font-semibold">
                    @yield('header', 'Panel de administración')
                </h1>

                <div class="relative">
                    <button onclick="document.getElementById('dropdown').classList.toggle('hidden')" class="flex items-center gap-2 focus:outline-none">
                        <span>{{ auth()->user()->name }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div id="dropdown" class="hidden absolute right-0 mt-2 w-40 bg-white rounded shadow border">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100">Perfil</a>
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="w-full text-left px-4 py-2 hover:bg-gray-100">Cerrar sesión</button>
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