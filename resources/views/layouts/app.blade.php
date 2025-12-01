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
    <body class="font-sans antialiased bg-gray-50">
        <div class="min-h-screen flex flex-col">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow-sm border-b border-gray-200">
                    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-1">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-gray-800 text-gray-300 text-center py-6 border-t border-gray-700 mt-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <p class="text-sm">© 2025 Sistem Logistik Polres. All rights reserved.</p>
                </div>
            </footer>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            // Cek apakah ada session 'success' dari Controller
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'BERHASIL!',
                    text: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 2000,
                    position: 'top-end',
                    toast: true
                });
            @endif

            // Cek apakah ada session 'error' (Misal stok kurang)
            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'GAGAL!',
                    text: "{{ session('error') }}",
                    position: 'top-end',
                    toast: true
                });
            @endif
        </script>

    </body>
</html>
