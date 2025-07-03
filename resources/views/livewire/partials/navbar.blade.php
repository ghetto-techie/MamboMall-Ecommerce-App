<header class="sticky top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-900 dark:border-gray-800">
    <nav class="px-4 py-3 lg:px-6">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-[85rem]">
            <!-- Brand Logo -->
            <a href="/" class="flex items-center space-x-2">
                <span class="self-center text-xl font-bold whitespace-nowrap dark:text-white">MamboMall</span>
            </a>

            <!-- Mobile Menu Button -->
            <div class="flex items-center md:order-2 md:hidden">
                <!-- Cart Icon (Mobile) -->
                <a wire:navigate href="{{ route('cart') }}" class="p-2 mr-2 text-gray-700 rounded-lg dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span class="sr-only">Cart</span>
                </a>
                
                <!-- Mobile Menu Toggle -->
                <button data-collapse-toggle="mobile-menu" type="button" class="inline-flex items-center justify-center p-2 rounded-lg text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>

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
                            Products
                        </a>
                    </li>
                    
                    <!-- Cart Link -->
                    <li class="md:hidden">
                        <a wire:navigate href="{{ route('cart') }}" class="flex items-center py-2 pr-4 pl-3 text-gray-700 rounded md:p-0 dark:text-gray-400 dark:hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Cart
                        </a>
                    </li>
                    
                    <!-- Login/User Section -->
                    @guest
                        <li class="md:hidden">
                            <a wire:navigate href="{{ route('login') }}" class="block py-2 pr-4 pl-3 text-gray-700 rounded md:p-0 dark:text-gray-400 dark:hover:text-white">
                                Log in
                            </a>
                        </li>
                    @endguest
                    
                    @auth
                        <li class="md:hidden">
                            <a href="{{ route('profile.show') }}" class="block py-2 pr-4 pl-3 text-gray-700 rounded md:p-0 dark:text-gray-400 dark:hover:text-white">
                                Profile
                            </a>
                        </li>
                        <li class="md:hidden">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="block w-full text-left py-2 pr-4 pl-3 text-gray-700 rounded md:p-0 dark:text-gray-400 dark:hover:text-white">
                                    Logout
                                </button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>

            <!-- Right Side Icons (Desktop) -->
            <div class="hidden items-center md:flex md:order-2">
                <!-- Cart with Badge -->
                <a wire:navigate href="{{ route('cart') }}" class="p-2 mr-4 text-gray-700 rounded-lg dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 relative">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span class="absolute -top-1 -right-1 bg-blue-100 text-blue-800 text-xs font-bold px-2 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-100">4</span>
                    <span class="sr-only">Cart</span>
                </a>
                
            <!-- Login / User Dropdown -->
            @guest
                <div class="flex items-center space-x-3">
                    {{-- Log In --}}
                    <a wire:navigate href="{{ route('login') }}"
                    class="flex items-center text-white bg-brand hover:bg-brand-dark focus:ring-4 focus:ring-brand-accent font-medium rounded-lg text-sm px-4 py-2.5 dark:bg-brand dark:hover:bg-brand-dark dark:focus:ring-brand-accent focus:outline-none">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Log in
                    </a>

                    {{-- Register --}}
                    <a wire:navigate href="{{ route('register') }}"
                    class="flex items-center text-white bg-brand-accent hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-4 py-2.5 dark:bg-yellow-500 dark:hover:bg-yellow-600 focus:outline-none dark:focus:ring-yellow-400">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Register
                    </a>
                </div>
            @endguest

                
                @auth
                    <!-- User Dropdown -->
                    <button type="button" class="flex items-center text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                        <span class="sr-only">Open user menu</span>
                        <div class="relative inline-flex items-center justify-center w-8 h-8 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                            <span class="font-medium text-gray-600 dark:text-gray-300">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        </div>
                    </button>
                    
                    <!-- Dropdown Menu -->
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
                        <div class="px-4 py-3">
                            <span class="block text-sm text-gray-900 dark:text-white">{{ Auth::user()->name }}</span>
                            <span class="block text-sm text-gray-500 truncate dark:text-gray-400">{{ Auth::user()->email }}</span>
                        </div>
                        <ul class="py-2" aria-labelledby="user-menu-button">
                            <li>
                                <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Profile</a>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                        Sign out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth
            </div>
        </div>
    </nav>
</header>