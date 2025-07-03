<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <!-- Page Header -->
  <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
    <div>
      <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">Order Details</h1>
      <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
        <span>Order ID: #ORD-2024-53</span>
        <span class="mx-2">•</span>
        <span>Placed on February 17, 2024</span>
      </div>
    </div>
    <div class="mt-4 md:mt-0">
      <button class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none dark:bg-gray-800 dark:border-gray-700 dark:text-gray-300 dark:hover:bg-gray-700">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
        </svg>
        Download Invoice
      </button>
    </div>
  </div>

  <!-- Order Status Cards -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
    <!-- Customer Card -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700 p-5">
      <div class="flex items-start">
        <div class="flex-shrink-0 flex items-center justify-center w-12 h-12 rounded-lg bg-blue-100 text-blue-600 dark:bg-blue-900/50 dark:text-blue-400">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
          </svg>
        </div>
        <div class="ml-4">
          <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Customer</h3>
          <p class="mt-1 text-lg font-medium text-gray-900 dark:text-white">Jace Grimes</p>
          <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">jace.grimes@example.com</p>
        </div>
      </div>
    </div>

    <!-- Order Date Card -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700 p-5">
      <div class="flex items-start">
        <div class="flex-shrink-0 flex items-center justify-center w-12 h-12 rounded-lg bg-purple-100 text-purple-600 dark:bg-purple-900/50 dark:text-purple-400">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
          </svg>
        </div>
        <div class="ml-4">
          <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Order Date</h3>
          <p class="mt-1 text-lg font-medium text-gray-900 dark:text-white">Feb 17, 2024</p>
          <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">11:24 AM</p>
        </div>
      </div>
    </div>

    <!-- Order Status Card -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700 p-5">
      <div class="flex items-start">
        <div class="flex-shrink-0 flex items-center justify-center w-12 h-12 rounded-lg bg-yellow-100 text-yellow-600 dark:bg-yellow-900/50 dark:text-yellow-400">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
          </svg>
        </div>
        <div class="ml-4">
          <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Order Status</h3>
          <span class="mt-1 inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
            Processing
          </span>
          <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Expected delivery: Feb 22-24</p>
        </div>
      </div>
    </div>

    <!-- Payment Status Card -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700 p-5">
      <div class="flex items-start">
        <div class="flex-shrink-0 flex items-center justify-center w-12 h-12 rounded-lg bg-green-100 text-green-600 dark:bg-green-900/50 dark:text-green-400">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
        </div>
        <div class="ml-4">
          <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Payment Status</h3>
          <span class="mt-1 inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
            Paid
          </span>
          <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Stripe •••• 4242</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Progress Tracking -->
  <div class="bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700 p-6 mb-8">
    <h2 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Order Progress</h2>
    <div class="relative pt-1">
      <div class="flex mb-2 items-center justify-between">
        <div>
          <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-blue-600 bg-blue-200 dark:bg-blue-900/50">
            Order Placed
          </span>
        </div>
        <div class="text-right">
          <span class="text-xs font-semibold inline-block text-blue-600">
            40%
          </span>
        </div>
      </div>
      <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-gray-200 dark:bg-gray-700">
        <div style="width:40%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-500"></div>
      </div>
    </div>
    
    <div class="flex justify-between text-xs text-gray-600 dark:text-gray-400">
      <div class="text-center w-1/4">
        <div class="w-3 h-3 rounded-full bg-blue-500 mx-auto mb-1"></div>
        <div>Order Placed</div>
        <div class="font-medium text-gray-900 dark:text-white">Feb 17</div>
      </div>
      <div class="text-center w-1/4">
        <div class="w-3 h-3 rounded-full bg-gray-300 dark:bg-gray-600 mx-auto mb-1"></div>
        <div>Processing</div>
        <div class="font-medium text-gray-900 dark:text-white">Est: Feb 18</div>
      </div>
      <div class="text-center w-1/4">
        <div class="w-3 h-3 rounded-full bg-gray-300 dark:bg-gray-600 mx-auto mb-1"></div>
        <div>Shipped</div>
        <div class="font-medium text-gray-900 dark:text-white">Est: Feb 20</div>
      </div>
      <div class="text-center w-1/4">
        <div class="w-3 h-3 rounded-full bg-gray-300 dark:bg-gray-600 mx-auto mb-1"></div>
        <div>Delivered</div>
        <div class="font-medium text-gray-900 dark:text-white">Est: Feb 22-24</div>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <div class="flex flex-col lg:flex-row gap-6">
    <!-- Left Column -->
    <div class="lg:w-3/4">
      <!-- Order Items -->
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700 overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
          <h2 class="text-lg font-bold text-gray-800 dark:text-white">Order Items</h2>
        </div>
        <div class="divide-y divide-gray-200 dark:divide-gray-700">
          <!-- Item 1 -->
          <div class="p-6">
            <div class="flex flex-col sm:flex-row">
              <div class="flex-shrink-0 mb-4 sm:mb-0 sm:mr-6">
                <img class="w-24 h-24 object-contain rounded-lg border border-gray-200 dark:border-gray-700" src="http://localhost:8000/storage/products/01HND3J5XS7ZC5J84BK5YDM6Z2.jpg" alt="Samsung Galaxy Watch6">
              </div>
              <div class="flex-1 min-w-0">
                <div class="flex flex-col md:flex-row md:justify-between">
                  <div class="mb-2 md:mb-0">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Samsung Galaxy Watch6</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Bluetooth • 44mm • Midnight Black</p>
                    <div class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-400">
                      <span>Item #: SM-R945FZKAXAR</span>
                    </div>
                  </div>
                  <div class="flex flex-col items-end">
                    <p class="text-lg font-bold text-gray-900 dark:text-white">₹29,999.00</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Qty: 1</p>
                    <p class="mt-1 text-sm font-medium text-gray-900 dark:text-white">Total: ₹29,999.00</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Item 2 -->
          <div class="p-6">
            <div class="flex flex-col sm:flex-row">
              <div class="flex-shrink-0 mb-4 sm:mb-0 sm:mr-6">
                <img class="w-24 h-24 object-contain rounded-lg border border-gray-200 dark:border-gray-700" src="http://localhost:8000/storage/products/01HND30J0P7C6MWQ1XQK7YDQKA.jpg" alt="Samsung Galaxy Book3">
              </div>
              <div class="flex-1 min-w-0">
                <div class="flex flex-col md:flex-row md:justify-between">
                  <div class="mb-2 md:mb-0">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Samsung Galaxy Book3</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">15.6" • Core i7 • 16GB RAM • 1TB SSD</p>
                    <div class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-400">
                      <span>Item #: NP750XFH-KC1IN</span>
                    </div>
                  </div>
                  <div class="flex flex-col items-end">
                    <p class="text-lg font-bold text-gray-900 dark:text-white">₹75,000.00</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Qty: 5</p>
                    <p class="mt-1 text-sm font-medium text-gray-900 dark:text-white">Total: ₹375,000.00</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Shipping Information -->
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700 overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
          <h2 class="text-lg font-bold text-gray-800 dark:text-white">Shipping Information</h2>
        </div>
        <div class="p-6">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <h3 class="text-md font-medium text-gray-800 dark:text-white mb-2">Shipping Address</h3>
              <div class="text-gray-600 dark:text-gray-300">
                <p class="mb-1">Jace Grimes</p>
                <p class="mb-1">42227 Zoila Glens</p>
                <p class="mb-1">Oshkosh, Michigan 55928</p>
                <p class="mt-3"><span class="font-medium">Phone:</span> 023-509-0009</p>
                <p><span class="font-medium">Email:</span> jace.grimes@example.com</p>
              </div>
            </div>
            <div>
              <h3 class="text-md font-medium text-gray-800 dark:text-white mb-2">Shipping Method</h3>
              <div class="text-gray-600 dark:text-gray-300">
                <p class="mb-1">Express Delivery</p>
                <p>Estimated delivery: Feb 22-24, 2024</p>
                <div class="mt-4 flex items-center">
                  <svg class="w-6 h-6 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path>
                  </svg>
                  <span>Shipped via FedEx</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Right Column -->
    <div class="lg:w-1/4">
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700 overflow-hidden sticky top-24">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
          <h2 class="text-lg font-bold text-gray-800 dark:text-white">Order Summary</h2>
        </div>
        <div class="p-6">
          <div class="space-y-3">
            <div class="flex justify-between">
              <span class="text-gray-600 dark:text-gray-300">Subtotal (2 items)</span>
              <span class="font-medium text-gray-900 dark:text-white">₹404,999.00</span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-600 dark:text-gray-300">Shipping</span>
              <span class="font-medium text-green-600 dark:text-green-400">FREE</span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-600 dark:text-gray-300">Tax</span>
              <span class="font-medium text-gray-900 dark:text-white">₹0.00</span>
            </div>
            <div class="border-t border-gray-200 dark:border-gray-700 my-3 pt-3">
              <div class="flex justify-between">
                <span class="text-lg font-bold text-gray-900 dark:text-white">Total</span>
                <span class="text-lg font-bold text-gray-900 dark:text-white">₹404,999.00</span>
              </div>
            </div>
          </div>
          
          <div class="mt-6">
            <h3 class="text-md font-medium text-gray-800 dark:text-white mb-3">Payment Information</h3>
            <div class="flex justify-between mb-1">
              <span class="text-gray-600 dark:text-gray-300">Payment method:</span>
              <span class="font-medium text-gray-900 dark:text-white">Stripe</span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-600 dark:text-gray-300">Transaction ID:</span>
              <span class="font-medium text-gray-900 dark:text-white">ch_3OcE7xK...</span>
            </div>
          </div>
          
          <div class="mt-6">
            <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2.5 px-4 rounded-lg font-medium transition-colors focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
              Contact Support
            </button>
            <button class="w-full mt-3 bg-white border border-gray-300 text-gray-800 py-2.5 px-4 rounded-lg font-medium hover:bg-gray-50 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
              Print Order Details
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>