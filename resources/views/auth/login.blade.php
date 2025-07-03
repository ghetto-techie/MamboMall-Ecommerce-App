<x-guest-layout>
  <section class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      
      {{-- Brand --}}

    <div class="text-center flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
        <x-authentication-card-logo />
      </div>

      {{-- Form Card --}}
      <div class="w-full bg-white rounded-lg shadow dark:border sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">

          {{-- Heading --}}
          <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
            Log in to your account
          </h1>

          {{-- Session + Errors --}}
          <x-validation-errors class="text-sm text-red-600 dark:text-red-400" />
          @session('status')
            <div class="text-sm text-green-600 dark:text-green-400 font-medium">
              {{ $value }}
            </div>
          @endsession

          {{-- Login Form --}}
          <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email --}}
            <div>
              <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
              <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                     class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-brand focus:border-brand block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-brand dark:focus:border-brand-light"
                     placeholder="name@example.com">
            </div>

            {{-- Password --}}
            <div>
              <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
              <input type="password" name="password" id="password" required autocomplete="current-password"
                     class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-brand focus:border-brand block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-brand dark:focus:border-brand-light"
                     placeholder="••••••••">
            </div>

            {{-- Remember me --}}
            <div class="flex items-start">
              <div class="flex items-center h-5">
                <input id="remember_me" name="remember" type="checkbox"
                       class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-brand dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-brand dark:ring-offset-gray-800">
              </div>
              <div class="ml-3 text-sm">
                <label for="remember_me" class="text-gray-500 dark:text-gray-300">Remember me</label>
              </div>
            </div>

            {{-- Forgot Password --}}
            @if (Route::has('password.request'))
              <div class="text-sm text-end">
                <a wire:navigate
                href="{{ route('password.request') }}"
                   class="font-medium text-brand hover:underline dark:text-brand-light">Forgot your password?</a>
              </div>
            @endif

            {{-- Submit --}}
            <button type="submit"
                    class="w-full text-white bg-brand hover:bg-brand-dark focus:ring-4 focus:outline-none focus:ring-brand-accent font-medium rounded-lg text-sm px-5 py-2.5 text-center">
              Log in
            </button>

            {{-- Register Link --}}
            <p class="text-sm font-light text-gray-500 dark:text-gray-400 text-center">
              Don’t have an account?
              <a wire:navigate href="{{ route('register') }}"
                 class="font-medium text-brand hover:underline dark:text-brand-light">Create one</a>
            </p>
          </form>
        </div>
      </div>
    </div>
  </section>
</x-guest-layout>
