<x-app-layout>
    <div class="py-8">
        <div class="max-w-6xl mx-auto ">
            <div class="bg-white dark:bg-gray-900 duration-700 dark:text-gray-200 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex items-center justify-center p-6 border-b-0 border-gray-200">
                    <h2 class="text-3xl">My favs</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Favorites image user -->
    <div id="post-data" class="">
        @include('image.favorite')
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
