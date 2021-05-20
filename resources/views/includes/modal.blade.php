<!-- overlay -->
@if(isset($id_comment))
<div id="modal_overlay_{{$id_comment}}" class="hidden z-40 fixed inset-0 bg-black bg-opacity-80 h-full w-full flex justify-center items-start md:items-center pt-10 md:pt-0">
    @else
    <div id="modal_overlay" class="hidden z-40 fixed inset-0 bg-black bg-opacity-80 h-full w-full flex justify-center items-start md:items-center pt-10 md:pt-0">
        @endif
        <!-- modal -->
        @if(isset($id_comment))
        <div id="modal_{{$id_comment}}" class="flex flex-col justify-center opacity-0 transform -translate-y-full scale-150  relative w-10/12 md:w-auto h-1/2 md:h-auto bg-white rounded shadow-lg transition-opacity transition-transform duration-300">
            @else
            <div id="modal" class="flex flex-col justify-center opacity-0 transform -translate-y-full scale-150  relative w-10/12 md:w-auto h-1/2 md:h-auto bg-white rounded shadow-lg transition-opacity transition-transform duration-300">
                @endif


                <!-- button close -->
                <button onclick="@if(isset($id_comment)) openModalComment(false,{{$id_comment}}) @else openModal(false) @endif" class="absolute -top-3 -right-3 bg-red-500 hover:bg-red-600 text-2xl w-10 h-10 rounded-full focus:outline-none text-white">
                    &cross;
                </button>

                <!-- header -->
                <div class="px-4 py-3 border-b border-gray-200 w-full">
                    <h2 class="text-xl font-semibold text-gray-600">{{$title}}</h2>
                </div>

                <!-- body -->
                <div class="w-full text-lg py-4 px-6">
                    <p>{{$paragraph_1}}</p>
                    <p class="text-xl text-gray-500">{{$paragraph_2}}</p>
                </div>

                <!-- footer -->
                <div class="px-4 py-3 border-t border-gray-200 w-full flex justify-end items-center gap-3">
                    <button class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded text-white focus:outline-none">
                        @if (isset($id))
                        <a href="{{route($route_name,$id)}}">
                            Delete Image
                        </a>
                        @elseif (isset($id_comment))
                        <a href="{{route($route_name,['id'=>$id_comment])}}">
                            Delete Comment
                        </a>
                        @else
                        <a href="{{route($route_name)}}">
                            Delete
                        </a>
                        @endif
                    </button>
                    <button onclick="@if(isset($id_comment)) openModalComment(false,{{$id_comment}}) @else openModal(false) @endif" class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded text-white focus:outline-none">Close</button>
                </div>
            </div>
        </div>
