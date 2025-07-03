<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <section class="py-8 bg-white dark:bg-gray-900 rounded-2xl shadow-sm">
    <div class="px-4 py-4 mx-auto max-w-7xl md:px-6">
      <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar Filters -->
        <div class="w-full lg:w-1/4">
          <div class="sticky top-24 space-y-6">
            <!-- Search Filter -->
            <div class="p-5 bg-white dark:bg-gray-800 rounded-2xl shadow border border-gray-200 dark:border-gray-700">
              <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Search Products</h3>
              <div class="relative">
                <input type="text" placeholder="Search products..." class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <svg class="w-5 h-5 absolute left-3 top-2.5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
              </div>
            </div>

            <!-- Categories Filter -->
            <div class="p-5 bg-white dark:bg-gray-800 rounded-2xl shadow border border-gray-200 dark:border-gray-700">
              <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Categories</h3>
              <ul class="space-y-3">
                @foreach($categories as $category)
                <li wire:key="{{ $category->id }}">
                  <div class="flex items-center p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                    <input id="{{ $category->slug }}" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="{{ $category->slug }}" class="ms-3 text-gray-700 dark:text-gray-300 cursor-pointer">
                      {{ $category->name }}
                    </label>
                  </div>
                </li>
                @endforeach
              </ul>
            </div>

            <!-- Brand Filter -->
            <div class="p-5 bg-white dark:bg-gray-800 rounded-2xl shadow border border-gray-200 dark:border-gray-700">
              <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Brand</h3>
              <ul class="space-y-3">
                @foreach($brands as $brand)
                <li wire:key="{{ $brand->id }}">
                  <div class="flex items-center p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                    <input id="{{ $brand->slug }}" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="{{ $brand->slug }}" class="ms-3 text-gray-700 dark:text-gray-300 cursor-pointer">
                      {{ $brand->name }}
                    </label>
                  </div>
                </li>
                @endforeach
              </ul>
            </div>

            <!-- Price Filter -->
            <div class="p-5 bg-white dark:bg-gray-800 rounded-2xl shadow border border-gray-200 dark:border-gray-700">
              <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Price Range</h3>
              <div class="py-2">
                <div class="flex justify-between mb-2">
                  <span class="text-sm text-gray-600 dark:text-gray-300">Ksh 1,000</span>
                  <span class="text-sm text-gray-600 dark:text-gray-300">Ksh 500,000</span>
                </div>
                <input type="range" min="1000" max="500000" step="10000" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
                <div class="flex justify-between mt-4">
                  <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Min Price</label>
                    <div class="relative">
                      <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">Ksh</span>
                      <input type="number" min="1000" max="500000" class="pl-10 pr-3 py-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="1000">
                    </div>
                  </div>
                  <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Max Price</label>
                    <div class="relative">
                      <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">Ksh</span>
                      <input type="number" min="1000" max="500000" class="pl-10 pr-3 py-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="500000">
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Status Filter -->
            <div class="p-5 bg-white dark:bg-gray-800 rounded-2xl shadow border border-gray-200 dark:border-gray-700">
              <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Product Status</h3>
              <ul class="space-y-3">
                @foreach(['In Stock', 'On Sale'] as $status)
                <li>
                  <div class="flex items-center p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                    <input id="status-{{ Str::slug($status) }}" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="status-{{ Str::slug($status) }}" class="ms-3 text-gray-700 dark:text-gray-300 cursor-pointer">
                      {{ $status }}
                    </label>
                  </div>
                </li>
                @endforeach
              </ul>
            </div>

            <!-- Reset Filters Button -->
            <button class="w-full py-3 px-4 text-sm font-medium text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:outline-none dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700">
              Reset All Filters
            </button>
          </div>
        </div>

        <!-- Product Grid -->
        <div class="w-full lg:w-3/4">
          <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
              <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Products</h1>
              <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Showing {{ count($products) }} products</p>
            </div>
            <div class="flex space-x-3">
              <div class="relative">
                <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                  <option selected>Sort by latest</option>
                  <option>Sort by price: low to high</option>
                  <option>Sort by price: high to low</option>
                  <option>Sort by popularity</option>
                  <option>Sort by rating</option>
                </select>
              </div>
              <button class="p-2.5 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:hover:bg-gray-600">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                </svg>
              </button>
            </div>
          </div>

          @if (count($products) > 0)
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
              @foreach ($products as $product)
              <div wire:key="product-{{ $product->id }}" 
                class="group bg-white border border-gray-200 rounded-2xl shadow-sm dark:bg-gray-800 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-lg">
                <div class="relative">
                  <a wire:navigate href="{{ route('product.detail', $product->slug) }}" class="block overflow-hidden">
                    <img class="w-full h-60 object-cover transition-transform duration-500 group-hover:scale-105"
                         src="{{ url('storage',$product->images[0]) }}"
                         alt="{{ $product->name }}">
                  </a>
                  <div class="absolute top-3 right-3">
                    <button type="button" class="p-2 bg-white rounded-full shadow-md text-gray-700 hover:text-red-500 dark:bg-gray-700 dark:text-gray-300 dark:hover:text-red-400">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                      </svg>
                    </button>
                  </div>
                  @if($product->sale_percentage > 0)
                  <div class="absolute top-3 left-3">
                    <span class="bg-red-500 text-white text-xs font-bold px-2.5 py-1 rounded-full">
                      SALE {{ $product->sale_percentage }}%
                    </span>
                  </div>
                  @endif
                </div>
                
                <div class="p-5">
                  <div class="flex items-center mb-1">
                    @foreach(range(1,5) as $i)
                      @if($i <= $product->average_rating)
                        <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                          <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                        </svg>
                      @else
                        <svg class="w-4 h-4 text-gray-300 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                          <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                        </svg>
                      @endif
                    @endforeach
                    <span class="ml-2 text-sm text-gray-500 dark:text-gray-400">({{ $product->review_count }})</span>
                  </div>

                  <a wire:navigate href="{{ route('product.detail', $product->slug) }}">
                    <h5 class="mb-2 text-lg font-semibold tracking-tight text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                      {{ $product->name }}
                    </h5>
                  </a>
                  
                  <p class="mb-4 text-sm text-gray-600 dark:text-gray-300 line-clamp-2">
                    {{ $product->short_description }}
                  </p>
                  
                  <div class="flex items-center justify-between mt-4">
                    <div>
                      <span class="text-xl font-bold text-gray-900 dark:text-white">{{ Number::currency($product->price, 'KSH') }}</span>
                      @if($product->original_price)
                        <span class="ml-2 text-sm text-gray-500 dark:text-gray-400 line-through">
                          {{ Number::currency($product->original_price, 'KSH') }}
                        </span>
                      @endif
                    </div>
                    <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition-colors">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                      </svg>
                    </button>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          @else
            <div class="py-16 text-center">
              <div class="mx-auto max-w-md">
                <svg class="w-16 h-16 mx-auto text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="mt-4 text-xl font-semibold text-gray-900 dark:text-white">No products found</h3>
                <p class="mt-2 text-gray-600 dark:text-gray-400">Try adjusting your search or filter to find what you're looking for.</p>
                <button class="mt-6 inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600">
                  Reset Filters
                </button>
              </div>
            </div>
          @endif

          <!-- Pagination -->
        @if ($products->hasPages())
          <div class="mt-10 flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="text-sm text-gray-700 dark:text-gray-400">
              Showing <span class="font-medium">{{ $products->firstItem() }}</span> to <span class="font-medium">{{ $products->lastItem() }}</span> of <span class="font-medium">{{ $products->total() }}</span> results
            </p>
            <nav>
              <ul class="inline-flex -space-x-px">
                <!-- Previous Page Link -->
                <li>
                  <a wire:navigate
                    href="{{ $products->previousPageUrl() }}"
                    class="flex items-center justify-center px-3 h-8 ml-0 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                    @if($products->onFirstPage()) aria-disabled="true" @endif
                  >
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                  </a>
                </li> 
                
                <!-- Page Numbers -->
                @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                  <li>
                    <a wire:navigate
                      href="{{ $url }}"
                      class="flex items-center justify-center px-3 h-8 text-sm font-medium {{ $products->currentPage() === $page ? 'text-white bg-blue-600 border-blue-300' : 'text-gray-500 bg-white border-gray-300 hover:bg-gray-100 hover:text-gray-700' }} border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                      wire:click="gotoPage({{ $page }})"
                    >
                      {{ $page }}
                    </a>
                  </li>
                @endforeach
                
                <!-- Next Page Link -->
                <li>
                  <a wire:navigate
                    href=""
                    class="flex items-center justify-center px-3 h-8 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                    wire:click="nextPage"
                    @if(!$products->hasMorePages()) aria-disabled="true" @endif
                  >
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        @endif
        </div>
      </div>
    </div>
  </section>
</div>