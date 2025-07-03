<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <div class="flex flex-col">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-3xl font-bold text-gray-800 dark:text-white">My Orders</h1>
      <div class="relative">
        <input type="text" placeholder="Search orders..." class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <svg class="w-4 h-4 absolute right-3 top-3 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
      </div>
    </div>
    
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-200 dark:border-gray-700 overflow-hidden">
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
          <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
              <th scope="col" class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
              <th scope="col" class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
              <th scope="col" class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
              <th scope="col" class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment</th>
              <th scope="col" class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
              <th scope="col" class="py-3 px-6 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
          </thead>
          <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
              <td class="py-4 px-6 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900 dark:text-white">#ORD-2024-20</div>
              </td>
              <td class="py-4 px-6 whitespace-nowrap">
                <div class="text-sm text-gray-700 dark:text-gray-300">18-02-2024</div>
              </td>
              <td class="py-4 px-6 whitespace-nowrap">
                <span class="px-2.5 py-0.5 text-xs font-medium bg-orange-100 text-orange-800 rounded-full dark:bg-orange-900 dark:text-orange-200">Pending</span>
              </td>
              <td class="py-4 px-6 whitespace-nowrap">
                <span class="px-2.5 py-0.5 text-xs font-medium bg-green-100 text-green-800 rounded-full dark:bg-green-900 dark:text-green-200">Paid</span>
              </td>
              <td class="py-4 px-6 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900 dark:text-white">$12,000.00</div>
              </td>
              <td class="py-4 px-6 whitespace-nowrap text-right text-sm font-medium">
                <div class="flex justify-end space-x-2">
                  <a href="#" class="flex items-center text-blue-600 hover:text-blue-900 dark:text-blue-500 dark:hover:text-blue-400">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    View
                  </a>
                  <button class="flex items-center text-red-600 hover:text-red-900 dark:text-red-500 dark:hover:text-red-400">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Cancel
                  </button>
                </div>
              </td>
            </tr>
            
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
              <td class="py-4 px-6 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900 dark:text-white">#ORD-2024-19</div>
              </td>
              <td class="py-4 px-6 whitespace-nowrap">
                <div class="text-sm text-gray-700 dark:text-gray-300">15-02-2024</div>
              </td>
              <td class="py-4 px-6 whitespace-nowrap">
                <span class="px-2.5 py-0.5 text-xs font-medium bg-blue-100 text-blue-800 rounded-full dark:bg-blue-900 dark:text-blue-200">Processing</span>
              </td>
              <td class="py-4 px-6 whitespace-nowrap">
                <span class="px-2.5 py-0.5 text-xs font-medium bg-green-100 text-green-800 rounded-full dark:bg-green-900 dark:text-green-200">Paid</span>
              </td>
              <td class="py-4 px-6 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900 dark:text-white">$8,500.00</div>
              </td>
              <td class="py-4 px-6 whitespace-nowrap text-right text-sm font-medium">
                <div class="flex justify-end space-x-2">
                  <a href="#" class="flex items-center text-blue-600 hover:text-blue-900 dark:text-blue-500 dark:hover:text-blue-400">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    View
                  </a>
                </div>
              </td>
            </tr>
            
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
              <td class="py-4 px-6 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900 dark:text-white">#ORD-2024-18</div>
              </td>
              <td class="py-4 px-6 whitespace-nowrap">
                <div class="text-sm text-gray-700 dark:text-gray-300">10-02-2024</div>
              </td>
              <td class="py-4 px-6 whitespace-nowrap">
                <span class="px-2.5 py-0.5 text-xs font-medium bg-green-100 text-green-800 rounded-full dark:bg-green-900 dark:text-green-200">Completed</span>
              </td>
              <td class="py-4 px-6 whitespace-nowrap">
                <span class="px-2.5 py-0.5 text-xs font-medium bg-green-100 text-green-800 rounded-full dark:bg-green-900 dark:text-green-200">Paid</span>
              </td>
              <td class="py-4 px-6 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900 dark:text-white">$15,750.00</div>
              </td>
              <td class="py-4 px-6 whitespace-nowrap text-right text-sm font-medium">
                <div class="flex justify-end space-x-2">
                  <a href="#" class="flex items-center text-blue-600 hover:text-blue-900 dark:text-blue-500 dark:hover:text-blue-400">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    View
                  </a>
                  <button class="flex items-center text-purple-600 hover:text-purple-900 dark:text-purple-500 dark:hover:text-purple-400">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    Reorder
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      
      <!-- Pagination -->
      <div class="flex items-center justify-between border-t border-gray-200 dark:border-gray-700 px-6 py-4">
        <div class="text-sm text-gray-700 dark:text-gray-400">
          Showing <span class="font-medium">1</span> to <span class="font-medium">3</span> of <span class="font-medium">12</span> results
        </div>
        <div class="inline-flex rounded-md shadow-sm">
          <button class="flex items-center justify-center px-3 h-8 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700">
            Previous
          </button>
          <button class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-blue-600 border border-gray-300 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600">
            1
          </button>
          <button class="flex items-center justify-center px-3 h-8 text-sm font-medium text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700">
            2
          </button>
          <button class="flex items-center justify-center px-3 h-8 text-sm font-medium text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700">
            3
          </button>
          <button class="flex items-center justify-center px-3 h-8 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700">
            Next
          </button>
        </div>
      </div>
    </div>
  </div>
</div>