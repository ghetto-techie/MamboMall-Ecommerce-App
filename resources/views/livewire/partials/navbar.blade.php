<header class="sticky top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-900 dark:border-gray-800">
    <nav class="px-4 py-3 lg:px-6">
        <div class="flex flex-wrap items-center justify-between mx-auto max-w-[85rem]">

            <!-- Brand Logo -->
            <a wire:navigate href="/" class="flex items-center space-x-2">
                <span class="self-center text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    {{ config('app.name') }}
                </span>
            </a>

            <!-- Desktop Menu -->
            <div class="hidden justify-between items-center w-full md:flex md:w-auto md:order-1" id="mobile-menu">
                <ul class="flex flex-col mt-4 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium">
                    <!-- Home Link -->
                    <li>
                        <a wire:navigate href="{{ route('home') }}" class="block py-2 pr-4 pl-3 rounded md:p-0 {{ request()->is('/') ? 'text-blue-700 dark:text-blue-500' : 'text-gray-700 hover:bg-gray-50 dark:text-gray-400 dark:hover:text-white md:hover:bg-transparent md:hover:text-blue-700 md:dark:hover:text-white dark:hover:bg-gray-700 md:dark:hover:bg-transparent' }}" aria-current="page">
                            Home
                        </a>
                    </li>

                    <!-- Categories Link -->
                    <li>
                        <a wire:navigate href="{{ route('categories') }}" class="block py-2 pr-4 pl-3 rounded md:p-0 {{ request()->is('categories') ? 'text-blue-700 dark:text-blue-500' : 'text-gray-700 hover:bg-gray-50 dark:text-gray-400 dark:hover:text-white md:hover:bg-transparent md:hover:text-blue-700 md:dark:hover:text-white dark:hover:bg-gray-700 md:dark:hover:bg-transparent' }}">
                            Categories
                        </a>
                    </li>

                    <!-- Products Link -->
                    <li>
                        <a wire:navigate href="{{ route('products') }}" class="block py-2 pr-4 pl-3 rounded md:p-0 {{ request()->is('products') ? 'text-blue-700 dark:text-blue-500' : 'text-gray-700 hover:bg-gray-50 dark:text-gray-400 dark:hover:text-white md:hover:bg-transparent md:hover:text-blue-700 md:dark:hover:text-white dark:hover:bg-gray-700 md:dark:hover:bg-transparent' }}">
                            Shop
                        </a>
                    </li>

                    <!-- About Link -->
                    <li>
                    <a href="#" data-modal-target="aboutModal" data-modal-toggle="aboutModal"
                        class="block py-2 pr-4 pl-3 rounded md:p-0 text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        About
                    </a>
                    </li>

                    <!-- Contact Link -->
                    <li>
                    <a href="#" data-modal-target="contactModal" data-modal-toggle="contactModal"
                        class="block py-2 pr-4 pl-3 rounded md:p-0 text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        Contact
                    </a>
                    </li>


                </ul>
            </div>


            <!-- Right Side Icons -->
            <div class="flex items-center space-x-3 md:order-2">
                <!-- Desktop Search Bar -->
                <form action="{{ route('products') }}" method="GET"
                    class="hidden md:flex items-center flex-1 max-w-lg mx-6">
                    <label for="search-navbar" class="sr-only">Search</label>
                    <div class="relative w-full">
                        <input type="text"
                            name="q"
                            value="{{ request('q') }}"
                            id="search-navbar"
                            class="block w-full p-2 pl-10 text-sm text-gray-700 border border-gray-300 rounded-lg bg-gray-50 focus:ring-brand focus:border-brand dark:bg-gray-800 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-brand-accent dark:focus:border-brand-accent"
                            placeholder="Search sneakers, brands...">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500 dark:text-gray-400">
                            <!-- Search Icon -->
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z"/>
                            </svg>
                        </div>
                    </div>
                </form>

                {{-- Visible search bar on mobile, hidden on desktop --}}
                <form action="{{ route('products') }}" method="GET" class="flex items-center w-full mt-2 md:hidden">
                    <label for="mobile-search" class="sr-only">Search</label>
                    <div class="relative w-full">
                        <input type="text" name="q" id="mobile-search" value="{{ request('q') }}"
                            class="block w-full pl-10 pr-3 py-2 text-sm border rounded-lg bg-gray-50 text-gray-700
                                focus:ring-brand focus:border-brand
                                dark:bg-gray-800 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white"
                            placeholder="Search sneakers...">
                        <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none text-gray-500 dark:text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z"/>
                            </svg>
                        </div>
                    </div>
                </form>
                <!-- Cart with Badge -->
                <a wire:navigate href="{{ route('cart') }}"
                    class="relative p-2 text-gray-700 rounded-lg dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7
                            13l-2.293 2.293c-.63.63-.184 1.707.707
                            1.707H17m0 0a2 2 0 100 4 2 2
                            0 000-4zm-8 2a2 2 0 11-4 0
                            2 2 0 014 0z"/>
                    </svg>
                    <span
                        class="absolute -top-1 -right-1 bg-brand-accent text-white text-xs font-bold px-1.5 py-0.5 rounded-full">
                        {{ $total_count ?? 0 }}
                    </span>
                    <span class="sr-only">Cart</span>
                </a>

                {{-- <!-- Dark Mode Toggle -->
                <button id="theme-toggle" type="button"
                    class="p-2 text-gray-700 rounded-lg dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                    <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 3.22l.61 1.56a1 1 0 001.28.57l1.56-.61-1.56-.61a1 1
                            0 00-1.28.57L10 3.22zm0
                            13.56l-.61-1.56a1 1 0
                            00-1.28-.57l-1.56.61
                            1.56.61a1 1 0
                            001.28-.57L10 16.78z"/>
                    </svg>
                    <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M17.293 13.293A8 8 0
                            116.707 2.707a8.003 8.003
                            0 0010.586 10.586z"/>
                    </svg>
                </button> --}}

                <!-- Auth Buttons / User Dropdown -->
                @guest
                    <a wire:navigate href="{{ route('login') }}"
                        class="hidden md:flex items-center px-4 py-2 text-sm font-medium text-white bg-brand rounded-lg hover:bg-brand-dark focus:ring-4 focus:ring-brand-accent dark:bg-brand dark:hover:bg-brand-dark">
                        Login
                    </a>
                @endguest

                @auth
                    <!-- User Avatar Dropdown -->
                    <button type="button"
                        class="flex items-center text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                        id="user-menu-button" aria-expanded="false"
                        data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                        <span class="sr-only">Open user menu</span>
                        <div
                            class="w-8 h-8 flex items-center justify-center text-white bg-brand-accent rounded-full">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    </button>

                    <!-- Dropdown -->
                    <div id="user-dropdown"
                        class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-lg dark:bg-gray-700 dark:divide-gray-600">
                        <div class="px-4 py-3">
                            <span class="block text-sm text-gray-900 dark:text-white">
                                {{ Auth::user()->name }}
                            </span>
                            <span class="block text-sm text-gray-500 truncate dark:text-gray-400">
                                {{ Auth::user()->email }}
                            </span>
                        </div>
                        <ul class="py-2">
                            <li>
                                <a wire:navigate href="{{ route('profile.show') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600">
                                    Account Settings
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600">
                                        Sign out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth

                <!-- Mobile Menu Toggle -->
                <button data-collapse-toggle="mobile-menu" type="button"
                    class="inline-flex items-center p-2 text-gray-500 rounded-lg md:hidden hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M3 5h14a1 1 0 010 2H3a1 1 0
                            010-2zm0 5h14a1 1 0 010
                            2H3a1 1 0 010-2zm0
                            5h14a1 1 0 010
                            2H3a1 1 0
                            010-2z"
                            clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>

            <!-- Mobile Dropdown Menu -->
            <div class="hidden w-full md:hidden" id="mobile-menu">
                <ul class="flex flex-col space-y-2 mt-4 text-sm font-medium">
                    <li>
                        <a wire:navigate href="{{ route('home') }}"
                            class="block px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                            Home
                        </a>
                    </li>
                    <li>
                        <a wire:navigate href="{{ route('categories') }}"
                            class="block px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                            Categories
                        </a>
                    </li>
                    <li>
                        <a wire:navigate href="{{ route('products') }}"
                            class="block px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                            Products
                        </a>
                    </li>

                    @guest
                        <li>
                            <a wire:navigate href="{{ route('login') }}"
                                class="block px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                Login
                            </a>
                        </li>
                        <li>
                            <a wire:navigate href="{{ route('register') }}"
                                class="block px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                Register
                            </a>
                        </li>
                    @endguest
                    @auth
                        <li>
                            <a wire:navigate href="{{ route('profile.show') }}"
                                class="block px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                Account Settings
                            </a>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="block w-full text-left px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                    Logout
                                </button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</header>


