@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-semibold text-lg text-white']) }}>
    {{ $value ?? $slot }}
</label>
