<!-- Navbar -->
<nav x-data="{ open: false }"
    class="bg-white border-b border-gray-200 px-4 py-2.5 dark:bg-gray-800 dark:border-gray-700 fixed left-0 right-0 top-0 z-50">
    <div class="flex flex-wrap justify-between items-center lg:container">
        <div class="flex justify-start items-center">
            <!-- Button to toggle sidebar -->
            <button @click="toggleSidebar"
                class="p-2 mr-2 text-gray-600 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100 focus:bg-gray-100 dark:focus:bg-gray-700 focus:ring-2 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white block md:hidden">
                <svg x-show="!isSidebarOpen" aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                        clip-rule="evenodd"></path>
                </svg>
                <svg x-show="isSidebarOpen" aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Toggle sidebar</span>
            </button>
            <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" wire:navigate
                class="flex items-center justify-between mr-4">

                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Dashboard
                    Admin</span>
            </x-nav-link>
        </div>

        <div class="flex items-center lg:order-2">
            <div class="relative">
                <button @click="open = !open"
                    class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                    id="user-menu-button">
                    <span class="sr-only">Open user menu</span>
                    <img class="w-8 h-8 rounded-full"
                        src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/michael-gough.png"
                        alt="User Image">
                </button>
                <!-- Dropdown Menu -->
                <div x-show="open" class="absolute right-0 mt-2 w-56 bg-white rounded-md shadow-lg dark:bg-gray-700">
                    <div class="py-3 px-4">
                        <span
                            class="block text-sm font-semibold text-gray-900 dark:text-white">{{ Auth::User()->name }}</span>
                        <span
                            class="block text-sm text-gray-900 truncate dark:text-white">{{ Auth::User()->email }}</span>
                    </div>

                    <x-dropdown-link href="{{ route('homePage') }}" wire:navigate.hover>
                        {{ __('Home Page') }}
                    </x-dropdown-link>

                    <x-dropdown-link href="{{ route('setting') }}">
                        {{ __('Settings') }}
                    </x-dropdown-link>


                    <form method="POST" action="{{ route('logout') }}" x-data data-tooltip-target="Logout">
                        @csrf
                        <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                            {{ __('Logout') }}
                        </x-dropdown-link>
                    </form>

                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Overlay -->
<div x-show="isSidebarOpen && isMobile" @click="closeSidebar"
    class="fixed inset-0 bg-black bg-opacity-50 z-30 transition-opacity" x-cloak></div>
