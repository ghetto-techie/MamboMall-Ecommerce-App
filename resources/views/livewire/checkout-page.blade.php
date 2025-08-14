<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <div class="mb-8 text-center">
    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-white mb-3">
      Complete Your Order
    </h1>
    <p class="text-gray-600 dark:text-gray-400 max-w-lg mx-auto">
      Finalize your purchase with secure payment options
    </p>
  </div>
  
  <form wire:submit.prevent="placeOrder">
    <div class="grid grid-cols-1 lg:grid-cols-8 gap-6">
      <!-- Left Column - Form -->
      <div class="lg:col-span-5">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
          <div class="mb-8">
            <div class="flex items-center mb-6">
              <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-blue-600 dark:text-blue-300 mr-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
              </div>
              <h2 class="text-xl font-bold text-gray-800 dark:text-white">Shipping Information</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
              <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="first_name">
                  First Name
                </label>
                <input wire:model="first_name" 
                      class="w-full rounded-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 text-sm p-3.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
                      @error('first_name') border-red-500 @enderror" 
                      id="first_name" 
                      type="text" 
                      required>
                @error('first_name') <p class="mt-1 text-xs text-red-600 dark:text-red-500">{{ $message }}</p> @enderror
              </div>
              
              <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="last_name">
                  Last Name
                </label>
                <input wire:model="last_name" 
                      class="w-full rounded-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 text-sm p-3.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
                      @error('last_name') border-red-500 @enderror" 
                      id="last_name" 
                      type="text" 
                      required>
                @error('last_name') <p class="mt-1 text-xs text-red-600 dark:text-red-500">{{ $message }}</p> @enderror
              </div>

              <div class="sm:col-span-2">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="email">
                  Email Address <span class="text-gray-500">(Optional)</span>
                </label>
                <input wire:model="email" 
                      class="w-full rounded-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 text-sm p-3.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
                      @error('email') border-red-500 @enderror" 
                      id="email" 
                      type="email" 
                      placeholder="example@gmail.com">
              </div>
              
            <div class="sm:col-span-2">
              <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="phone">
                Phone Number
              </label>
              <div class="relative">
                <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                  <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 19 18">
                    <path d="M18 13.446a3.02 3.02 0 0 0-.946-1.985l-1.4-1.4a3.054 3.054 0 0 0-4.218 0l-.7.7a.983.983 0 0 1-1.39 0l-2.1-2.1a.983.983 0 0 1 0-1.389l.7-.7a2.98 2.98 0 0 0 0-4.217l-1.4-1.4a2.824 2.824 0 0 0-4.218 0c-3.619 3.619-3 8.229 1.752 12.979C6.785 16.639 9.45 18 11.912 18a7.175 7.175 0 0 0 5.139-2.325A2.9 2.9 0 0 0 18 13.446Z"/>
                  </svg>
                </div>
                <input wire:model="phone" 
                      type="tel" 
                      id="phone" 
                      pattern="(07\d{8}|2547\d{8})"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-3.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
                      @error('phone') border-red-500 @enderror" 
                      placeholder="e.g. 0712345678 or 254712345678" 
                      required>
                @error('phone') 
                  <p class="mt-1 text-xs text-red-600 dark:text-red-500">{{ $message }}</p> 
                @enderror
              </div>
            </div>
                
            <div class="sm:col-span-2"> 
              <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="address">
                Street / Location Address
              </label>
              <input wire:model="street_address" 
                    class="w-full rounded-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 text-sm p-3.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                    id="address" 
                    type="text" 
                    placeholder="e.g. Moi Avenue, Nairobi CBD" 
                    required>
              @error('street_address') 
                <p class="mt-1 text-xs text-red-600 dark:text-red-500">{{ $message }}</p> 
              @enderror
            </div>

              
              <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="city">
                  City
                </label>
                <input wire:model="city" 
                      class="w-full rounded-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 text-sm p-3.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
                      @error('city') border-red-500 @enderror" 
                      id="city" 
                      type="text" 
                      required>
                @error('city') <p class="mt-1 text-xs text-red-600 dark:text-red-500">{{ $message }}</p> @enderror
              </div>
              
              <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="county">
                  County
                </label>
                <select id="county" 
                        wire:model="county" 
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                  <option value="" selected disabled>Select County</option>
                  <option value="nairobi">Nairobi</option>
                  <option value="mombasa">Mombasa</option>
                  <option value="kisumu">Kisumu</option>
                  <option value="nakuru">Nakuru</option>
                  <option value="eldoret">Eldoret</option>
                  <option value="kisii">Kisii</option>
                  <option value="lamu">Lamu</option>
                  <option value="garissa">Garissa</option>
                  <option value="nyahururu">Nyahururu</option>
                </select>
                @error('county') <p class="mt-1 text-xs text-red-600 dark:text-red-500">{{ $message }}</p> @enderror
              </div>
              
              <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="zip">
                  ZIP/Postal Code <span class="text-gray-500">(Optional)</span>
                </label>
                <input wire:model="zip" 
                      class="w-full rounded-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 text-sm p-3.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                      id="zip" 
                      type="text">
              </div>
              
              <div class="sm:col-span-2">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="delivery_note">
                  Delivery Notes <span class="text-gray-500">(Optional)</span>
                </label>
                <textarea wire:model="delivery_note" 
                          id="delivery_note" 
                          class="w-full rounded-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 text-sm p-3.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" 
                          rows="2" 
                          placeholder="Any special instructions?"></textarea>
              </div>
            </div>
          </div>
          
          <div class="mb-6">
            <div class="flex items-center mb-6">
              <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center text-blue-600 dark:text-blue-300 mr-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                </svg>
              </div>
              <h2 class="text-xl font-bold text-gray-800 dark:text-white">Payment Method</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div class="relative">
                <input class="hidden peer" id="cash_on_delivery" name="payment" type="radio" value="cash_on_delivery" wire:model="payment_method">
                <label class="flex flex-col p-5 bg-white border-2 border-gray-200 rounded-xl cursor-pointer peer-checked:border-blue-600 dark:bg-gray-700 dark:border-gray-600 dark:peer-checked:border-blue-500 transition-colors" for="cash_on_delivery">
                  <div class="flex items-center justify-between">
                    <div>
                      <div class="text-lg font-semibold text-gray-900 dark:text-white">Cash on Delivery</div>
                      <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Pay when you receive your order</p>
                    </div>
                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" aria-hidden="true" fill="none" viewBox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
                      <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                  </div>
                  <div class="mt-4 flex items-center">
                    <div class="flex space-x-2">
                      <div class="bg-gray-100 dark:bg-gray-600 rounded-lg w-12 h-8 flex items-center justify-center">
                        <svg class="w-6 h-6 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                      </div>
                      <div class="bg-gray-100 dark:bg-gray-600 rounded-lg w-12 h-8 flex items-center justify-center">
                        <svg class="w-6 h-6 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                      </div>
                    </div>
                  </div>
                </label>
              </div>
              
              <div class="relative">
                <input class="hidden peer" id="mpesa" name="payment" type="radio" value="mpesa" wire:model="payment_method">
                <label class="flex flex-col p-5 bg-white border-2 border-gray-200 rounded-xl cursor-pointer peer-checked:border-blue-600 dark:bg-gray-700 dark:border-gray-600 dark:peer-checked:border-blue-500 transition-colors" for="mpesa">
                  <div class="flex items-center justify-between">
                    <div>
                      <div class="text-lg font-semibold text-gray-900 dark:text-white">M-Pesa</div>
                      <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Pay instantly via M-Pesa</p>
                    </div>
                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" aria-hidden="true" fill="none" viewBox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
                      <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                    </svg>
                  </div>
                  <div class="mt-4 flex items-center">
                    <div class="flex space-x-2">
                          <input wire:model="mpesa_phone" 
                                type="tel" 
                                id="mpesa_phone" 
                                pattern="(07\d{8}|2547\d{8})"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-3.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
                                @error('mpesa_phone') border-red-500 @enderror" 
                                placeholder="e.g. 0712345678 or 254712345678" 
                                required>
                    </div>
                          @error('mpesa_phone') 
                            <p class="mt-1 text-xs text-red-600 dark:text-red-500">{{ $message }}</p> 
                          @enderror
                  </div>
                  <div class="mt-4 flex items-center">
                    <div class="bg-gray-100 dark:bg-gray-600 rounded-lg w-16 h-8 flex items-center justify-center">
                      <span class="font-bold text-green-600">M-PESA</span>
                    </div>
                  </div>
                </label>
              </div>
            </div>
            @error('payment_method') <p class="mt-2 text-xs text-red-600 dark:text-red-500">{{ $message }}</p> @enderror
            
            <div class="mt-5 flex items-center text-sm text-gray-500 dark:text-gray-400">
              <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
              </svg>
              <span>Your payment details are securely encrypted</span>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Right Column - Summary -->
      <div class="lg:col-span-3">
        <div class="sticky top-24">
          <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700 mb-6">
            <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-6 pb-2 border-b border-gray-200 dark:border-gray-700">
              Order Summary
            </h2>

            <div class="space-y-4">
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-300">Subtotal</span>
                    <span class="font-medium text-gray-900 dark:text-white">{{ Number::currency($subtotal, 'Ksh') }}</span>
                </div>
                
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-300">Tax ({{ $taxRate }}%)</span>
                    <span class="font-medium text-gray-900 dark:text-white">{{ Number::currency($taxAmount, 'Ksh') }}</span>
                </div>
                
                <div class="flex justify-between">
                    <span class="text-gray-600 dark:text-gray-300">Shipping</span>
                    <span class="font-medium text-green-600 dark:text-green-400">FREE</span>
                </div>
                
                <div class="border-t border-gray-200 dark:border-gray-700 my-4 pt-4">
                    <div class="flex justify-between">
                        <span class="text-lg font-bold text-gray-900 dark:text-white">Total</span>
                        <span class="text-lg font-bold text-gray-900 dark:text-white">{{ Number::currency($grandTotal, 'Ksh') }}</span>
                    </div>
                </div>
            </div>
            
            <button type="submit"
                    wire:loading.attr="disabled"
                    wire:target="placeOrder"
                    class="w-full mt-6 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white py-3.5 px-4 rounded-xl font-bold transition-all shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-50 disabled:opacity-70 disabled:cursor-not-allowed">
              <span wire:loading.remove wire:target="placeOrder">
                Place Order
              </span>
              <span wire:loading wire:target="placeOrder">
                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Processing...
              </span>
            </button>
            
            <div class="mt-4 text-center text-sm text-gray-500 dark:text-gray-400">
              By placing your order, you agree to our <a href="{{ route('terms.show') }}" class="text-blue-600 hover:underline dark:text-blue-400">Terms</a> and <a href="{{ route('policy.show') }}" class="text-blue-600 hover:underline dark:text-blue-400">Privacy Policy</a>
            </div>
            
            <div class="mt-5 flex items-center justify-center text-xs">
              <span class="bg-green-500 text-white px-3 py-1 rounded-full font-medium flex items-center">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
                <span>Secure SSL Encryption</span>
              </span>
            </div>
          </div>
          
          <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700">
            <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-6 pb-2 border-b border-gray-200 dark:border-gray-700">
              Basket Summary
            </h2>
            
            <ul class="space-y-4 max-h-[400px] overflow-y-auto pr-2">
              @forelse ($cartItems as $item)
              <li class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4">
                <div class="flex items-center">
                  <div class="flex-shrink-0">
                    <img class="w-16 h-16 object-contain rounded-lg border border-gray-200 dark:border-gray-600" src="{{ url('storage', $item['image']) }}" alt="{{ $item['name'] }}">
                  </div>
                  <div class="ml-4 flex-1 min-w-0">
                    <p class="text-base font-medium text-gray-900 truncate dark:text-white">
                      {{ $item['name'] }}
                    </p>
                    <div class="flex items-center mt-1 justify-between">
                      <span class="text-sm font-medium text-gray-900 dark:text-white">{{ Number::currency($item['unit_amount'], 'Ksh') }} × {{ $item['quantity'] }}</span>
                      <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ Number::currency($item['total_amount'], 'Ksh') }}</span>
                    </div>
                  </div>
                </div>
              </li>
              @empty
                <li class="py-6 text-center text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                  <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                  </svg>
                  <p class="mt-3">Your basket is empty</p>
                </li>
              @endforelse
            </ul>
            
            <div class="mt-6 flex justify-between items-center pt-4 border-t border-gray-200 dark:border-gray-700">
              <span class="text-gray-600 dark:text-gray-300 font-medium">Items ({{ count($cartItems) }})</span>
              <span class="font-medium text-gray-900 dark:text-white">{{ Number::currency($grandTotal, 'Ksh') }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>