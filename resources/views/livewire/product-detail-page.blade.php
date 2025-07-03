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

              <!-- Description -->
              <p class="text-gray-700 dark:text-gray-300 mb-6">
                {!! \Illuminate\Support\Str::markdown($product->description) !!}
              </p>

              <!-- Key Features -->
              <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Key Features:</h3>
                <ul class="space-y-2 text-gray-700 dark:text-gray-300">
                  {{-- @foreach($product->features as $feature) --}}
                    <li class="flex items-center">
                      <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                      </svg>
                      {{-- {{ $feature }} --}}
                    </li>
                  {{-- @endforeach --}}
                </ul>
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
            
            <!-- Action Buttons -->
            <div class="flex flex-wrap gap-4">
              <button 
                wire:click="addToCart"
                class="flex-1 px-6 py-3 text-base font-medium text-white bg-blue-700 hover:bg-blue-800 rounded-lg focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition-colors"
              >
                Add to Cart
              </button>
              <button 
                wire:click="buyNow"
                class="flex-1 px-6 py-3 text-base font-medium text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600 transition-colors"
              >
                Buy Now
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>