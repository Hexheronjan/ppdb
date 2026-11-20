<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

       <title>@yield('title', 'Aplikasi PPDB')</title> {{-- Default title jika kosong --}}
        <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/icon-p.png')}}" />
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="pb-20 lg:pb-0" style="padding-bottom: 80px;">
                {{ $slot }}
            </main>
            <div class="block lg:hidden fixed bottom-0 left-0 right-0 bg-white shadow-[0_-4px_10px_rgba(0,0,0,0.1)] z-50 border-t border-gray-200">
                <nav class="flex justify-around items-center py-2">
                    <!-- Home -->
                    <a class="flex flex-col items-center text-gray-600 hover:text-[#0694a2] transition duration-300 group" 
                       href="{{ route('user.dashboard') }}">
                        <div class="p-2 rounded-full group-hover:bg-[#0694a2] group-hover:text-white transition duration-300">
                            <i class="fas fa-home text-xl"></i>
                        </div>
                        <span class="text-xs font-medium">Home</span>
                    </a>
                    
                    <!-- Riwayat -->
                    <a class="flex flex-col items-center text-gray-600 hover:text-[#0694a2] transition duration-300 group"
                       href="{{ route('user.form.history') }}">
                        <div class="p-2 rounded-full group-hover:bg-[#0694a2] group-hover:text-white transition duration-300">
                            <i class="fas fa-chalkboard text-xl"></i>
                        </div>
                        <span class="text-xs font-medium">Riwayat</span>
                    </a>
            
                    <!-- Profil -->
                    <a class="flex flex-col items-center text-gray-600 hover:text-[#0694a2] transition duration-300 group"
                       href="{{ route('user.profile.edit') }}">
                        <div class="p-2 rounded-full group-hover:bg-[#0694a2] group-hover:text-white transition duration-300">
                            <i class="fas fa-user text-xl"></i>
                        </div>
                        <span class="text-xs font-medium">Profil</span>
                    </a>
                    
                    <!-- Logout -->
                    <a class="flex flex-col items-center text-gray-600 hover:text-[#ff5a5a] transition duration-300 group"
                       href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <div class="p-2 rounded-full group-hover:bg-[#ff5a5a] group-hover:text-white transition duration-300">
                            <i class="fas fa-sign-out-alt text-xl"></i>
                        </div>
                        <span class="text-xs font-medium">Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </nav>
            </div>
            
        </div>
    </body>
</html>
