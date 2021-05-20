<x-app-layout>
    <div class="relative flex items-top justify-center transition duration-700 bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0" style="min-height: calc(100vh - 4.1rem );">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
                <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
                    404
                </div>

                <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
                    Not Found
                </div>
            </div>
            <div class="text-center mt-5"><a class="dark:text-white text-center duration-700" href="{{ route('home') }}">Go Home</a></div>
        </div>
    </div>
</x-app-layout>
