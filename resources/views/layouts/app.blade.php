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

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gradient-to-br from-gray-100 via-gray-200 to-gray-300 min-h-screen">
<div class="flex flex-col min-h-screen">

    <!-- Navbar -->
    <header class="bg-white/90 backdrop-blur-md shadow-md">
        @include('layouts.navigation')
    </header>

    <!-- Page Heading -->
    @if (isset($header))
        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white shadow-md">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h1 class="text-2xl font-bold">{{ $header }}</h1>
            </div>
        </div>
    @endif

    <!-- Page Content -->
    <main class="flex-grow py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-lg p-6 transition duration-200 hover:shadow-xl">
                @yield('content')
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-300 py-4 mt-6">
        <div class="max-w-7xl mx-auto px-4 text-center text-sm">
            © {{ date('Y') }} {{ config('app.name', 'Laravel') }}. Barcha huquqlar himoyalangan.
        </div>
    </footer>

</div>
</body>
</html>

