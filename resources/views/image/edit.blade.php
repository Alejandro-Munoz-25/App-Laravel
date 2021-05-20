<x-guest-layout>
    <div class="flex flex-col pt-8 sm:justify-center items-center sm:pt-0 bg-gray-100 dark:bg-gray-800" style="min-height: calc(100vh - 7rem );">
        <div class="w-full sm:max-w-3xl mt-6 px-6 py-4 bg-white dark:bg-gray-900 duration-700 shadow-md overflow-hidden sm:rounded-lg">
            <!-- Message Success -->
            @include('includes.message')
            <!-- Card -->
            <div class="w-full mb-4 px-2 py-3 bg-gray-50 dark:bg-gray-800 duration-700 dark:border-gray-600 shadow-md border text-center overflow-hidden rounded-lg">
                <h2 class="font-bold text-xl tracking-wider text-black dark:text-white duration-700">Edit Image</h2>
            </div>

            <form method="POST" action="{{ route('image.update') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="image_id" value="{{$image->id}}">
                <!-- Image -->
                <div class="mt-4">
                    <!-- Image -->
                    <div class="mt-4">
                        <!-- Image -->
                        <div class="overflow-hidden flex rounded-lg mb-4">
                            <img src="{{ route('image.file',['filename'=>$image->image_path]) }}" id="imgpost" class="w-full h-98 mx-auto" />
                        </div>
                    </div>
                    <x-label for="image_path" :value="__('Select an Image')" />
                    <x-input id="image_path" class="block mt-1 w-full border mb-4 {{$errors->has('image_path')?'border-red-500 text-red-600':''}}" type="file" name="image_path" onchange="loadFile(event);" />
                    @error('image_path')
                    <div class="leading-normal text-red-700 bg-red-100 rounded-md p-2 my-2">{{ $message }}</div>
                    @enderror
                    <div class="relative">
                        <x-label for="description" :value="__('Description')" />
                        <textarea id="description" class="block mt-1 w-full dark:bg-gray-700 dark:text-gray-200 duration-700 {{$errors->has('description')?'border-red-500':''}}" name="description">{{$image->description}}</textarea>
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
                        <x-label :value="__('Selected Image')" class="hidden my-5" id="imgSelected" />
                        <img src="" id="img" class="w-80 h-80 hidden mx-auto rounded" />
                    </div>

                </div>
                <div class="flex items-center justify-end mt-4">
                    <x-button class="ml-4">
                        {{ __('Update Image') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
