<div class="space-y-6">
    <div>
        <h3 class="text-xl font-medium text-gray-900 dark:text-white">{{ __('Profile Information') }}</h3>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Update your account\'s profile information and email address.') }}
        </p>
    </div>

    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
        <div x-data="{photoName: null, photoPreview: null}" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Photo') }}</label>
                
                <div class="flex items-center space-x-6 mt-2">
                    <!-- Current Profile Photo -->
                    <div x-show="!photoPreview">
                        <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" 
                             class="rounded-full size-20 object-cover border-2 border-gray-200 dark:border-gray-700">
                    </div>

                    <!-- New Profile Photo Preview -->
                    <div x-show="photoPreview" class="hidden">
                        <span class="block rounded-full size-20 bg-cover bg-no-repeat bg-center border-2 border-gray-200 dark:border-gray-700"
                              :style="'background-image: url(\'' + photoPreview + '\');'">
                        </span>
                    </div>

                    <div class="flex space-x-3">
                        <input type="file" id="photo" class="hidden"
                               wire:model.live="photo"
                               x-ref="photo"
                               x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                               " />

                        <button type="button"
                                x-on:click.prevent="$refs.photo.click()"
                                class="inline-flex items-center px-3 py-2 border border-gray-300 text-sm leading-4 font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-900">
                            {{ __('Select A New Photo') }}
                        </button>

                        @if ($this->user->profile_photo_path)
                            <button type="button" 
                                    wire:click="deleteProfilePhoto"
                                    class="inline-flex items-center px-3 py-2 border border-red-500 text-sm leading-4 font-medium rounded-md text-red-600 dark:text-red-400 bg-white dark:bg-gray-700 hover:bg-red-50 dark:hover:bg-red-900/10 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 dark:focus:ring-offset-gray-900">
                                {{ __('Remove Photo') }}
                            </button>
                        @endif
                    </div>
                </div>
                
                <x-input-error for="photo" class="mt-2" />
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Name') }}</label>
            <input id="name" type="text" wire:model="state.name" required autocomplete="name"
                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white sm:text-sm">
            <x-input-error for="name" class="mt-2 text-sm text-red-600 dark:text-red-400" />
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Email') }}</label>
            <input id="email" type="email" wire:model="state.email" required autocomplete="username"
                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white sm:text-sm">
            <x-input-error for="email" class="mt-2 text-sm text-red-600 dark:text-red-400" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                <p class="mt-2 text-sm text-gray-800 dark:text-gray-200">
                    {{ __('Your email address is unverified.') }}

                    <button type="button" 
                            wire:click.prevent="sendEmailVerification"
                            class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 underline">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p class="mt-2 text-sm font-medium text-green-600 dark:text-green-400">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>
    </div>

    <div class="flex items-center justify-end space-x-3 pt-6">
        @if (session()->has('saved'))
            <span class="text-sm text-green-600 dark:text-green-400">{{ __('Saved.') }}</span>
        @endif
        
        <button type="button" 
                wire:loading.attr="disabled" 
                wire:target="photo"
                wire:click="updateProfileInformation"
                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800">
            {{ __('Save') }}
        </button>
    </div>
</div>