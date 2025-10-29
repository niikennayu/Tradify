<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Tailwind CSS (Vite) -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Font Awesome (Ikon seperti WhatsApp) -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <!-- Alpine.js (Dropdown Breeze) -->
        <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

        <!-- Slick Carousel (Slideshow) -->
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

        @stack('head')
    </head>

    <body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">
        <div class="min-h-screen">
            
            {{-- Navbar tampil sesuai role --}}
            @if(Auth::check() && Auth::user()->role === 'admin')
                @include('layouts.navigation-admin')
            @else
                @include('layouts.navigation-user')
            @endif

            {{-- Page Heading --}}
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            {{-- Page Content --}}
            <main>
                {{ $slot }}
            </main>

            {{-- Floating WhatsApp Button --}}
            <a href="https://wa.me/6281234567890" target="_blank"
               class="fixed bottom-6 right-6 bg-green-500 text-white p-4 rounded-full shadow-lg hover:bg-green-600 transition-all duration-300 z-50"
               aria-label="WhatsApp">
                <i class="fab fa-whatsapp text-2xl"></i>
            </a>

            {{-- Footer --}}
            <footer class="bg-gray-800 text-white py-8 mt-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm">
                    <p>&copy; {{ date('Y') }} Tradify. All rights reserved.</p>
                    <div class="mt-2">
                        <a href="{{ route('terms') }}" class="text-gray-400 hover:text-white mx-2">Terms & Conditions</a>
                        <a href="{{ route('contact') }}" class="text-gray-400 hover:text-white mx-2">Contact Us</a>
                    </div>
                </div>
            </footer>
        </div>

        @stack('scripts')
    </body>
</html>
