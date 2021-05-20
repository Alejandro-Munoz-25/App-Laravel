<x-guest-layout>
    <div class="flex flex-row lg:flex-nowrap flex-wrap pt-8 gap-x-14 sm:justify-center items-start sm:pt-0 bg-gray-100 dark:bg-gray-800 transition-colors duration-700" style="min-height: calc(100vh - 7rem );">

        <!-- Nav config -->
        @include('includes.nav_config')

        <!-- Content -->
        <div class="w-full sm:max-w-2xl mt-6 px-6 py-4 bg-white dark:bg-gray-900 shadow-md overflow-hidden sm:rounded-lg transition duration-700">

            @include('includes.message')

            <div class="w-full mb-6 px-2 py-3 bg-gray-100 shadow-md border text-center dark:bg-gray-900 dark:border-gray-600 duration-700 overflow-hidden rounded-lg">
                <h2 class="font-bold text-xl tracking-wider text-black dark:text-white duration-700">Change Password</h2>
            </div>

            <form method="POST" action="{{ route('change.password') }}" enctype="multipart/form-data">
                @csrf

                <!-- Current Password -->
                <div class="mt-4">
                    <x-label for="current_password" :value="__('Current Password')" />

                    <x-input id="current_password" class="block mt-1 w-full" type="password" name="current_password" autocomplete="current-password" required autofocus />
                    @error('current_password')
                    <div class="leading-normal text-red-700 bg-red-100 rounded-md p-2 mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <!-- New Password -->
                <div class="mt-4">
                    <x-label for="new_password" :value="__('New Password')" />

                    <x-input id="new_password" class="block mt-1 w-full" type="password" name="new_password" autocomplete="current-password" required autofocus />
                    @error('new_password')
                    <div class="leading-normal text-red-700 bg-red-100 rounded-md p-2 mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Confirm New Password -->
                <div class="mt-4">
                    <x-label for="new_password_confirmation" :value="__('Confirm New Password')" />

                    <x-input id="new_password_confirmation" class="block mt-1 w-full" type="password" name="new_password_confirmation" required autofocus />
                    @error('new_password_confirmation')
                    <div class="leading-normal text-red-700 bg-red-100 rounded-md p-2 mt-2">{{ $message }}</div>
                    @enderror
                </div>


                <div class="flex items-center justify-end mt-8">
                    <x-button class="ml-4">
                        {{ __('Update Password') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
