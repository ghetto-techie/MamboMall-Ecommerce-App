<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <div class="container mx-auto">
    <div class="flex items-center justify-between mb-8">
      <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Shopping Cart</h1>
      <div class="flex items-center space-x-2">
        <span class="text-sm text-gray-600 dark:text-gray-400">{{ $itemCount }} items</span>
        <div class="w-1 h-1 bg-gray-400 rounded-full"></div>
        <span class="text-sm font-medium text-blue-600 dark:text-blue-400">{{ \Illuminate\Support\Number::currency($grandTotal, 'Ksh') }}</span>
      </div>
    </div>

    @if(count($cart_items) > 0)
    <div class="flex flex-col lg:flex-row gap-6">
      <div class="lg:w-3/4">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
          <div class="overflow-x-auto">
            <table class="w-full min-w-max">
              <thead class="bg-gray-50 dark:bg-gray-700/50">
                <tr>
                  <th class="py-3 px-4 text-left font-medium text-gray-700 dark:text-gray-300">Product</th>
                  <th class="py-3 px-4 text-center font-medium text-gray-700 dark:text-gray-300">Price</th>
                  <th class="py-3 px-4 text-center font-medium text-gray-700 dark:text-gray-300">Quantity</th>
                  <th class="py-3 px-4 text-center font-medium text-gray-700 dark:text-gray-300">Total</th>
                  <th class="py-3 px-4 text-center font-medium text-gray-700 dark:text-gray-300">Action</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($cart_items as $item)
                <tr>
                  <td class="py-5 px-4">
                    <div class="flex items-center">
                      <div class="relative">
                        <img
                          class="h-24 w-24 object-contain rounded-xl border border-gray-200 dark:border-gray-700"
                          src="{{ url('storage', $item['image']) }}" alt="{{ $item['name'] }}"
                        >
                        @if($item['quantity'] > 1)
                          <span class="absolute -top-2 -right-2 bg-blue-100 text-blue-800 text-xs font-bold px-2 py-1 rounded-full">{{ $item['quantity'] }}</span>
                        @endif
                      </div>
                      <div class="ml-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">{{ $item['name'] }}</h3>
                        <div class="flex items-center mt-1">
                          <div class="flex">
                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            {{-- <span class="ml-1 text-sm text-gray-600 dark:text-gray-400">4.8 (128 reviews)</span> --}}
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="py-5 px-4 text-center text-lg font-semibold text-gray-900 dark:text-white">{{ \Illuminate\Support\Number::currency($item['unit_amount'], 'Ksh') }}</td>
                  <td class="py-5 px-4">
                    <div class="flex justify-center">
                      <div class="flex items-center border border-gray-300 rounded-lg dark:border-gray-600">
                        <button
                          wire:click="decreaseQuantity('{{ $item['product_id'] }}')"
                          class="flex items-center justify-center h-10 w-10 text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700"
                          :disabled="$item['quantity'] <= 1"
                        >
                          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                          </svg>
                        </button>
                        <span class="flex items-center justify-center h-10 w-12 text-center font-medium">{{ $item['quantity'] }}</span>
                        <button
                          wire:click="increaseQuantity('{{ $item['product_id'] }}')"
                          class="flex items-center justify-center h-10 w-10 text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700"
                        >
                          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                          </svg>
                        </button>
                      </div>
                    </div>
                  </td>
                  <td class="py-5 px-4 text-center text-lg font-semibold text-gray-900 dark:text-white">{{ \Illuminate\Support\Number::currency($item['total_amount'], 'Ksh') }}</td>
                  <td class="py-5 px-4 text-center">
                    <button
                      wire:click="removeItem('{{ $item['product_id'] }}')"
                      class="p-2 text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400 rounded-full hover:bg-red-50 dark:hover:bg-red-900/20"
                    >
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                      </svg>
                    </button>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          <div class="flex flex-col sm:flex-row justify-between items-center mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
            <div class="w-full sm:w-auto">
              <div class="flex items-center">
                <svg class="w-5 h-5 mr-2 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 3v2a7 7 0 107 0V3"></path>
                </svg>
                <input
                  type="text"
                  wire:model="couponCode"
                  placeholder="Coupon code"
                  class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                >
                <button
                  wire:click="applyCoupon"
                  class="ml-2 px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-700 dark:bg-gray-700 dark:hover:bg-gray-600"
                >
                  Apply
                </button>
              </div>

              <!-- Coupon messages -->
              @if($couponError)
                <div class="mt-2 text-red-600 text-sm dark:text-red-400">{{ $couponError }}</div>
              @endif
              @if($couponSuccess)
                <div class="mt-2 text-green-600 text-sm dark:text-green-400">{{ $couponSuccess }}</div>
              @endif
              @if($appliedCoupon)
                <div class="mt-2 flex items-center">
                  <span class="text-green-600 dark:text-green-400">Applied: {{ $appliedCoupon->code }}</span>
                  <button
                    wire:click="removeCoupon"
                    class="ml-2 text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400"
                  >
                    Remove
                  </button>
                </div>
              @endif
            </div>

            <div class="mt-4 sm:mt-0 flex space-x-3">
              <a href="{{ route('products') }}" class="flex items-center px-4 py-2.5 bg-white border border-gray-300 text-gray-900 rounded-lg hover:bg-gray-100 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-600">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Continue Shopping
              </a>
              <button
                wire:click="clearCart"
                class="px-4 py-2.5 bg-red-600 text-white rounded-lg hover:bg-red-700 dark:bg-red-500 dark:hover:bg-red-600"
              >
                Clear Cart
              </button>
            </div>
          </div>
        </div>
      </div>

      <div class="lg:w-1/4">
        <div class="sticky top-24">
          <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
            <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Order Summary</h2>
            <div class="space-y-4">
              <div class="flex justify-between">
                <span class="text-gray-600 dark:text-gray-400">Subtotal ({{ $itemCount }} items)</span>
                <span class="text-gray-900 dark:text-white">{{ \Illuminate\Support\Number::currency($subtotal, 'Ksh') }}</span>
              </div>
              <div class="flex justify-between">
                <span class="text-gray-600 dark:text-gray-400">Discount</span>
                <span class="text-green-600 dark:text-green-400">
                  -{{ \Illuminate\Support\Number::currency($discount, 'Ksh') }}
                </span>
              </div>
              <div class="flex justify-between">
                <span class="text-gray-600 dark:text-gray-400">Estimated Tax</span>
                <span class="text-gray-900 dark:text-white">{{ \Illuminate\Support\Number::currency($taxAmount, 'Ksh') }}</span>
              </div>
              <div class="flex justify-between">
                <span class="text-gray-600 dark:text-gray-400">Shipping</span>
                <span class="text-green-600 dark:text-green-400">FREE</span>
              </div>
              <div class="border-t border-gray-200 dark:border-gray-700 my-4 pt-4">
                <div class="flex justify-between">
                  <span class="text-lg font-bold text-gray-900 dark:text-white">Total</span>
                  <span class="text-lg font-bold text-gray-900 dark:text-white">{{ \Illuminate\Support\Number::currency($grandTotal, 'Ksh') }}</span>
                </div>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Including {{ \Illuminate\Support\Number::currency($taxAmount, 'Ksh') }} in taxes</p>
              </div>
            </div>
            <a
              href="{{ route('checkout') }}"
              class="w-full mt-6 bg-blue-700 hover:bg-blue-800 text-white py-3.5 px-4 rounded-xl font-medium transition-colors dark:bg-blue-600 dark:hover:bg-blue-700 flex items-center justify-center"
            >
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 3v2a7 7 0 107 0V3"></path>
              </svg>
              Proceed to Checkout
            </a>

            <div class="mt-6">
              <h3 class="text-sm font-medium text-gray-900 dark:text-white mb-3">We accept</h3>
              <div class="flex justify-center space-x-3">
                <div class="bg-gray-100 dark:bg-green-700 rounded-lg w-14 h-9 flex items-center justify-center">
                  <span class="text-xs font-bold text-gray-500 dark:text-gray-400">MPESA</span>
                </div>
                <div class="bg-gray-100 dark:bg-blue-700 rounded-lg w-14 h-9 flex items-center justify-center">
                  <span class="text-xs font-bold text-gray-500 dark:text-gray-400">VISA</span>
                </div>
                <div class="bg-gray-100 dark:bg-orange-700 rounded-lg w-14 h-9 flex items-center justify-center">
                  <span class="text-xs font-bold text-gray-500 dark:text-gray-400">MASTER CARD</span>
                </div>
                <div class="bg-gray-100 dark:bg-red-700 rounded-lg w-14 h-9 flex items-center justify-center">
                  <span class="text-xs font-bold text-gray-500 dark:text-gray-400">AIRTEL MONEY</span>
                </div>
              </div>
            </div>
          </div>

          <div class="mt-6 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-700/50 rounded-2xl p-5">
            <div class="flex items-start">
              <svg class="w-6 h-6 text-blue-600 dark:text-blue-400 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
              </svg>
              <div>
                <h3 class="font-medium text-blue-800 dark:text-blue-200">Secure Payment</h3>
                <p class="mt-1 text-sm text-blue-700 dark:text-blue-300">Your payment information is encrypted and secure.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @else
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-12 text-center border border-gray-200 dark:border-gray-700">
      <svg class="w-16 h-16 text-gray-400 dark:text-gray-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
      </svg>
      <h3 class="text-xl font-bold text-gray-900 dark:text-white mt-4">Your cart is empty</h3>
      <p class="text-gray-600 dark:text-gray-400 mt-2">Add some items to your cart to continue shopping.</p>
      <a wire:navigate href="{{ route('products') }}" class="mt-6 inline-flex items-center px-4 py-2.5 bg-blue-700 hover:bg-blue-800 text-white rounded-lg font-medium dark:bg-blue-600 dark:hover:bg-blue-700">
        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
        </svg>
        Shop Now
      </a>
    </div>
    @endif
  </div>
</div>
