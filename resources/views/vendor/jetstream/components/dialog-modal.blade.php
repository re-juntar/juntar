@props(['id' => null, 'maxWidth' => null, 'useDefaultStyle' => true])

<x-jet-modal :id="$id" :maxWidth="$maxWidth" :useDefaultStyle="$useDefaultStyle" {{ $attributes }}>
        
    <div class="{{$useDefaultStyle ? 'px-6 py-4' : ''}}" >
        @if(isset($title))  
            <div class="text-lg">
                {{ $title }}
            </div>
        @endif
        @if(isset($content))
            <div class="{{$useDefaultStyle ? 'mt-4' : ''}}">
                {{ $content }}
            </div>
        @endif
    </div>
    @if(isset($footer))
    <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 text-right">
        {{ $footer }}
    </div>
    @endif
</x-jet-modal>