<x-app-layout>

    @include('includes.message')
    @include('includes.modal',
    ['title'=>'Delete Image',
    'paragraph_1'=>'Are you sure you want to delete this image?',
    'paragraph_2'=>'You will lose this post.',
    'route_name'=>'image.delete',
    'id'=>$image->id
    ])

    <div class="py-8">
        <div class="lg:max-w-4xl md:max-w-2xl mx-auto ">
            <div class="bg-white dark:bg-gray-900 duration-700 shadow-sm sm:rounded-lg overflow-hidden">
                <!-- Info User -->
                <div class="flex items-center px-6 py-4 border-b-0 border-gray-200">
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
                <div class="overflow-hidden h-144 flex">
                    <img src="{{ route('image.file',['filename'=>$image->image_path]) }}" id="imgpost" class="w-full h-144 mx-auto " />
                </div>

                <!-- Info Image -->
                <div class="px-4 my-4">

                    <!--  Likes -->
                    <div class="flex flex-row items-center gap-x-4 border-b-0 border-gray-200">

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
                        @if(Auth::user()&&Auth::user()->id==$image->user->id)
                        <div class="flex flex-row justify-center items-center ml-auto">

                            <!-- Button Delete -->
                            <button onclick="openModal(true)" class="hover:bg-red-200 px-4 py-2 rounded focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 stroke-current text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>

                            <!-- Button Edit -->
                            <a class="hover:bg-blue-200 px-4 py-2 rounded focus:outline-none" href="{{route('image.edit',['id'=>$image->id])}}">
                                <svg class="w-8 h-8 stroke-current text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>
                        </div>
                        @endif
                    </div>
                    <!--  Description -->
                    <div class="my-2 justify-start text-lg">
                        <div class="text-gray-400  my-2">
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
                    <!--  Comments -->
                    @include('includes.comments')
                </div>

            </div>
        </div>
    </div>

</x-app-layout>
