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
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
    @stack('style')
</head>

<body class="font-sans antialiased">
    <div x-data="sidebar()" x-init="init()" class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('includes.Dashboard.navbar')

        <!-- Sidebar -->
        @include('includes.Dashboard.sidebar')

        <main class="p-4 md:ml-64 h-auto pt-20">
            {{ $slot }}
        </main>
    </div>

    <script>
        function sidebar() {
            return {
                isSidebarOpen: false,
                isMobile: window.innerWidth < 768,
                toggleSidebar() {
                    this.isSidebarOpen = !this.isSidebarOpen;
                },
                closeSidebar() {
                    if (this.isMobile) {
                        this.isSidebarOpen = false;
                    }
                },
                init() {
                    window.addEventListener('resize', () => {
                        this.isMobile = window.innerWidth < 768;
                        if (!this.isMobile) {
                            this.isSidebarOpen = true; // Show sidebar by default on desktop
                        }
                    });
                },
            };
        }
    </script>

    <x-toaster-hub />
    @stack('modals')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>

    @stack('scripts')
    @livewireScripts
</body>

</html>
