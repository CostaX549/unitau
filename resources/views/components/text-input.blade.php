@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300  focus:border-blue-500 dark:focus:border-blue-600 focus:ring-indigo-800 dark:focus:ring-blue-500 rounded-md shadow-sm']) !!}>
