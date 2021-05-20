<x-guest-layout>

    <x-auth-card>
        <!-- Message Success -->
        @include('includes.message')
        <!-- Card -->
        <div class="w-full mb-6 px-2 py-3 bg-gray-50 dark:bg-gray-900 duration-700 dark:border-gray-600 shadow-md border text-center overflow-hidden rounded-lg">
            <h2 class="font-bold text-xl tracking-wider text-black dark:text-white duration-700 ">Post Image</h2>
        </div>

        <!-- Image Form -->
        <form method="POST" action="{{ route('image.save') }}" enctype="multipart/form-data">
            @csrf

            <div class="mt-4">

                <x-label for="image_path" :value="__('Select an Image')" />
                <x-input id="image_path" class="block focus:outline-none p-1 mt-1 w-full border mb-4 {{$errors->has('image_path')?'border-red-500 text-red-600':''}}" type="file" name="image_path" onchange="loadFile(event);" />
                @error('image_path')
                <div class="leading-normal text-red-700 bg-red-100 rounded-md p-2 my-2">{{ $message }}</div>
                @enderror
                <div class="relative">
                    <x-label for="description" :value="__('Description')" />
                    <textarea id="description" class="block mt-1 w-full dark:bg-gray-700 dark:text-gray-200 duration-700 rounded-lg {{$errors->has('description')?'border-red-500':''}}" name="description"> </textarea>
                    @error('description')
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <svg v-if="$v.user.email.$error" class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div class="leading-normal text-red-700 bg-red-100 rounded-md p-2 my-2">{{ $message }}</div>
                @enderror
                <div>
                    <x-label :value="__('Selected Image')" class="hidden my-5 " id="imgSelected" />
                    <img src="" id="img" class="w-80 h-80 hidden mx-auto rounded" />
                </div>

            </div>
            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Post') }}
                </x-button>
            </div>
        </form>

    </x-auth-card>
</x-guest-layout>
