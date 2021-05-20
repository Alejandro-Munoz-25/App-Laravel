<div class="lg:mx-10 sm:mx-5 mx-0 sm:grid xl:grid-cols-4 sm:grid-cols-2 md:grid-cols-3 gap-x-4 gap-y-8 mb-8 w-full transition duration-700">
    @if(!count($users)>0)
    <h1 class="dark:text-white text-center text-lg">No Users</h1>
    @endif
    @foreach($users as $user)
    <!-- Image User -->
    <div class="flex flex-col items-center justify-items-center gap-y-4 mb-8 md:mb-0">
        <div>
            @if($user->image)
            <a href="{{route('user.profile',['id'=>$user->id])}}">
                <img class="md:h-60 md:w-60 h-48 w-48 rounded-full max-w-full" src="{{route('user.avatar',['filename'=>$user->image])}}" alt="imageUser">
            </a>
            @else
            <a href="{{route('user.profile',['id'=>$user->id])}}">
                <svg class="md:h-60 md:w-60 h-48 w-48 rounded-full fill-current text-gray-400 bg-gray-200 flex items-center" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 13a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </a>
            @endif
        </div>
        <!-- @end image user -->

        <!-- Info user -->
        <div class="w-full text-center">
            <h2 class="dark:text-white duration-700">{{'@'.$user->nick}}</h2>
            <h3 class="py-2 dark:text-gray-400 duration-700">{{$user->name.' '.$user->surname}}</h3>
            <p class="text-gray-400 dark:text-gray-500 duration-700">
                {{'Joined: '.\Carbon\Carbon::createFromTimeStamp(strtotime($user->created_at))->locale('en')->diffForHumans() }}
            </p>
        </div>
        <!-- @end info user -->
    </div>
    @endforeach
</div>
