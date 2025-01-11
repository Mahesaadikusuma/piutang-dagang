<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
    @stack('style')
</head>

<body class="font-sans antialiased">


    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        {{-- @livewire('navigation-menu') --}}
        {{-- Navbar --}}
        @include('includes.Dashboard.navbar')
        {{-- Navbar --}}


        {{-- Sidebar --}}
        @include('includes.Dashboard.sidebar')


        <!-- Page Content -->
        <main class="p-4 md:ml-64 h-auto  pt-20">
            {{ $slot }}
        </main>
    </div>
    
    <x-toaster-hub />
    @stack('modals')

    @stack('script')
    @livewireScripts
</body>

</html>
