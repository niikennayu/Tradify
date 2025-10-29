<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - adaTradify</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    {{-- Navbar khusus admin --}}
    @include('layouts.navigation-admin')

    {{-- Konten utama --}}
    <div class="min-h-screen p-6">
        @yield('content')
    </div>
</body>
</html>
