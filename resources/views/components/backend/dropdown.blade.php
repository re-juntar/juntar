<div x-data="{ open: false }" x-on:click="open = ! open " @click.outside="open = false"
    {{ $attributes->merge(['class' => 'w-full']) }} :class="open ? 'bg-fogra-darkish' : ''">
    <div
        class="flex items-center justify-center text-lg py-4 px-6 h-12 text-gray-500 decoration-2 font-semibold leading-5 cursor-pointer transition duration-400">
        @if (isset($profile))
            {{ $profile }}
        @else
            <p class="truncate" :class="open ? 'text-gray-100' : ''">{{ $dropName }}</p>
        @endif
        <i x-show="!open" class="fa fa-caret-down ml-1"></i>
        <i x-show="open" class="fa fa-caret-up ml-1 text-gray-100"></i>
    </div>
    <div x-show="open" class="h-fit" x-transition.duration.400ms>
        {{ $links }}
    </div>
</div>
