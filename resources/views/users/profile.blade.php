<x-app-layout>


    @include('includes.message')

    <div class="max-w-6xl mx-auto flex flex-row gap-x-6 w-full align-center justify-start items-center my-10 overflow-hidden  sm:rounded-lg">
        <!-- Image User -->
        <div class="ml-4 p-1">
            @if($user->image)
            <img class="md:h-60 md:w-60 h-28 w-28 rounded-full dark:ring-2 dark:ring-gray-600 duration-700 p-2" src="{{route('user.avatar',['filename'=>$user->image])}}" alt="imageUser">
            @else
            <svg class="md:h-60 md:w-60 h-28 w-28 rounded-full fill-current text-gray-400 bg-gray-200 flex items-center" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 13a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            @endif
        </div>
        <!-- @end image user -->

        <!-- Image User -->
        <div>
            <h1 class="dark:text-white duration-700">{{$user->name.' '.$user->surname}}</h1>
            <h2 class="tracking-widest dark:text-gray-300 duration-700">{{'@'.$user->nick}}</h2>
            <p class="text-gray-400 mt-2 dark:text-gray-400 duration-700">
                {{'Joined: '.\Carbon\Carbon::createFromTimeStamp(strtotime($user->created_at))->locale('en')->diffForHumans() }}
            </p>
        </div>
        <!-- @end info user -->

    </div>

    <!-- Images User -->
    @if(count($user->images)>0)
    <div class="lg:mx-10 sm:mx-5 mx-0 md:grid xl:grid-cols-3 md:grid-cols-2 gap-4 h-full pb-8">
        @include('image.posts',['images'=>$user->images])
    </div>
    @else
    <div class="max-w-6xl mx-auto text-center bg-gray-300  rounded-lg py-5 my-10 block h-full">
        <p class="dark:text-white">No records</p>
    </div>
    @endif

    <!-- PAGINACIÓN -->
    <div class="ajax-load flex align-center justify-center text-center" style="display:none">
        <p class="flex flex-col items-center items-center"><img class="w-8 h-8 " src="{{url('images/Spin.svg')}}">Loading More post</p>
    </div>
</x-app-layout>
