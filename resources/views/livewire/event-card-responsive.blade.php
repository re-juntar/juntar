<button wire:click="showModal">
    @php
        $src = $event['image_flyer'];
        if ($event['image_flyer'] == null) {
            $src = 'images/public/event-card-placeholder.png';
        }
    @endphp
    <img class="rounded-lg" src="{{ asset($src) }}" alt="">
    <x-verified-badge class="absolute top-4 right-4 z-10" />
</button>