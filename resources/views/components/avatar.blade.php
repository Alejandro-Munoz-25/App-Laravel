<!-- @auth -->
@if(Auth::user()->image)
<img {{$attributes->merge(['class'=>"ring-2 ring-gray-300 rounded-full"]) }} src="{{route('user.avatar',['filename'=>Auth::user()->image])}}" alt="imageUser">
@else
<svg {{$attributes->merge(['class'=>"fill-current text-gray-400 ring-2 ring-gray-300 rounded-full bg-gray-100"]) }} xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
</svg>
@endif
<!-- @endauth -->
