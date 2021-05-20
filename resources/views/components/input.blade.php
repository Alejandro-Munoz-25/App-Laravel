@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' =>$disabled ? 'disabled:opacity-50' : 'rounded-md shadow-sm border-gray-300 dark:border-gray-500 dark:bg-gray-700 dark:text-gray-200 focus:border-indigo-300 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800 focus:ring-opacity-50 transition duration-700']) !!}>
