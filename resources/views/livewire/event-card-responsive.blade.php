<button wire:click="showModal">
    @php
        $src = $event['image_flyer'];
        if ($event['image_flyer'] == null) {
            $src = 'images/public/event-card-placeholder.png';
        }

        $endorsementRequest = $event->endorsementRequest;
    @endphp
    <img class="rounded-lg" src="{{ asset($src) }}" alt="">

    @if(!is_null($endorsementRequest))
        @if($endorsementRequest->endorsed)
            <div class="absolute top-4 right-4 z-10">
                @livewire('verified-badge', ['endorsementRequest' => $endorsementRequest, 'academicUnits' => $academicUnits])
            </div>
        @endif
    @endif
</button>