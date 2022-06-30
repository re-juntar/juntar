<button wire:click="showModal">
    @php
        $src = $event['image_flyer'];
        if ($event['image_flyer'] == null) {
            $src = 'images/public/event-card-placeholder.png';
        }
    @endphp
    <img class="rounded-lg" src="{{ asset($src) }}" alt="">
    @if(!is_null($event->endorsementRequest))
        @if($event->endorsementRequest->endorsed)
            <x-verified-badge class="absolute top-4 right-4 z-10"/>
        @endif
    @endif
</button>