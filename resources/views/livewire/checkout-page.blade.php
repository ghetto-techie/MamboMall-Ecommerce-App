<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-6">
    Checkout
  </h1>
  
  <div class="grid grid-cols-1 lg:grid-cols-8 gap-6">
    <!-- Left Column - Form -->
    <div class="lg:col-span-5">
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 border border-gray-200 dark:border-gray-700">
        <div class="mb-8">
          <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-6 pb-2 border-b border-gray-200 dark:border-gray-700">
            Shipping Address
          </h2>
          
          <form class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="first_name">
                First Name
              </label>
              <input class="w-full rounded-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 text-sm p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="first_name" type="text" required>
            </div>
            
            <div>
              <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="last_name">
                Last Name
              </label>
              <input class="w-full rounded-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 text-sm p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="last_name" type="text" required>
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
                <input type="text" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="+1 (123) 456-7890" required>
              </div>
            </div>
            
            <div class="sm:col-span-2">
              <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="address">
                Street Address
              </label>
              <input class="w-full rounded-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 text-sm p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="address" type="text" placeholder="123 Main St" required>
            </div>
            
            <div>
              <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="city">
                City
              </label>
              <input class="w-full rounded-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 text-sm p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="city" type="text" required>
            </div>
            
            <div>
              <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="state">
                State/Province
              </label>
              <select id="state" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>Select State</option>
                <option>California</option>
                <option>New York</option>
                <option>Texas</option>
              </select>
            </div>
            
            <div>
              <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="zip">
                ZIP/Postal Code
              </label>
              <input class="w-full rounded-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 text-sm p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="zip" type="text" required>
            </div>
            
            <div class="sm:col-span-2">
              <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="country">
                Country
              </label>
              <select id="country" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option selected>United States</option>
                <option>Canada</option>
                <option>United Kingdom</option>
                <option>Australia</option>
              </select>
            </div>
          </form>
        </div>
        
        <div class="mb-6">
          <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-6 pb-2 border-b border-gray-200 dark:border-gray-700">
            Payment Method
          </h2>
          
          <ul class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <li>
              <input class="hidden peer" id="cash-on-delivery" name="payment" type="radio" value="cash" required>
              <label class="flex flex-col p-5 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:ring-2 peer-checked:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:peer-checked:border-blue-500" for="cash-on-delivery">
                <div class="flex items-center justify-between">
                  <div>
                    <div class="text-lg font-semibold text-gray-900 dark:text-white">Cash on Delivery</div>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Pay when you receive your order</p>
                  </div>
                  <svg class="w-5 h-5 text-blue-600 dark:text-blue-500" aria-hidden="true" fill="none" viewBox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                  </svg>
                </div>
                <div class="mt-4 flex items-center">
                  <div class="bg-gray-200 dark:bg-gray-600 border-2 border-dashed rounded-xl w-16 h-10" />
                </div>
              </label>
            </li>
            
            <li>
              <input class="hidden peer" id="stripe" name="payment" type="radio" value="stripe">
              <label class="flex flex-col p-5 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:ring-2 peer-checked:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:peer-checked:border-blue-500" for="stripe">
                <div class="flex items-center justify-between">
                  <div>
                    <div class="text-lg font-semibold text-gray-900 dark:text-white">Credit/Debit Card</div>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Pay securely with Stripe</p>
                  </div>
                  <svg class="w-5 h-5 text-blue-600 dark:text-blue-500" aria-hidden="true" fill="none" viewBox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                  </svg>
                </div>
                <div class="mt-4 flex items-center space-x-2">
                  <div class="bg-gray-200 dark:bg-gray-600 border-2 border-dashed rounded-xl w-10 h-6" />
                  <div class="bg-gray-200 dark:bg-gray-600 border-2 border-dashed rounded-xl w-10 h-6" />
                  <div class="bg-gray-200 dark:bg-gray-600 border-2 border-dashed rounded-xl w-10 h-6" />
                </div>
              </label>
            </li>
          </ul>
        </div>
      </div>
    </div>
    
    <!-- Right Column - Summary -->
    <div class="lg:col-span-3">
      <div class="sticky top-24">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 border border-gray-200 dark:border-gray-700 mb-6">
          <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-6 pb-2 border-b border-gray-200 dark:border-gray-700">
            Order Summary
          </h2>
          
          <div class="space-y-4">
            <div class="flex justify-between">
              <span class="text-gray-600 dark:text-gray-300">Subtotal</span>
              <span class="font-medium text-gray-900 dark:text-white">$45,000.00</span>
            </div>
            
            <div class="flex justify-between">
              <span class="text-gray-600 dark:text-gray-300">Taxes</span>
              <span class="font-medium text-gray-900 dark:text-white">$0.00</span>
            </div>
            
            <div class="flex justify-between">
              <span class="text-gray-600 dark:text-gray-300">Shipping</span>
              <span class="font-medium text-green-600 dark:text-green-400">FREE</span>
            </div>
            
            <div class="border-t border-gray-200 dark:border-gray-700 my-4 pt-4">
              <div class="flex justify-between">
                <span class="text-lg font-bold text-gray-900 dark:text-white">Total</span>
                <span class="text-lg font-bold text-gray-900 dark:text-white">$45,000.00</span>
              </div>
            </div>
          </div>
          
          <button class="w-full mt-6 bg-green-600 hover:bg-green-700 text-white py-3 px-4 rounded-lg font-medium transition-colors focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-800">
            Place Order
          </button>
          
          <div class="mt-4 text-center text-sm text-gray-500 dark:text-gray-400">
            By placing your order, you agree to our <a href="#" class="text-blue-600 hover:underline dark:text-blue-500">Terms of Service</a> and <a href="#" class="text-blue-600 hover:underline dark:text-blue-500">Privacy Policy</a>
          </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 border border-gray-200 dark:border-gray-700">
          <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-6 pb-2 border-b border-gray-200 dark:border-gray-700">
            Basket Summary
          </h2>
          
          <ul class="divide-y divide-gray-200 dark:divide-gray-700">
            <li class="py-4">
              <div class="flex items-center">
                <div class="flex-shrink-0">
                  <img class="w-16 h-16 object-contain rounded-lg border border-gray-200 dark:border-gray-700" src="https://iplanet.one/cdn/shop/files/iPhone_15_Pro_Max_Blue_Titanium_PDP_Image_Position-1__en-IN_1445x.jpg?v=1695435917" alt="iPhone 15 Pro Max">
                </div>
                <div class="ml-4 flex-1 min-w-0">
                  <p class="text-base font-medium text-gray-900 truncate dark:text-white">
                    Apple iPhone 15 Pro Max
                  </p>
                  <p class="text-sm text-gray-500 dark:text-gray-400">
                    Blue Titanium · 256GB
                  </p>
                  <div class="flex items-center mt-1">
                    <span class="text-sm font-medium text-gray-900 dark:text-white">$1,199.00</span>
                    <span class="mx-2 text-gray-400">|</span>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Qty: 1</span>
                  </div>
                </div>
              </div>
            </li>
            
            <li class="py-4">
              <div class="flex items-center">
                <div class="flex-shrink-0">
                  <img class="w-16 h-16 object-contain rounded-lg border border-gray-200 dark:border-gray-700" src="https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/MPPJ3?wid=1144&hei=1144&fmt=jpeg&qlt=90&.v=1686255743705" alt="Apple Watch">
                </div>
                <div class="ml-4 flex-1 min-w-0">
                  <p class="text-base font-medium text-gray-900 truncate dark:text-white">
                    Apple Watch Series 9
                  </p>
                  <p class="text-sm text-gray-500 dark:text-gray-400">
                    45mm · GPS · Midnight
                  </p>
                  <div class="flex items-center mt-1">
                    <span class="text-sm font-medium text-gray-900 dark:text-white">$429.00</span>
                    <span class="mx-2 text-gray-400">|</span>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Qty: 1</span>
                  </div>
                </div>
              </div>
            </li>
            
            <li class="py-4">
              <div class="flex items-center">
                <div class="flex-shrink-0">
                  <img class="w-16 h-16 object-contain rounded-lg border border-gray-200 dark:border-gray-700" src="https://store.storeimages.cdn-apple.com/8756/as-images.apple.com/is/airpods-max-select-silver-202011_FV1?wid=1200&hei=630&fmt=jpeg&qlt=95&.v=1633622648000" alt="AirPods Max">
                </div>
                <div class="ml-4 flex-1 min-w-0">
                  <p class="text-base font-medium text-gray-900 truncate dark:text-white">
                    AirPods Max
                  </p>
                  <p class="text-sm text-gray-500 dark:text-gray-400">
                    Silver
                  </p>
                  <div class="flex items-center mt-1">
                    <span class="text-sm font-medium text-gray-900 dark:text-white">$549.00</span>
                    <span class="mx-2 text-gray-400">|</span>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Qty: 1</span>
                  </div>
                </div>
              </div>
            </li>
          </ul>
          
          <div class="mt-6 flex justify-between items-center">
            <span class="text-gray-600 dark:text-gray-300">Items (3)</span>
            <span class="font-medium text-gray-900 dark:text-white">$2,177.00</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>