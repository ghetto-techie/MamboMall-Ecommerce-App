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
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                  <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                  </svg>
                </div>
                <input
                  wire:model.live.debounce.500ms="q"
                  type="text"
                  class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                  placeholder="Search products..."
                >
              </div>
            </div>

            <!-- Categories -->
            <div id="accordion-categories" data-accordion="collapse" class="bg-white dark:bg-gray-800 rounded-2xl shadow border border-gray-200 dark:border-gray-700">
              <h2 id="accordion-categories-heading">
                <button type="button" class="flex items-center justify-between w-full p-5 font-semibold text-left text-gray-900 rounded-t-2xl dark:text-white hover:bg-gray-50 dark:hover:bg-gray-700"
                  data-accordion-target="#accordion-categories-body" aria-expanded="true" aria-controls="accordion-categories-body">
                  <span>Categories</span>
                  <svg data-accordion-icon class="w-5 h-5 shrink-0 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.292l3.71-4.06a.75.75 0 111.08 1.04l-4.25 4.65a.75.75 0 01-1.08 0l-4.25-4.65a.75.75 0 01.02-1.06z" clip-rule="evenodd"/>
                  </svg>
                </button>
              </h2>
              <div id="accordion-categories-body" class="hidden" aria-labelledby="accordion-categories-heading">
                <div class="p-5 space-y-3">
                  @foreach($categories as $category)
                  <div wire:key="cat-{{ $category->id }}" class="flex items-center p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                    <input
                      id="cat-{{ $category->slug }}"
                      wire:model.live="selected_categories"
                      value="{{ $category->id }}" type="checkbox"
                      class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="cat-{{ $category->slug }}" class="ms-3 text-gray-700 dark:text-gray-300 cursor-pointer">
                      {{ $category->name }}
                    </label>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>

            <!-- Brand Accordion -->
            <div id="accordion-brands" data-accordion="collapse" class="bg-white dark:bg-gray-800 rounded-2xl shadow border border-gray-200 dark:border-gray-700">
              <h2 id="accordion-brands-heading">
                <button type="button" class="flex items-center justify-between w-full p-5 font-semibold text-left text-gray-900 rounded-t-2xl dark:text-white hover:bg-gray-50 dark:hover:bg-gray-700"
                  data-accordion-target="#accordion-brands-body" aria-expanded="true" aria-controls="accordion-brands-body">
                  <span>Brands</span>
                  <svg data-accordion-icon class="w-5 h-5 shrink-0 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.292l3.71-4.06a.75.75 0 111.08 1.04l-4.25 4.65a.75.75 0 01-1.08 0l-4.25-4.65a.75.75 0 01.02-1.06z" clip-rule="evenodd"/>
                  </svg>
                </button>
              </h2>
              <div id="accordion-brands-body" class="hidden" aria-labelledby="accordion-brands-heading">
                <div class="p-5 space-y-3">
                  @foreach($brands as $brand)
                  <div wire:key="brand-{{ $brand->id }}" class="flex items-center p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                    <input
                      id="brand-{{ $brand->slug }}"
                      wire:model.live="selected_brands"
                      value="{{ $brand->id }}" type="checkbox"
                      class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="brand-{{ $brand->slug }}" class="ms-3 text-gray-700 dark:text-gray-300 cursor-pointer">
                      {{ $brand->name }}
                    </label>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>

<!-- Price Filter Accordion -->
<div id="accordion-price" data-accordion="collapse" class="border border-gray-200 dark:border-gray-700 rounded-2xl shadow-sm">
  <h2 id="accordion-price-heading">
    <button type="button"
      class="flex justify-between items-center w-full p-5 font-medium text-gray-900 dark:text-white rounded-t-2xl bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700"
      data-accordion-target="#accordion-price-body" aria-expanded="true" aria-controls="accordion-price-body">
      <span class="text-lg font-semibold">Price Range</span>
      <svg data-accordion-icon class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
      </svg>
    </button>
  </h2>

  <div id="accordion-price-body" class="hidden" aria-labelledby="accordion-price-heading">
    <div class="p-5 bg-white dark:bg-gray-800 rounded-b-2xl space-y-6">

      <!-- Current Selection -->
      <div class="flex justify-between text-sm text-gray-600 dark:text-gray-300">
        <span>Min: Ksh {{ number_format($min_price) }}</span>
        <span>Max: Ksh {{ number_format($max_price) }}</span>
      </div>

      <!-- Inputs -->
      <div class="flex justify-between gap-4">
        <!-- Min Price -->
        <div class="w-1/2">
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Min Price</label>
          <div class="relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">Ksh</span>
            <input type="number" min="0" max="500000" step="1000"
                   wire:model.lazy="min_price"
                   class="pl-12 pr-3 py-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                          focus:ring-blue-500 focus:border-blue-500 block w-full
                          dark:bg-gray-700 dark:border-gray-600 dark:text-white">
          </div>
        </div>

        <!-- Max Price -->
        <div class="w-1/2">
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Max Price</label>
          <div class="relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">Ksh</span>
            <input type="number" min="0" max="500000" step="1000"
                   wire:model.lazy="max_price"
                   class="pl-12 pr-3 py-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                          focus:ring-blue-500 focus:border-blue-500 block w-full
                          dark:bg-gray-700 dark:border-gray-600 dark:text-white">
          </div>
        </div>
      </div>

    </div>
  </div>
</div>


            <!-- Status Filter -->
            <div class="p-5 bg-white dark:bg-gray-800 rounded-2xl shadow border border-gray-200 dark:border-gray-700">
              <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Product Status</h3>
              <ul class="space-y-3">
                <li>
                  <div class="flex items-center p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                    <input id="featured" wire:model.live="featured" value="1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="featured" class="ms-3 text-gray-700 dark:text-gray-300 cursor-pointer">
                      Featured Products
                    </label>
                  </div>
                </li>
                <li>
                  <div class="flex items-center p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                    <input id="on-sale" wire:model.live="on_sale" value="1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="on-sale" class="ms-3 text-gray-700 dark:text-gray-300 cursor-pointer">
                      On Sale
                    </label>
                  </div>
                </li>
              </ul>
            </div>

            <!-- Reset Filters Button -->
            <button wire:click="resetFilters" class="w-full py-3 px-4 text-sm font-medium text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:outline-none dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700">
              Reset All Filters
            </button>
          </div>
        </div>

        <!-- Product Grid -->
        <div class="w-full lg:w-3/4">
          <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
              <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Products</h1>
              <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                Showing {{ $products->count() }} of {{ $products->total() }} products
                @if($q)
                  for "<span class="font-medium">{{ $q }}</span>"
                @endif
              </p>
            </div>
            <div class="flex space-x-3">
              <div class="relative">
                <select
                  wire:model.live="sort"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                >
                  <option selected value="latest">Sort by latest</option>
                  <option value="price_low">Sort by price: low to high</option>
                  <option value="price_high">Sort by price: high to low</option>
                </select>
              </div>
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
                    <a
                      wire:click.prevent="addToCart({{ $product->id }})"
                      href=""
                      class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition-colors relative"
                      wire:loading.class="opacity-60 cursor-not-allowed"
                      wire:loading.attr="aria-disabled"
                      wire:target="addToCart({{ $product->id }})"
                    >
                      <svg
                        class="w-5 h-5 inline-block align-middle transition-opacity duration-200"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                        wire:loading.remove wire:target="addToCart({{ $product->id }})"
                      >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                      </svg>
                      <span
                        wire:loading wire:target="addToCart({{ $product->id }})"
                        class="inline-block align-middle"
                      >
                        <svg class="w-5 h-5 animate-spin text-white mx-auto" fill="none" viewBox="0 0 24 24">
                          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                        </svg>
                      </span>
                    </a>
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
                <button wire:click="resetFilters" class="mt-4 py-3 px-4 text-sm font-medium text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:outline-none dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700">
                  Reset All Filters
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
