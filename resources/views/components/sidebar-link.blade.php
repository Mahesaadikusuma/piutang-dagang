@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'flex items-center p-2 text-gray-900 rounded-lg bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white'
            : 'flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700';
@endphp

<a wire:navigate.hover {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
