<div class="space-y-6">
    <div>
        <h3 class="text-xl font-medium text-gray-900 dark:text-white">{{ __('Two Factor Authentication') }}</h3>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Add additional security to your account using two factor authentication.') }}
        </p>
    </div>

    <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow">
        <h4 class="text-lg font-medium text-gray-900 dark:text-white">
            @if ($this->enabled)
                @if ($showingConfirmation)
                    {{ __('Finish enabling two factor authentication.') }}
                @else
                    {{ __('You have enabled two factor authentication.') }}
                @endif
            @else
                {{ __('You have not enabled two factor authentication.') }}
            @endif
        </h4>

        <div class="mt-3 text-sm text-gray-600 dark:text-gray-400">
            <p>
                {{ __('When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone\'s Google Authenticator application.') }}
            </p>
        </div>

        @if ($this->enabled)
            @if ($showingQrCode)
                <div class="mt-6">
                    <p class="font-semibold text-gray-600 dark:text-gray-300">
                        @if ($showingConfirmation)
                            {{ __('To finish enabling two factor authentication, scan the following QR code using your phone\'s authenticator application or enter the setup key and provide the generated OTP code.') }}
                        @else
                            {{ __('Two factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator application or enter the setup key.') }}
                        @endif
                    </p>
                </div>

                <div class="mt-4 p-4 inline-block bg-white rounded-lg">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>

                <div class="mt-4 max-w-xl">
                    <p class="font-semibold text-sm text-gray-700 dark:text-gray-300">
                        {{ __('Setup Key') }}:
                    </p>
                    <div class="mt-2 p-3 bg-gray-50 dark:bg-gray-700 rounded-md font-mono text-sm">
                        {{ decrypt($this->user->two_factor_secret) }}
                    </div>
                </div>

                @if ($showingConfirmation)
                    <div class="mt-6">
                        <label for="code" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Code') }}</label>
                        <input id="code" type="text" name="code" inputmode="numeric" autofocus autocomplete="one-time-code"
                            wire:model="code"
                            wire:keydown.enter="confirmTwoFactorAuthentication"
                            class="mt-1 block w-1/2 rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white sm:text-sm">
                        <x-input-error for="code" class="mt-2 text-sm text-red-600 dark:text-red-400" />
                    </div>
                @endif
            @endif

            @if ($showingRecoveryCodes)
                <div class="mt-6">
                    <p class="font-semibold text-gray-600 dark:text-gray-300">
                        {{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.') }}
                    </p>
                </div>

                <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-50 dark:bg-gray-700 dark:text-gray-100 rounded-lg">
                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div class="py-1">{{ $code }}</div>
                    @endforeach
                </div>
            @endif
        @endif

        <div class="mt-6 flex flex-wrap gap-3">
            @if (! $this->enabled)
                <button type="button" 
                        wire:click="enableTwoFactorAuthentication"
                        wire:loading.attr="disabled"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800">
                    {{ __('Enable') }}
                </button>
            @else
                @if ($showingRecoveryCodes)
                    <button type="button" 
                            wire:click="regenerateRecoveryCodes"
                            class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800">
                        {{ __('Regenerate Recovery Codes') }}
                    </button>
                @elseif ($showingConfirmation)
                    <button type="button" 
                            wire:click="confirmTwoFactorAuthentication"
                            wire:loading.attr="disabled"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800">
                        {{ __('Confirm') }}
                    </button>
                @else
                    <button type="button" 
                            wire:click="showRecoveryCodes"
                            class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800">
                        {{ __('Show Recovery Codes') }}
                    </button>
                @endif

                @if ($showingConfirmation)
                    <button type="button" 
                            wire:click="disableTwoFactorAuthentication"
                            wire:loading.attr="disabled"
                            class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800">
                        {{ __('Cancel') }}
                    </button>
                @else
                    <button type="button" 
                            wire:click="disableTwoFactorAuthentication"
                            wire:loading.attr="disabled"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 dark:focus:ring-offset-gray-800">
                        {{ __('Disable') }}
                    </button>
                @endif
            @endif
        </div>
    </div>
</div>