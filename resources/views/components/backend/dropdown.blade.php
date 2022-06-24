<button x-data="{ open: false }" x-on:click="open = true" @click.outside="open = false" {{ $attributes->merge(['class' => 'group focus:outline-none w-full']) }}  :class="open ? 'bg-fogra-darkish' : ''">
    <div class="flex items-center justify-center text-lg py-4 px-6 h-12 text-gray-500 decoration-2 font-semibold leading-5 transition">
    @if( isset($profile))
        {{ $profile }}
    @else
        <p class="truncate" :class="open ? 'text-gray-100' : ''">{{ $dropName }}</p>
    @endif
        <i x-show="!open" class="fa fa-caret-down ml-1"></i>
        <i x-show="open" class="fa fa-caret-up ml-1 text-gray-100"></i>
    </div>
    <div class="max-h-0 overflow-hidden duration-300 group-focus:max-h-40">
        {{ $links }}
    </div>
</button>