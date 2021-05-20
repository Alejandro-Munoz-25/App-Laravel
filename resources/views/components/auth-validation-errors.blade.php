@props(['errors'])

@if ($errors->any())
<div class="relative px-4 py-3 leading-normal text-red-700 bg-red-100 rounded-lg border-t-8 border-red-500 mb-4">
    <span class="absolute top-2 left-0 flex items-center ml-2">
        <svg class="w-10 h-10 fill-current" viewBox="0 0 20 20">
            <path d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" fill-rule="evenodd"></path>
        </svg>
    </span>
    <div class="ml-9">
        <p>{{ __('Whoops! Something went wrong.') }}</p>
        <ul class=" mt-3 list-disc list-inside text-sm text-red-600">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif
