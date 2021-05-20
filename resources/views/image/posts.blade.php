@foreach($images as $image)
<div class="max-w-3xl mx-auto h-full w-full">
    <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg h-full duration-700">
        <!-- Info User -->
        <div class="flex items-center p-6 dark:bg-gray-900 duration-700 border-b-0 border-gray-200">
            @if($image->user->image)
            <a href="{{route('user.profile',['id'=>$image->user->id])}}">
                <img class="w-14 h-14 md:h-16 md:w-16 rounded-full ring-2 ring-gray-300 duration-700" src="{{route('user.avatar',['filename'=>$image->user->image])}}" alt="imageUser" />
            </a>
            @else
            <a href="{{route('user.profile',['id'=>$image->user->id])}}">
                <svg class="h-14 w-14 md:h-16 md:w-16 fill-current rounded-full text-gray-400 bg-gray-100 ring-2 ring-gray-300 duration-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </a>
            @endif
            <div class="ml-5">
                <p class="md:text-2xl font-serif dark:text-gray-300 duration-700">
                    <a href="{{route('user.profile',['id'=>$image->user->id])}}">
                        {{$image->user->name.' '.$image->user->surname}}
                    </a>
                </p>
                <p class="md:text-xl text-gray-500 font-serif dark:text-gray-400 duration-700">
                    {{'@'.$image->user->nick}}
                </p>
            </div>
        </div>
        <!-- Image -->
        <div class="overflow-hidden flex w-full">
            <a href="{{route('image.detail',['id'=>$image->id])}}" class="w-full max-w-144 h-144 mx-auto ">
                <img src="{{ route('image.file',['filename'=>$image->image_path]) }}" id="imgpost" class="w-full h-full" />
            </a>

        </div>

        <!-- Info Image -->
        <div class="px-4 my-4">

            <!--  Likes -->
            <div class="flex flex-row items-center gap-x-4 border-b-0 border-gray-500">

                @php
                $user_like=false;
                @endphp

                @foreach($image->likes as $like)
                @if($like->user->id==Auth::user()->id)
                @php
                $user_like=true;
                @endphp
                @endif
                @endforeach

                @if($user_like)
                <svg class="w-10 h-10 fill-current text-red-500 cursor-pointer like" onclick="likes(this)" data-id="{{$image->id}}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
                <!-- <img src="{{ asset('images/heart_color.svg') }}" onclick="likes(this)" data-id="{{$image->id}}" class="w-8 h-8 cursor-pointer like" /> -->
                @else
                <svg class="w-10 h-10 cursor-pointer dark:text-gray-200 dislike" onclick="likes(this)" data-id="{{$image->id}}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
                <!-- <img src="{{ asset('images/heart.svg') }}" onclick="likes(this)" data-id="{{$image->id}}" class="w-8 h-8 cursor-pointer dislike" /> -->
                @endif
                <span class="text-gray-400 count" id="{{'likes_'.$image->id}}">
                    {{count($image->likes).' Likes'}}
                </span>
                <!--  Comments -->
                <div class="flex gap-x-2 justify-start text-md">
                    <a href="{{route('image.detail',['id'=>$image->id])}}" class="flex flex-row gap-x-1 items-center justify-center dark:text-gray-300 duration-700">
                        <svg class="w-10 h-10 dark:text-white duration-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        <span>
                            ({{count($image->comments)}})
                        </span>
                    </a>
                </div>
            </div>
            <!--  Description -->
            <div class="my-2 text-lg">
                <div class="text-gray-400 my-2 duration-700">
                    <span>
                        {{\Carbon\Carbon::createFromTimeStamp(strtotime($image->created_at))->locale('en')->diffForHumans() }}
                    </span>
                </div>
                <div class="flex flex-row gap-x-2 dark:text-gray-200 duration-700">
                    <span>
                        {{'@'.$image->user->nick}}
                    </span>
                    <p class="text-gray-500 dark:text-gray-400 duration-700">
                        {{$image->description}}
                    </p>
                </div>
            </div>
            <!-- Comments -->
            @include('includes.comments')
        </div>

    </div>
</div>
@endforeach
