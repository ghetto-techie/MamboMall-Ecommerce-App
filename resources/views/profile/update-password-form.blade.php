<div class="space-y-6">
    <div>
        <h3 class="text-xl font-medium text-gray-900 dark:text-white">{{ __('Update Password') }}</h3>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </div>

    <div class="space-y-6">
        <div>
            <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Current Password') }}</label>
            <input id="current_password" type="password" wire:model="state.current_password" autocomplete="current-password"
                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white sm:text-sm">
            <x-input-error for="current_password" class="mt-2 text-sm text-red-600 dark:text-red-400" />
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('New Password') }}</label>
            <input id="password" type="password" wire:model="state.password" autocomplete="new-password"
                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white sm:text-sm">
            <x-input-error for="password" class="mt-2 text-sm text-red-600 dark:text-red-400" />
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" type="password" wire:model="state.password_confirmation" autocomplete="new-password"
                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white sm:text-sm">
            <x-input-error for="password_confirmation" class="mt-2 text-sm text-red-600 dark:text-red-400" />
        </div>
    </div>

    <div class="flex items-center justify-end space-x-3 pt-4">
        @if (session()->has('saved'))
            <span class="text-sm text-green-600 dark:text-green-400">{{ __('Saved.') }}</span>
        @endif
        
        <button type="button" 
                wire:click="updatePassword"
                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800">
            {{ __('Save') }}
        </button>
    </div>
</div>