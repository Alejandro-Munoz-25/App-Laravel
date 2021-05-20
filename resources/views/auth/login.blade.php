<x-guest-layout>
    @include('includes.message')
    <x-auth-card>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded dark:focus:ring-indigo-800 dark:focus:border-indigo-500 focus:ring-offset-0 dark:border-gray-500 dark:bg-gray-700 border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-colors duration-700" name="remember">
                    <span class="ml-2 text-sm text-gray-600 dark:text-white transition-colors duration-700">{{ __("Remember me") }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4 ">
                <a href="{{ route('register') }}" class="mr-auto dark:text-gray-400 text-sm text-gray-700 underline transition-colors duration-700">Register</a>
                @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 transition-colors duration-700" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
                @endif

                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
