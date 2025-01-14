<nav x-data="{ open: false, dropdown: false }" class="w-full fixed top-0 bg-[#00000010] backdrop-blur-lg z-10">
    <div class="container max-w-[1130px] mx-auto flex items-center justify-between h-[74px]">
        <div class="flex items-center gap-[26px]">
            <a wire:navigate href="{{ route('homePage') }}" class="flex w-[154px] shrink-0 items-center">
                <img src="{{ asset('assets/images/logos/logo.svg') }}" alt="logo">
            </a>
            <ul class="md:flex gap-6 items-center hidden">
                <li class="text-belibang-grey hover:text-belibang-light-grey transition-all duration-300">
                    <a wire:navigate href="{{ route('homePage') }}">Home</a>
                </li>
                <li class="text-belibang-grey hover:text-belibang-light-grey transition-all duration-300 relative"
                    @mouseenter="dropdown = true" @mouseleave="dropdown = false">
                    <button id="menu-button" class="flex items-center gap-1 focus:text-belibang-light-grey"
                        @click="dropdown = !dropdown">
                        <span>Categories</span>
                        <img src="{{ asset('assets/images/icons/arrow-down.svg') }}" alt="icon">
                    </button>
                    <div x-show="dropdown" x-transition
                        class="dropdown-menu absolute top-[52px] grid grid-cols-2 p-4 gap-[10px] w-[526px] rounded-[20px] bg-[#1E1E1E] border border-[#414141] z-[9999]">
                        <div
                            class="col-span-2 flex justify-between items-center rounded-2xl p-[12px_16px] border border-[#414141] hover:bg-[#2A2A2A] transition-all duration-300">
                            <div class="flex items-center">
                                <a href="" class="w-[58px] h-[58px] flex shrink-0 items-center">
                                    <img src="{{ asset('assets/images/icons/cart.svg') }}" alt="icon">
                                </a>
                                <a href="" class="flex flex-col">
                                    <p class="font-bold text-sm text-white">All Products</p>
                                    <p class="text-xs text-belibang-grey">Everything in One Place</p>
                                </a>
                            </div>
                            <div class="w-6 h-6 flex shrink-0">
                                <img src="{{ asset('assets/images/icons/crown.svg') }}" alt="icon">
                            </div>
                        </div>
                        <div
                            class="flex justify-between items-center rounded-2xl p-[12px_16px] border border-[#414141] hover:bg-[#2A2A2A] transition-all duration-300">
                            <div class="flex items-center">
                                <a href="" class="w-[58px] h-[58px] flex shrink-0 items-center">
                                    <img src="{{ asset('assets/images/icons/laptop.svg') }}" alt="icon">
                                </a>
                                <a href="" class="flex flex-col">
                                    <p class="font-bold text-sm text-white">Templates</p>
                                    <p class="text-xs text-belibang-grey">Designs Made Easy</p>
                                </a>
                            </div>
                        </div>
                        <div
                            class="flex justify-between items-center rounded-2xl p-[12px_16px] border border-[#414141] hover:bg-[#2A2A2A] transition-all duration-300">
                            <div class="flex items-center">
                                <a href="" class="w-[58px] h-[58px] flex shrink-0 items-center">
                                    <img src="{{ asset('assets/images/icons/hat.svg') }}" alt="icon">
                                </a>
                                <a href="" class="flex flex-col">
                                    <p class="font-bold text-sm text-white">Courses</p>
                                    <p class="text-xs text-belibang-grey">Expand Your Skills</p>
                                </a>
                            </div>
                        </div>
                        <div
                            class="flex justify-between items-center rounded-2xl p-[12px_16px] border border-[#414141] hover:bg-[#2A2A2A] transition-all duration-300">
                            <div class="flex items-center">
                                <a href="" class="w-[58px] h-[58px] flex shrink-0 items-center">
                                    <img src="{{ asset('assets/images/icons/book.svg') }}" alt="icon">
                                </a>
                                <a href="" class="flex flex-col">
                                    <p class="font-bold text-sm text-white">Ebooks</p>
                                    <p class="text-xs text-belibang-grey">Read and Learn</p>
                                </a>
                            </div>
                        </div>
                        <div
                            class="flex justify-between items-center rounded-2xl p-[12px_16px] border border-[#414141] hover:bg-[#2A2A2A] transition-all duration-300">
                            <div class="flex items-center">
                                <a href="" class="w-[58px] h-[58px] flex shrink-0 items-center">
                                    <img src="{{ asset('assets/images/icons/pen.svg') }}" alt="icon">
                                </a>
                                <a href="" class="flex flex-col">
                                    <p class="font-bold text-sm text-white">Fonts</p>
                                    <p class="text-xs text-belibang-grey">Typography Selection</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="text-belibang-grey hover:text-belibang-light-grey transition-all duration-300">
                    <a href="">Stories</a>
                </li>
                <li class="text-belibang-grey hover:text-belibang-light-grey transition-all duration-300">
                    <a href="">Benefits</a>
                </li>
                <li class="text-belibang-grey hover:text-belibang-light-grey transition-all duration-300">
                    <a href="">About</a>
                </li>
            </ul>
        </div>

        <div class="block md:hidden">
            <button @click="open = !open">
                <svg class="w-6 h-6 text-white hover:text-belibang-800 dark:text-white" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M18 6h-8m8 4H6m12 4h-8m8 4H6" />
                </svg>
            </button>
        </div>

        <div class="gap-6 items-center hidden md:flex">
            @guest
                <a wire:navigate href="{{ route('login') }}"
                    class="text-belibang-grey hover:text-belibang-light-grey transition-all duration-300">Log
                    in</a>
                <a wire:navigate href="{{ route('register') }}"
                    class="p-[8px_16px] w-fit h-fit rounded-[12px] text-belibang-grey border border-belibang-dark-grey hover:bg-[#2A2A2A] hover:text-white transition-all duration-300">Sign
                    up</a>
            @endguest

            @auth
                @hasrole('Admin')
                    <a wire:navigate href="{{ route('productList') }}"
                        class="p-[8px_16px] w-fit h-fit rounded-[12px] text-belibang-grey border border-belibang-dark-grey hover:bg-[#2A2A2A] hover:text-white transition-all duration-300">
                        Dashboard
                    </a>
                @endhasrole
            @endauth
        </div>
    </div>

    <div x-show="open" @click.away="open = false" class="md:hidden">
        <ul
            class="flex flex-col items-start gap-6 p-4 bg-[#00000010] backdrop-blur-lg border-t border-belibang-dark-grey">
            <li class="text-belibang-grey hover:text-belibang-light-grey transition-all duration-300">
                <a href="{{ route('homePage') }}">Home</a>
            </li>
            <li class="text-belibang-grey hover:text-belibang-light-grey transition-all duration-300 relative">
                <button id="menu-button" class="flex items-center gap-1 focus:text-belibang-light-grey"
                    @click="dropdown = !dropdown">
                    <span>Categories</span>
                    <img src="{{ asset('assets/images/icons/arrow-down.svg') }}" alt="icon">
                </button>
                <div x-show="dropdown" x-transition
                    class="dropdown-menu mt-2 grid grid-cols-2 p-4 gap-[10px] w-full rounded-[20px] bg-[#1E1E1E] border border-[#414141] z-10">
                    <div
                        class="col-span-2 flex justify-between items-center rounded-2xl p-[12px_16px] border border-[#414141] hover:bg-[#2A2A2A] transition-all duration-300">
                        <div class="flex items-center">
                            <a href="" class="w-[58px] h-[58px] flex shrink-0 items-center">
                                <img src="{{ asset('assets/images/icons/cart.svg') }}" alt="icon">
                            </a>
                            <a href="" class="flex flex-col">
                                <p class="font-bold text-sm text-white">All Products</p>
                                <p class="text-xs text-belibang-grey">Everything in One Place</p>
                            </a>
                        </div>
                        <div class="w-6 h-6 flex shrink-0">
                            <img src="{{ asset('assets/images/icons/crown.svg') }}" alt="icon">
                        </div>
                    </div>
                    <div
                        class="flex justify-between items-center rounded-2xl p-[12px_16px] border border-[#414141] hover:bg-[#2A2A2A] transition-all duration-300">
                        <div class="flex items-center">
                            <a href="" class="w-[58px] h-[58px] flex shrink-0 items-center">
                                <img src="{{ asset('assets/images/icons/laptop.svg') }}" alt="icon">
                            </a>
                            <a href="" class="flex flex-col">
                                <p class="font-bold text-sm text-white">Templates</p>
                                <p class="text-xs text-belibang-grey">Designs Made Easy</p>
                            </a>
                        </div>
                    </div>
                    <div
                        class="flex justify-between items-center rounded-2xl p-[12px_16px] border border-[#414141] hover:bg-[#2A2A2A] transition-all duration-300">
                        <div class="flex items-center">
                            <a href="" class="w-[58px] h-[58px] flex shrink-0 items-center">
                                <img src="{{ asset('assets/images/icons/hat.svg') }}" alt="icon">
                            </a>
                            <a href="" class="flex flex-col">
                                <p class="font-bold text-sm text-white">Courses</p>
                                <p class="text-xs text-belibang-grey">Expand Your Skills</p>
                            </a>
                        </div>
                    </div>
                    <div
                        class="flex justify-between items-center rounded-2xl p-[12px_16px] border border-[#414141] hover:bg-[#2A2A2A] transition-all duration-300">
                        <div class="flex items-center">
                            <a href="" class="w-[58px] h-[58px] flex shrink-0 items-center">
                                <img src="{{ asset('assets/images/icons/book.svg') }}" alt="icon">
                            </a>
                            <a href="" class="flex flex-col">
                                <p class="font-bold text-sm text-white">Ebooks</p>
                                <p class="text-xs text-belibang-grey">Read and Learn</p>
                            </a>
                        </div>
                    </div>
                    <div
                        class="flex justify-between items-center rounded-2xl p-[12px_16px] border border-[#414141] hover:bg-[#2A2A2A] transition-all duration-300">
                        <div class="flex items-center">
                            <a href="" class="w-[58px] h-[58px] flex shrink-0 items-center">
                                <img src="{{ asset('assets/images/icons/pen.svg') }}" alt="icon">
                            </a>
                            <a href="" class="flex flex-col">
                                <p class="font-bold text-sm text-white">Fonts</p>
                                <p class="text-xs text-belibang-grey">Typography Selection</p>
                            </a>
                        </div>
                    </div>
                </div>
            </li>
            <li class="text-belibang-grey hover:text-belibang-light-grey transition-all duration-300">
                <a href="">Stories</a>
            </li>
            <li class="text-belibang-grey hover:text-belibang-light-grey transition-all duration-300">
                <a href="">Benefits</a>
            </li>
            <li class="text-belibang-grey hover:text-belibang-light-grey transition-all duration-300">
                <a href="">About</a>
            </li>

            @guest
                <li class="w-full">
                    <a wire:navigate href="{{ route('register') }}"
                        class="block p-[8px_16px] w-full h-fit rounded-[12px] text-belibang-grey border border-belibang-dark-grey text-center hover:bg-[#2A2A2A] hover:text-white transition-all duration-300">
                        Sign up
                    </a>
                </li>

                <li class="w-full">
                    <a wire:navigate href="{{ route('login') }}"
                        class="block p-[8px_16px] w-full h-fit rounded-[12px] text-belibang-grey border border-belibang-dark-grey text-center hover:bg-[#2A2A2A] hover:text-white transition-all duration-300">
                        Login
                    </a>
                </li>
            @endguest

            @auth
                @hasrole('Admin')
                    <li class="w-full">
                        <a wire:navigate href="{{ route('productList') }}"
                            class="block p-[8px_16px] w-full h-fit rounded-[12px] text-belibang-grey border border-belibang-dark-grey text-center hover:bg-[#2A2A2A] hover:text-white transition-all duration-300">
                            Dashboard
                        </a>
                    </li>
                @endhasrole
            @endauth
        </ul>
    </div>
</nav>
