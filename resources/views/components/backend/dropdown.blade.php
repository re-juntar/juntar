@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center justify-center text-lg py-4 px-6 h-12 text-gray-100 decoration-2 font-semibold leading-5 transition'
            : 'flex items-center justify-center text-lg py-4 px-6 h-12 font-semibold leading-5 text-gray-500 transition';
@endphp

<button x-data="{ open: false }" x-on:click="open = true" @click.outside="open = false" class="group focus:outline-none">
    <div {{ $attributes->merge(['class' => $classes]) }}>
    @if( isset($profile))
        {{ $profile }}
    @else
        <p>Drop</p>
    @endif
        <i x-show="!open" class="fa fa-caret-down ml-1"></i>
        <i x-show="open" class="fa fa-caret-up ml-1"></i>
    </div>
    <div class="max-h-0 overflow-hidden duration-300 group-focus:max-h-40">
        {{ $slot }}
    </div>
</button>