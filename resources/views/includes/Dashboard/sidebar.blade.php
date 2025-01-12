@php
    $isOpenAuthActive =
        request()->routeIs('authentication.roles.index') ||
        request()->routeIs('authentication.permissions.index') ||
        request()->routeIs('authentication.users.index');
    $isOverview = request()->routeIs('dashboard');
    $isSales = request()->routeIs('productList') || request()->routeIs('categoryList');
@endphp

<aside x-data="{ openPages: false, openAuth: false, openSales: false }"
    :class="{ '-translate-x-full': !isSidebarOpen && isMobile, 'translate-x-0': isSidebarOpen || !isMobile }"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-14 transition-transform bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    <div class="overflow-y-auto py-5 px-3 h-full bg-white dark:bg-gray-800">
        <ul class="space-y-2">
            <li>
                <a href="{{ route('dashboard') }}" wire:navigate.hover
                    class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg  group {{ $isOverview ? 'dark:text-white hover:bg-blue-600 dark:hover:bg-gray-700 bg-blue-500 text-white' : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                    <svg aria-hidden="true"
                        class="w-6 h-6  transition duration-75 
                        {{ $isOverview ? 'text-gray-100 dark:text-white' : 'text-gray-500 dark:text-gray-400 group-hover:text-gray-500' }}"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                    </svg>
                    <span class="ml-3">Overview</span>
                </a>
            </li>

            <li>
                <button type="button" @click="openSales = !openSales"
                    class="flex items-center p-2 w-full text-base font-medium rounded-lg transition duration-75 group 
                        {{ $isSales ? 'dark:text-white hover:bg-blue-600 dark:hover:bg-gray-700 bg-blue-500 text-white' : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                    <svg aria-hidden="true"
                        class="w-6 h-6 transition duration-75  dark:group-hover:text-white
                            {{ $isSales ? 'text-gray-100 dark:text-white' : 'text-gray-500 dark:text-gray-400 group-hover:text-gray-500' }}"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="flex-1 ml-3 text-left">Sales</span>
                    <svg x-show="!openSales"
                        class="w-6 h-6 {{ $isSales ? 'text-gray-100 dark:text-white' : 'text-gray-800 dark:text-white' }}w-6 h-6  transition-transform"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7.119 8h9.762a1 1 0 0 1 .772 1.636l-4.881 5.927a1 1 0 0 1-1.544 0l-4.88-5.927A1 1 0 0 1 7.118 8Z" />
                    </svg>
                    <svg x-show="openSales"
                        class="{{ $isSales ? 'text-gray-100 dark:text-white' : 'text-gray-800 dark:text-white' }}w-6 h-6  transition-transform"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16.881 16H7.119a1 1 0 0 1-.772-1.636l4.881-5.927a1 1 0 0 1 1.544 0l4.88 5.927a1 1 0 0 1-.77 1.636Z" />
                    </svg>
                </button>
                <ul x-show="openSales" class="py-2 space-y-2 pl-11 transition-all duration-300 ease-in-out" x-cloak>
                    <li>
                        <x-sidebar-link href="{{ route('productList') }}" :active="request()->routeIs('productList')">
                            Products
                        </x-sidebar-link>
                    </li>

                    <li>
                        <x-sidebar-link href="{{ route('categoryList') }}" :active="request()->routeIs('categoryList')">
                            Categories
                        </x-sidebar-link>
                    </li>

                </ul>
            </li>

            <li>
                <button type="button" @click="openAuth = !openAuth"
                    class="flex items-center p-2 w-full text-base font-medium rounded-lg transition duration-75 group 
                        {{ $isOpenAuthActive ? 'dark:text-white hover:bg-blue-600 dark:hover:bg-gray-700 bg-blue-500 text-white' : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}">

                    <svg class="w-6 h-6 transition duration-75  dark:group-hover:text-white
                            {{ $isOpenAuthActive ? 'text-gray-100 dark:text-white' : 'text-gray-500 dark:text-gray-400 group-hover:text-gray-500' }}"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-width="2"
                            d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    <span class="flex-1 ml-3 text-left">Authentication</span>
                    <svg x-show="!openAuth"
                        class="w-6 h-6 {{ $isOpenAuthActive ? 'text-gray-100 dark:text-white' : 'text-gray-800 dark:text-white' }}w-6 h-6  transition-transform"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7.119 8h9.762a1 1 0 0 1 .772 1.636l-4.881 5.927a1 1 0 0 1-1.544 0l-4.88-5.927A1 1 0 0 1 7.118 8Z" />
                    </svg>
                    <svg x-show="openAuth" {{-- text-gray-800 dark:text-white --}}
                        class="{{ $isOpenAuthActive ? 'text-gray-100 dark:text-white' : 'text-gray-800 dark:text-white' }}w-6 h-6  transition-transform"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16.881 16H7.119a1 1 0 0 1-.772-1.636l4.881-5.927a1 1 0 0 1 1.544 0l4.88 5.927a1 1 0 0 1-.77 1.636Z" />
                    </svg>
                </button>
                <ul x-show="openAuth" class="py-2 space-y-2 pl-11 transition-all duration-300 ease-in-out" x-cloak>
                    <li>
                        <x-sidebar-link href="{{ route('authentication.users.index') }}" :active="request()->routeIs('authentication.users.index')">
                            User
                        </x-sidebar-link>
                    </li>

                    <li>
                        <x-sidebar-link href="{{ route('authentication.roles.index') }}" :active="request()->routeIs('authentication.roles.index')">
                            Roles
                        </x-sidebar-link>
                    </li>

                    <li>
                        <x-sidebar-link href="{{ route('authentication.permissions.index') }}" :active="request()->routeIs('authentication.permissions.index')">
                            Permissions
                        </x-sidebar-link>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#"
                    class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg aria-hidden="true"
                        class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z">
                        </path>
                        <path
                            d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z">
                        </path>
                    </svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Messages</span>
                    <span
                        class="inline-flex justify-center items-center w-5 h-5 text-xs font-semibold rounded-full text-primary-800 bg-primary-100 dark:bg-primary-200 dark:text-primary-800">
                        4
                    </span>
                </a>
            </li>

            <ul class="pt-5 mt-5 space-y-2 border-t border-gray-200 dark:border-gray-700">
            </ul>
        </ul>
    </div>

    <div
        class="hidden absolute bottom-0 left-0 justify-center items-center p-4 space-x-4 w-full lg:flex bg-white dark:bg-gray-800 z-20">

        <a wire:navigate href="{{ route('setting') }}" data-tooltip-target="tooltip-settings"
            class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer dark:text-gray-400 dark:hover:text-white hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-600">
            <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                    clip-rule="evenodd"></path>
            </svg>
        </a>
        <div id="tooltip-settings" role="tooltip"
            class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip">
            Settings page
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>

        <form method="POST" action="{{ route('logout') }}" x-data data-tooltip-target="Logout"
            class="inline-flex justify-center  text-gray-500 rounded cursor-pointer dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-600">
            @csrf
            <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                <svg aria-hidden="true" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                    </path>
                </svg>
            </x-dropdown-link>
        </form>

        <div id="Logout" role="tooltip"
            class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip">
            Logout
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
    </div>
</aside>
