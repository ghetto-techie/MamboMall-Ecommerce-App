<x-guest-layout>
  <section class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      
      {{-- Logo --}}
      <div class="mb-6">
        <x-authentication-card-logo />
      </div>

      {{-- Card --}}
      <div class="w-full bg-white rounded-lg shadow dark:border sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
          <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
            Create an account
          </h1>

          {{-- Validation --}}
          <x-validation-errors class="text-sm text-red-600 dark:text-red-400" />

          {{-- Form --}}
          <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Name --}}
            <div>
              <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
              <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                     class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                            focus:ring-brand focus:border-brand block w-full p-2.5
                            dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                            dark:focus:ring-brand dark:focus:border-brand-light">
            </div>

            {{-- Email --}}
            <div>
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
              <input type="email" name="email" id="email" value="{{ old('email') }}" required autocomplete="username"
                     class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                            focus:ring-brand focus:border-brand block w-full p-2.5
                            dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                            dark:focus:ring-brand dark:focus:border-brand-light">
            </div>

            {{-- Password --}}
            <div>
              <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
              <input type="password" name="password" id="password" required autocomplete="new-password"
                     class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                            focus:ring-brand focus:border-brand block w-full p-2.5
                            dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                            dark:focus:ring-brand dark:focus:border-brand-light">
            </div>

            {{-- Confirm Password --}}
            <div>
              <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm Password</label>
              <input type="password" name="password_confirmation" id="password_confirmation" required autocomplete="new-password"
                     class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                            focus:ring-brand focus:border-brand block w-full p-2.5
                            dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                            dark:focus:ring-brand dark:focus:border-brand-light">
            </div>

            {{-- Terms --}}
            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
              <div class="flex items-start">
                <div class="flex items-center h-5">
                  <input id="terms" name="terms" type="checkbox" required
                         class="w-4 h-4 text-brand bg-gray-100 border-gray-300 rounded focus:ring-brand dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-brand dark:ring-offset-gray-800">
                </div>
                <div class="ml-3 text-sm">
                  <label for="terms" class="font-light text-gray-500 dark:text-gray-300">
                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                        'terms_of_service' => '<a wire:navigate target="_blank" href="'.route('terms.show').'" class="font-medium text-brand hover:underline dark:text-brand-light">'.__('Terms of Service').'</a>',
                        'privacy_policy' => '<a wire:navigate target="_blank" href="'.route('policy.show').'" class="font-medium text-brand hover:underline dark:text-brand-light">'.__('Privacy Policy').'</a>',
                    ]) !!}
                  </label>
                </div>
              </div>
            @endif

            {{-- Register --}}
            <button type="submit"
                    class="w-full text-white bg-brand hover:bg-brand-dark focus:ring-4 focus:outline-none
                           focus:ring-brand-accent font-medium rounded-lg text-sm px-5 py-2.5 text-center">
              Register
            </button>

            {{-- Login Link --}}
            <p class="text-sm font-light text-gray-500 dark:text-gray-400 text-center">
              Already registered?
              <a wire:navigate 
                href="{{ route('login') }}"
                 class="font-medium text-brand hover:underline dark:text-brand-light">
                Log in here
              </a>
            </p>
          </form>
        </div>
      </div>
    </div>
  </section>
</x-guest-layout>
