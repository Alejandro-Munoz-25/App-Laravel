<x-app-layout>


    @include('includes.message')
    <div class="max-w-6xl mx-auto flex flex-col gap-x-6 gap-y-10 w-full align-center justify-center items-center mt-4 md:mt-8 overflow-hidden sm:rounded-lg p-4">

        <div class="w-full px-2 py-3 bg-gray-100 dark:bg-gray-900 dark:border-gray-600 duration-700 shadow-md border text-center overflow-hidden rounded-lg">
            <h1 class="font-bold text-xl tracking-wider text-black dark:text-white transition-colors duration-700">Profiles</h1>
        </div>

        <!-- Search -->
        <div class="w-full text-center overflow-hidden">
            <form action="{{route('user.index')}}" method="post" id="search" onsubmit="search(this)" class="w-full flex flex-row justify-end">
                @csrf
                <div class="flex items-center justify-end gap-x-2 w-4/5 sm:w-1/2 md:w-1/3 p-1 ">
                    <x-input id="input-search" class="block mt-1 w-full" type="text" name="input-search" value="{{old('input-search')}}" />
                    <button class="duration-700 text-white p-3 outline-none focus:outline-none hover:bg-gray-300 dark:hover:bg-gray-700 rounded-full">
                        <svg class="w-6 h-6 text-black dark:text-white duration-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <!-- Profiles -->
        <div id="post-data">
            @include('users.profiles')
        </div>
    </div>
    <!-- PAGINACIÓN -->
    <div class="ajax-load flex align-center justify-center text-center" style="display:none">
        <p class="flex flex-col items-center items-center dark:text-white">
            <svg class="animate-spin h-8 w-8" id="Capa_1" enable-background="new 0 0 497 497" height="512" viewBox="0 0 497 497" width="512" xmlns="http://www.w3.org/2000/svg">
                <g>
                    <circle cx="98" cy="376" fill="#909ba6" r="53" />
                    <circle cx="439" cy="336" fill="#c8d2dc" r="46" />
                    <circle cx="397" cy="112" fill="#e9edf1" r="38" />
                    <ellipse cx="56.245" cy="244.754" fill="#7e8b96" rx="56.245" ry="54.874" />
                    <ellipse cx="217.821" cy="447.175" fill="#a2abb8" rx="51.132" ry="49.825" />
                    <ellipse cx="349.229" cy="427.873" fill="#b9c3cd" rx="48.575" ry="47.297" />
                    <ellipse cx="117.092" cy="114.794" fill="#5f6c75" rx="58.801" ry="57.397" />
                    <ellipse cx="453.538" cy="216.477" fill="#dce6eb" rx="43.462" ry="42.656" />
                    <circle cx="263" cy="62" fill="#4e5a61" r="62" />
                </g>
            </svg>
            Loading More post
        </p>
    </div>
</x-app-layout>
