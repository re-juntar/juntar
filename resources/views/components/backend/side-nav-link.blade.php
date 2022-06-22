@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center justify-center text-lg py-4 px-6 h-12 text-gray-100 underline underline-offset-4 decoration-awesome decoration-2 font-semibold leading-5 transition focus:decoration-indigo-700'
            : 'flex items-center justify-center text-lg py-4 px-6 h-12 font-semibold leading-5 text-gray-500 transition hover:subpixel-antialiased hover:text-gray-200 hover:underline hover:underline-offset-4 hover:decoration-gray-200 hover:decoration-2 focus:text-gray-400 focus:decoration-gray-400';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
