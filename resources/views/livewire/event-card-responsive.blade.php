<button wire:click="showModal" class="bg-fogra-dark">
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

@foreach ($users as $user)
    @if ($user->id === $event->user_id)
    <div class="flex items-center  text-white-ghost bg-fogra-dark pt-2 montserrat uppercase ">
        <img class="h-10 w-10 rounded-full object-cover" src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}"/>
        <h1 class="truncate ml-2">{{$user->name.' '.$user->surname}}</h1>
    </div>
    @endif
@endforeach