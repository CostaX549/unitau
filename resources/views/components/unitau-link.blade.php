@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'p-1.5 text-white focus:outline-nones transition-colors duration-200 rounded-lg  bg-blue-500'
                : 'p-1.5 text-white focus:outline-nones transition-colors duration-200 rounded-lg  hover:bg-blue-500';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>

    {{ $slot }}
</a>
