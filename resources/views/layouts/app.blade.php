<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

      <title>{{ config('app.name', 'Ghetto Techie Ecommerce') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased bg-gray-100 dark:bg-gray-800">
        <!-- <x-banner /> -->
        @livewire('partials.navbar')

        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <!-- About Modal -->
        <div id="aboutModal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex justify-center items-center w-full h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-lg max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
            <!-- Close button -->
            <button type="button" class="absolute top-3 right-3 text-gray-400 hover:text-gray-900 dark:hover:text-white"
                    data-modal-hide="aboutModal">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1
                0 111.414 1.414L11.414 10l4.293 4.293a1 1
                0 01-1.414 1.414L10 11.414l-4.293
                4.293a1 1 0 01-1.414-1.414L8.586
                10 4.293 5.707a1 1 0
                010-1.414z" clip-rule="evenodd"/>
                </svg>
            </button>

            <!-- Modal header -->
            <div class="p-6 text-center">
                <h3 class="mb-4 text-2xl font-bold text-gray-900 dark:text-white">
                {{ config('app.name') }}
                </h3>
                <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                Welcome to <strong>{{ config('app.name') }}</strong>, your trusted destination for premium sneakers & streetwear.
                Our mission is to bring you the latest and most iconic footwear while delivering a seamless shopping experience.
                </p>
            </div>
            </div>
        </div>
        </div>

            <!-- Contact Modal -->
            <div id="contactModal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full">
                <div class="relative p-4 w-full max-w-md">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <div class="flex items-center justify-between p-4 border-b dark:border-gray-600">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Contact Us</h3>
                            <button type="button" data-modal-toggle="contactModal"
                                class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg p-2 dark:hover:bg-gray-600">
                                ✕
                            </button>
                        </div>

                        @livewire('contact-form')

                        <!-- Social Links -->
                        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-600 flex justify-center space-x-6">
                            <a href="https://facebook.com" class="text-gray-500 hover:text-blue-600"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://instagram.com" class="text-gray-500 hover:text-pink-500"><i class="fab fa-instagram"></i></a>
                            <a href="https://whatsapp.com" class="text-gray-500 hover:text-green-500"><i class="fab fa-whatsapp"></i></a>
                            <a href="https://telegram.org" class="text-gray-500 hover:text-blue-400"><i class="fab fa-telegram-plane"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        @stack('modals')
        @livewire('partials.footer')
        @livewireScripts
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
        <script>
            document.addEventListener("livewire:navigated", () => {
                if (window.initFlowbite) {
                    initFlowbite();
                }
            });

            document.addEventListener("livewire:update", () => {
                if (window.initFlowbite) {
                    initFlowbite();
                }
            });
        </script>

    </body>
</html>
