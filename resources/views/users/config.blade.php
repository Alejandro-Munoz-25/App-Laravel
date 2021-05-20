<x-guest-layout>

    <div class="flex flex-row lg:flex-nowrap flex-wrap pt-8 gap-x-14 sm:justify-center items-start sm:pt-0 bg-gray-100 dark:bg-gray-800 transition-colors duration-700" style="min-height: calc(100vh - 7rem );">
        <!-- Nav menu -->
        @include('includes.nav_config')

        <div class="w-full sm:max-w-2xl mt-6 px-6 py-4 bg-white dark:bg-gray-900 shadow-md overflow-hidden sm:rounded-lg transition duration-700">

            @include('includes.message')

            <div class="w-full mb-6 px-2 py-3 bg-gray-100 shadow-md border text-center dark:bg-gray-900 dark:border-gray-600 duration-700 overflow-hidden rounded-lg">
                <h2 class="font-bold text-xl tracking-wider text-black dark:text-white duration-700">Account Settings</h2>
            </div>
           <!-- Config form -->
            <form method="POST" action="{{ route('user.update') }}" enctype="multipart/form-data">
                @csrf

                <!-- Name -->
                <div>
                    <x-label for="name" :value="__('Change Name')" />

                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{Auth::user()->name}}" required autofocus />
                </div>
                <!-- Surname -->
                <div class="mt-4">
                    <x-label for="surname" :value="__('Change Surname')" />

                    <x-input id="surname" class="block mt-1 w-full" type="text" name="surname" value="{{Auth::user()->surname}}" required autofocus />
                </div>
                <!-- Nick Name -->
                <div class="mt-4">
                    <x-label for="nick" :value="__('Change Nickname')" />

                    <x-input id="nick" class="block mt-1 w-full" type="text" name="nick" value="{{Auth::user()->nick}}" required autofocus />
                    @error('nick')
                    <div class="leading-normal text-red-700 bg-red-100 rounded-md p-2 mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="mt-4">

                    <x-label for="email" :value="__('Change Email')" />

                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{Auth::user()->email }}" required />
                    @error('email')
                    <div class="leading-normal text-red-700 bg-red-100 rounded-md p-2 mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Image -->
                <div class="mt-4">
                    <x-label for="image_path" :value="__(' Change Image')" />
                    <x-input id="image_path" class="block mt-1 w-full duration-400" type="file" name="image_path" onchange="loadFile(event);" />
                    @error('image_path')
                    <div class="leading-normal text-red-700 bg-red-100 rounded-md p-2 mt-2">{{ $message }}</div>
                    @enderror
                    @if(Auth::user()->image)
                    <x-avatar class="rounded-lg h-80 w-80 mt-6 mx-auto" />
                    @endif
                    <div>
                        <x-label :value="__('Selected Image')" class="hidden my-5 " id="imgSelected" />
                        <img src="" id="img" class="w-80 h-80 hidden mx-auto rounded" />
                    </div>
                </div>

                <div class="flex items-center justify-end mt-8">
                    <x-button class="ml-4">
                        {{ __('Update') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
