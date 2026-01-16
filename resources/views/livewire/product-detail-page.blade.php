<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <section class="overflow-hidden bg-white py-11 font-poppins dark:bg-gray-800 rounded-xl shadow-md">
    <div class="max-w-6xl px-4 py-4 mx-auto lg:py-8 md:px-6">
      <div class="flex flex-wrap -mx-4">
        <!-- Product Images Section -->
        <div class="w-full mb-8 md:w-1/2 md:mb-0"
             x-data="{
               mainImage: '{{ $product->images ? url('storage', $product->images[0]) : asset('images/logo.png') }}'
             }">
          <div class="sticky top-6 overflow-hidden">
            <div class="relative mb-6 rounded-xl overflow-hidden lg:mb-10">
              <!-- Main Product Image -->
              <img
                x-bind:src="mainImage"
                alt="{{ $product->name }}"
                class="object-contain w-full h-96 rounded-lg bg-gray-50 dark:bg-gray-700"
              >

              <!-- Sale Badge -->
              @if ($product->on_sale)
                <div class="absolute top-4 right-4">
                  <span class="bg-red-600 text-white text-xs font-bold px-2.5 py-1 rounded-full">SALE</span>
                </div>
              @endif
            </div>

            <!-- Image Thumbnails -->
            <div class="flex flex-wrap gap-2 mb-6">
                @if ($product->images)
                                  @foreach($product->images as $index => $image)
                <div
                  class="w-1/4 cursor-pointer transition-all duration-300 border-2 rounded-md hover:border-blue-500"
                  :class="{ 'border-blue-500': mainImage === '{{ url('storage', $image) }}' }"
                  @click="mainImage = '{{ url('storage', $image) }}'"
                >
                  <img
                    src="{{ url('storage', $image) }}"
                    alt="Thumbnail {{ $index + 1 }}"
                    class="object-cover w-full h-20 bg-gray-100 dark:bg-gray-600"
                  >
                </div>
              @endforeach
                @else

                @endif

            </div>

            <!-- Shipping Information -->
            <div class="p-4 mt-6 bg-gray-50 rounded-lg dark:bg-gray-700">
              <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600 dark:text-blue-400 mr-3" fill="currentColor" viewBox="0 0 16 16">
                  <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"></path>
                </svg>
                <div>
                  <h2 class="text-lg font-bold text-gray-900 dark:text-white">Free Shipping</h2>
                  <p class="text-sm text-gray-600 dark:text-gray-300">Delivered within 3-5 business days</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Product Details Section -->
        <div class="w-full px-4 md:w-1/2">
          <div class="lg:pl-6">
            <div class="mb-8">
              <h2 class="max-w-xl mb-4 text-3xl font-bold text-gray-900 dark:text-white">
                {{ $product->name }}
              </h2>

              <!-- Rating -->
              <div class="flex items-center mb-4">
                <div class="flex items-center">
                  <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                  </svg>
                  <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                  </svg>
                  <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                  </svg>
                  <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                  </svg>
                  <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                  </svg>
                  <span class="ml-2 text-sm text-gray-600 dark:text-gray-300">4.2 (128 reviews)</span>
                </div>
              </div>

              <!-- Pricing -->
              <div class="mb-6">
                @if($product->on_sale)
                  <div class="flex items-baseline">
                    <span class="text-3xl font-bold text-gray-900 dark:text-white">
                      {{ \Illuminate\Support\Number::currency($product->price, 'Ksh') }}
                    </span>
                    <span class="ml-3 text-xl font-medium text-gray-500 line-through dark:text-gray-400">
                      {{ \Illuminate\Support\Number::currency($product->price, 'Ksh') }}
                    </span>
                    <span class="ml-3 bg-red-100 text-red-800 text-sm font-semibold px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">
                      {{-- @php
                        $discount = round(($product->price - $product->sale_price) / $product->price * 100);
                      @endphp --}}
                      {{-- {{ $discount }} --}} 50 % OFF
                    </span>
                  </div>
                @else
                  <span class="text-3xl font-bold text-gray-900 dark:text-white">
                    {{ \Illuminate\Support\Number::currency($product->price, 'Ksh') }}
                  </span>
                @endif
                <p class="text-sm text-gray-600 dark:text-gray-300">Inclusive of all taxes</p>
              </div>

              <!-- Description with improved dark mode support -->
              <div class="prose max-w-none text-gray-700 dark:text-gray-300 dark:prose-invert mb-6">
                {!! \Illuminate\Support\Str::markdown($product->description) !!}
              </div>
            </div>

            <!-- Quantity Selector -->
            <div class="mb-8">
              <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Quantity</h3>
              <div class="relative flex items-center max-w-[8rem]">
                <button
                  type="button"
                  wire:click="decrement"
                  class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 focus:ring-2 focus:outline-none"
                  :disabled="quantity <= 1"
                >
                  <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                  </svg>
                </button>
                <input
                  type="number"
                  wire:model="quantity"
                  class="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                  min="1"
                  max="99"
                >
                <button
                  type="button"
                  wire:click="increment"
                  class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 focus:ring-2 focus:outline-none"
                >
                  <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                  </svg>
                </button>
              </div>
            </div>

            <!-- Action Buttons with Loader -->
            <div class="flex flex-wrap gap-4">
              <button
                wire:click="addToCart({{ $product->id }})"
                wire:loading.attr="disabled"
                wire:loading.class="opacity-70 cursor-not-allowed"
                class="flex-1 px-6 py-3 text-base font-medium text-white bg-blue-700 hover:bg-blue-800 rounded-lg focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition-colors flex items-center justify-center"
              >
                <span wire:loading.remove wire:target="addToCart">
                  Add to Cart
                </span>
                <span wire:loading wire:target="addToCart" class="flex items-center">
                  <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                  </svg>
                  Adding...
                </span>
              </button>
              <button
                wire:click="addToWishlist"
                class="flex-1 px-6 py-3 text-base font-medium text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600 transition-colors"
              >
                Add to Wishlist
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<!-- Product Recommendations Section -->
@if(count($recommendations) > 0)
    <section class="bg-white dark:bg-gray-800 py-8 px-6 rounded-xl shadow-md mt-8">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
                You might also like
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($recommendations as $rec)
                    @php
                        $product = $rec['product'];
                        $score = $rec['score']; // Similarity score (0 to 1)

                        // Calculate sale percentage if needed
                        $salePercentage = $product->sale_percentage ?? 0;
                        if($product->on_sale && !isset($product->sale_percentage)) {
                            // Fallback calculation if sale_percentage doesn't exist
                            // $salePercentage = calculatePercentage($product); // You'd define this helper
                        }
                    @endphp

                    <div wire:key="recommendation-{{ $product->id }}"
                        class="group bg-white border border-gray-200 rounded-2xl shadow-sm dark:bg-gray-800 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-lg">
                        <div class="relative">
                            <a wire:navigate href="{{ route('product.detail', $product->slug) }}"
                               class="block overflow-hidden">
                                @if ($product->images && count($product->images) > 0)
                                    <img class="w-full h-60 object-cover transition-transform duration-500 group-hover:scale-105"
                                         src="{{ url('storage', $product->images[0]) }}"
                                         alt="{{ $product->name }}">
                                @else
                                    <img class="w-full h-60 object-cover transition-transform duration-500 group-hover:scale-105"
                                         src="{{ asset('images/logo.png') }}"
                                         alt="{{ $product->name }}">
                                @endif
                            </a>

                            <!-- Wishlist Button -->
                            <div class="absolute top-3 right-3">
                                <button type="button"
                                        class="p-2 bg-white rounded-full shadow-md text-gray-700 hover:text-red-500 dark:bg-gray-700 dark:text-gray-300 dark:hover:text-red-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </button>
                            </div>

                            <!-- Sale Badge -->
                            @if($product->on_sale)
                                <div class="absolute top-3 left-3">
                                    <span class="bg-red-500 text-white text-xs font-bold px-2.5 py-1 rounded-full">
                                        SALE {{ $salePercentage > 0 ? $salePercentage . '%' : '' }}
                                    </span>
                                </div>
                            @endif

                            <!-- Match Score Indicator (Optional - shows similarity percentage) -->
                            <div class="absolute bottom-3 left-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <span class="bg-blue-600 text-white text-xs font-bold px-2 py-1 rounded-full">
                                    {{ round($score * 100) }}% match
                                </span>
                            </div>
                        </div>

                        <div class="p-5">
                            <!-- Rating -->
                            <div class="flex items-center mb-1">
                                @php
                                    $averageRating = $product->average_rating ?? 4.2;
                                    $reviewCount = $product->review_count ?? rand(50, 200);
                                @endphp

                                @foreach(range(1,5) as $i)
                                    @if($i <= $averageRating)
                                        <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                        </svg>
                                    @else
                                        <svg class="w-4 h-4 text-gray-300 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                        </svg>
                                    @endif
                                @endforeach
                                <span class="ml-2 text-sm text-gray-500 dark:text-gray-400">({{ $reviewCount }})</span>
                            </div>

                            <!-- Product Name -->
                            <a wire:navigate href="{{ route('product.detail', $product->slug) }}">
                                <h5 class="mb-2 text-lg font-semibold tracking-tight text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                    {{ $product->name }}
                                </h5>
                            </a>

                            <!-- Product Description -->
                            <p class="mb-4 text-sm text-gray-600 dark:text-gray-300 line-clamp-2">
                                @php
                                    $shortDescription = $product->short_description ??
                                                        (strlen($product->description) > 100 ?
                                                         substr(strip_tags($product->description), 0, 100) . '...' :
                                                         strip_tags($product->description));
                                @endphp
                                {{ $shortDescription }}
                            </p>

                            <!-- Category Badge -->
                            @if($product->category)
                                <div class="mb-3">
                                    <span class="inline-block bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300 text-xs px-2 py-1 rounded-full">
                                        {{ $product->category->name }}
                                    </span>
                                    @if($product->brand)
                                        <span class="inline-block bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300 text-xs px-2 py-1 rounded-full ml-1">
                                            {{ $product->brand->name }}
                                        </span>
                                    @endif
                                </div>
                            @endif

                            <!-- Price and Add to Cart -->
                            <div class="flex items-center justify-between mt-4">
                                <div>
                                    <span class="text-xl font-bold text-gray-900 dark:text-white">
                                        {{ \Illuminate\Support\Number::currency($product->price, 'Ksh') }}
                                    </span>
                                    <!-- Original price if on sale -->
                                    @if($product->on_sale && $product->original_price)
                                        <span class="ml-2 text-sm text-gray-500 dark:text-gray-400 line-through">
                                            {{ \Illuminate\Support\Number::currency($product->original_price, 'Ksh') }}
                                        </span>
                                    @endif
                                </div>

                                <!-- Add to Cart Button -->
                                <a wire:click.prevent="addToCart({{ $product->id }})"
                                   href="#"
                                   class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition-colors relative"
                                   wire:loading.class="opacity-60 cursor-not-allowed"
                                   wire:loading.attr="aria-disabled"
                                   wire:target="addToCart({{ $product->id }})">
                                    <svg class="w-5 h-5 inline-block align-middle transition-opacity duration-200"
                                         fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                         xmlns="http://www.w3.org/2000/svg"
                                         wire:loading.remove wire:target="addToCart({{ $product->id }})">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                        </path>
                                    </svg>
                                    <span wire:loading wire:target="addToCart({{ $product->id }})"
                                          class="inline-block align-middle">
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

            <!-- View All Similar Products Link -->
            <div class="mt-8 text-center">
                @if($product->category)
                    <a href="{{ route('products', [
                        'selected_categories' => [$product->category->id],
                        'selected_brands' => $product->brand_id ? [$product->brand_id] : []
                    ]) }}"
                    wire:navigate
                    class="inline-flex items-center text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium">
                        View more similar products
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                @endif
            </div>
        </div>
    </section>
@endif
</div>
