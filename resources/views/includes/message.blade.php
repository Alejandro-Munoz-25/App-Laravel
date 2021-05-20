@if(session('message'))
<div class="relative px-4 py-3 z-0 leading-normal text-green-700 bg-green-100 rounded mb-4">
    <span class="absolute top-2 left-0 flex items-center ml-2">
        <svg class="w-8 h-8 fill-current" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
            <circle style="fill:#25AE88;" cx="25" cy="25" r="25" />
            <polyline style="fill:none;stroke:#FFFFFF;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" points="38,15 22,33 12,25 " />
        </svg>
    </span>
    <div class="ml-9">
        <p>
            {{session('message')}}
        </p>
    </div>
</div>
@endif
