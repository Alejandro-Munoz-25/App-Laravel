<div class="text-lg">
    <h2 class="border-b-2 text-2xl dark:text-white duration-700">Comments ({{count($image->comments)}})</h2>

    <!-- Form Comments -->
    <form method="POST" class="z-0" action="{{ route('comment.save',['id'=>$image->id]) }}" enctype="multipart/form-data">
        @csrf
        <div class="mt-4">
            <x-input type="hidden" name="image_id" value="{{$image->id}}" />
            <div class="flex flex-row gap-x-2 items-center h-14 relative">
                <!-- Avatar -->
                <x-avatar class="w-12 h-12 rounded-full dark:ring-2 dark:ring-gray-600 duration-700"></x-avatar>

                <!-- Comment -->
                <textarea id="image-comment_{{$image->id}}" placeholder="Add a comment" class="w-11/12 resize-none h-12 rounded-full no-scroll
                                    @error('comment_'.$image->id) border-red-500 @enderror dark:bg-gray-700 dark:text-gray-200 duration-700" name="comment_{{$image->id}}"></textarea>

                <!-- Submit -->
                <button class="h-full py-2">
                    <svg class="dark:text-gray-400 fill-current duration-700 h-full" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                        <path d="M481.508,210.336L68.414,38.926c-17.403-7.222-37.064-4.045-51.309,8.287C2.86,59.547-3.098,78.551,1.558,96.808
			L38.327,241h180.026c8.284,0,15.001,6.716,15.001,15.001c0,8.284-6.716,15.001-15.001,15.001H38.327L1.558,415.193
			c-4.656,18.258,1.301,37.262,15.547,49.595c14.274,12.357,33.937,15.495,51.31,8.287l413.094-171.409
			C500.317,293.862,512,276.364,512,256.001C512,235.638,500.317,218.139,481.508,210.336z" />
                    </svg>
                </button>
            </div>
            @error("comment_$image->id")
            <div class="leading-normal text-red-700 bg-red-100 rounded-md p-2 my-2">The comment field is Required.</div>
            @enderror

        </div>
    </form>
    <div class="py-4 justify-start text-lg">

        <!-- Comments -->
        @foreach($image->comments as $comment)

        <div class="flex flex-row gap-x-2">
            <span class="dark:text-white duration-700">
                {{--Se llama al método getUser del modelo que guarda la relación inversa , que obtiene el usuario  --}}
                <a href="{{route('user.profile',['id'=>$comment->getUser->id])}}">
                    {{'@'.$comment->getUser->nick}}
                </a>
            </span>
            <p class="text-gray-500 dark:text-gray-400 duration-700">
                {{$comment->content}}
            </p>

            @if(Auth::check() && $comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id)

            <button onclick="openModalComment(true,'{{$comment->id}}')" class="hover:bg-red-200 px-4 rounded focus:outline-none ml-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 stroke-current text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </button>
            <!-- Modal delete Comment -->
            @include('includes.modal',
            ['title'=>'Delete Comment',
            'paragraph_1'=>'Are you sure you want to delete this comment?',
            'paragraph_2'=>'',
            'route_name'=>'comment.delete',
            'id_comment'=>$comment->id
            ])
            <!-- <a href="{{route('comment.delete',['id'=>$comment->id])}}" class="ml-auto">
                                </a> -->
            @endif

        </div>

        <div class="text-gray-400 mb-2 text-sm">
            <span>
                {{\Carbon\Carbon::createFromTimeStamp(strtotime($comment->created_at))->locale('en')->diffForHumans() }}
            </span>
        </div>
        @endforeach
    </div>

</div>
