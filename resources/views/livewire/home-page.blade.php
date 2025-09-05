<div>
    {{-- Hero Section Start --}}
    <div class="w-full min-h-screen bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-900 dark:to-gray-800 py-10 px-4 sm:px-6 lg:px-8 mx-auto">
        <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-4 md:gap-8 xl:gap-20 md:items-center">
                <div>
                    <h1 class="block text-3xl font-extrabold text-gray-900 sm:text-5xl lg:text-6xl lg:leading-tight dark:text-white">
                        Step into <span class="text-blue-600 dark:text-blue-400"> {{ config('app.name')}} </span>
                    </h1>
                    <p class="mt-3 text-lg text-gray-700 dark:text-gray-300">
                        Discover the latest sneakers, boots, slides, and streetwear essentials. From everyday classics to exclusive hype drops — your style starts here.
                    </p>

                    <div class="mt-7 flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('products') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-3.5 text-center inline-flex items-center gap-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition-colors duration-300">
                            Shop Now
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </a>
{{--
                        <a href="/releases" class="py-3.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 inline-flex items-center transition-colors duration-300">
                            Upcoming Drops
                        </a> --}}
                    </div>

                    <div class="mt-6 lg:mt-10 grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="bg-white border border-gray-200 rounded-lg p-5 shadow-sm dark:bg-gray-800 dark:border-gray-700">
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                <span class="font-bold text-gray-900 dark:text-white">Trusted by 10k+ sneakerheads</span> across Kenya
                            </p>
                        </div>
                        <div class="bg-white border border-gray-200 rounded-lg p-5 shadow-sm dark:bg-gray-800 dark:border-gray-700">
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                <span class="font-bold text-gray-900 dark:text-white">Exclusive Releases</span> you won’t find anywhere else
                            </p>
                        </div>
                    </div>
                </div>

<div class="relative ms-4">
    <img class="w-full rounded-lg transition-transform duration-500 hover:scale-[1.02]"
         src="{{ asset('images/hero-image.png') }}" alt="Sneaker Collection">
</div>

            </div>
        </div>
    </div>
    {{-- Hero Section End --}}

    {{-- Brand Section Start --}}
    <section class="py-20 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto text-center">
                <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white sm:text-5xl">
                    Shop by <span class="text-blue-600 dark:text-blue-400">Brand</span>
                </h1>
                <p class="mt-4 text-lg text-gray-600 dark:text-gray-300">
                    From Nike and Adidas to Jordan and Yeezy — find your favorite sneakers and streetwear brands.
                </p>
            </div>

            <div class="mt-16 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
                @if (count($brands) > 0)
                    @foreach ($brands as $brand)
                        <div wire:key="brand-{{ $brand->id }}"
                            class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden transition-transform duration-300 hover:scale-105 border border-gray-200 dark:border-gray-700">
                            <a wire:navigate href="/products?selected_brands[0]={{ $brand->id }}" class="block">
                                <div class="p-8 flex justify-center">
                                    <img src="{{ url('storage', $brand->image) }}" alt="{{ $brand->name }}" class="h-24 object-contain">
                                </div>
                                <div class="p-6 text-center bg-gray-50 dark:bg-gray-700">
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">{{ $brand->name }}</h3>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @else
                    <div class="col-span-4 text-center">
                        <p class="text-gray-500 dark:text-gray-400">No brands available at the moment.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>
    {{-- Brand Section End --}}

    {{-- Category Section Start --}}
    <section class="py-20 bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-800 dark:to-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Section Heading -->
        <div class="max-w-2xl mx-auto text-center">
        <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white sm:text-5xl">
            Shop by <span class="text-blue-600 dark:text-blue-400">Category</span>
        </h1>
        <p class="mt-4 text-lg text-gray-600 dark:text-gray-300">
            Sneakers, boots, slides, or luxury streetwear — we’ve got the right fit for you.
        </p>
        </div>

        <!-- Categories Grid -->
        <div class="mt-16 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach ($categories as $category)
            <a wire:navigate
            href="/products?selected_categories[0]={{ $category->id }}"
            class="group relative rounded-2xl overflow-hidden shadow-lg transition transform hover:scale-[1.02]">

            <!-- Category Background Image -->
            <div class="aspect-w-4 aspect-h-5 sm:aspect-h-6 bg-gray-200 dark:bg-gray-700">
                <img src="{{ url('storage', $category->image) }}"
                    alt="{{ $category->name }}"
                    class="w-full h-full object-cover object-center group-hover:opacity-90 transition duration-300">
            </div>

            <!-- Overlay with Category Name -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent flex items-end p-6">
                <h3 class="text-xl sm:text-2xl font-bold text-white drop-shadow">
                {{ $category->name }}
                </h3>
            </div>
            </a>
        @endforeach
        </div>

    </div>
    </section>
    {{-- Category Section End --}}


    {{-- Customer Reviews Section Start --}}
    <section class="py-20 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto text-center">
                <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white sm:text-5xl">
                    Sneakerhead <span class="text-blue-600 dark:text-blue-400">Reviews</span>
                </h1>
                <p class="mt-4 text-lg text-gray-600 dark:text-gray-300">
                    See why thousands of customers trust {{ config('app.name')}} for their footwear.
                </p>
            </div>

            <div class="mt-16 grid grid-cols-1 gap-8 md:grid-cols-2">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img class="h-14 w-14 rounded-full object-cover" src="https://i.postimg.cc/rF6G0Dh9/pexels-emmy-e-2381069.jpg" alt="Customer">
                                <div class="ml-4">
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Kevin</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Sneaker Enthusiast</p>
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Joined Jan 2023</p>
                        </div>
                        <p class="mt-4 text-gray-600 dark:text-gray-300">
                            "I got my Air Jordan 1s here — fast delivery and 100% authentic. Definitely my go-to sneaker store."
                        </p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img class="h-14 w-14 rounded-full object-cover" src="https://i.postimg.cc/5y3NRrbS/pexels-nappy-936119.jpg" alt="Customer">
                                <div class="ml-4">
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Amina</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Streetwear Lover</p>
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Joined Mar 2023</p>
                        </div>
                        <p class="mt-4 text-gray-600 dark:text-gray-300">
                            "Love the variety — from Nike Air Force to Yeezys. The sizes fit perfectly and customer support is amazing!"
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- Customer Reviews Section End --}}
</div>
