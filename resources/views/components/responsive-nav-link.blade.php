@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block pl-3 pr-4 py-2 border-l-4 border-indigo-400 text-base font-medium text-indigo-700 dark:text-indigo-300 bg-indigo-50 dark:bg-indigo-900 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition duration-150 ease-in-out transition-colors duration-700'
            : 'block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 dark:text-gray-100 hover:text-gray-800 dark:hover:text-gray-200 hover:bg-gray-50 hover:border-gray-300 dark:hover:bg-gray-700 focus:outline-none focus:text-gray-800 dark:focus:text-gray-400 focus:bg-gray-50 dark:focus:bg-gray-600 focus:border-gray-300 transition duration-150 ease-in-out transition-colors duration-700';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
