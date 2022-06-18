<div>
    <a href="#modal" wire:click="$set('open', true)">
        @php
                $src = $event['image_flyer'];
                if($event['image_flyer'] == null){
                    $src = 'images/public/event-card-placeholder.png';
                }
            @endphp
        <img class="rounded-lg" src="{{ asset($src) }}" alt="">
    </a>
    
    <x-jet-dialog-modal wire:model="open" class="bg-gray-50">
        <x-slot name="content">
            <img class="rounded-lg" src="{{ asset($src) }}" alt="">
        </x-slot>
    </x-jet-dialog-modal>
</div>