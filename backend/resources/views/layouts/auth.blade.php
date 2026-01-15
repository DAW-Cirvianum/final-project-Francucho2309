<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('TopFlex_logo_1.png') }}">
    <title>@yield('title') | TopFlex</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
        <div class="flex justify-center mb-6">
            <img src="{{ asset('TopFlex_logo_1.png') }}" alt="TopFlex" class="h-14">
        </div>

        @yield('content')
    </div>
</body>
</html>