@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-xl text-green-600 dark:text-green-400']) }}>
        {{ $status }}
    </div>
@endif
