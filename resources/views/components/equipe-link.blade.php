@props(['active'])

@php
    $classes = ($active ?? false)
                ?  'flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all bg-blue-50  focus:bg-blue-50 focus:bg-opacity-80  focus:text-blue-900 text-blue-900 outline-none'
                : 'flex items-center w-full p-3 rounded-lg text-start leading-tight transition-all hover:bg-blue-50 hover:bg-opacity-80 focus:bg-blue-50 focus:bg-opacity-80 active:bg-gray-50 active:bg-opacity-80 hover:text-blue-900 focus:text-blue-900 active:text-blue-900 outline-none';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>

    {{ $slot }}
</a>
 