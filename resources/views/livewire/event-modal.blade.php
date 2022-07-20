<x-jet-dialog-modal wire:model="open">
    @if (!isset($event))
        <x-slot name="content">
            <h1 class="text-awesome">No event loaded</h1>
        </x-slot>
    @else
        <x-slot name="content">

            <x-button
                class="bg-transparent text-black font-extrabold absolute top-4 right-4 z-10 hover:overscroll-auto hover:text-white-ghost"
                wire:click="$set('open', false)">X</x-button>

            <div class="bg-white-ghost md:min-h-[60vh] md:relative">

                <div class="flex justify-center rounded-lg p-4 h-full md:w-2/4">
                    @php
                        $src = $event['image_flyer'];
                        if ($event['image_flyer'] == null) {
                            $src = 'images/public/event-card-placeholder.png';
                        }
                    @endphp
                    <img class="shadow-lg rounded-lg" src="{{ asset($src) }}" alt="">
                </div>

                <div
                    class="p-4 overscroll-contain md:absolute md:w-2/4 md:overflow-y-scroll md:ml-[50%] md:inset-y-0 md:left-0">
                    <x-button class="bg-cyan-500 mr-2">Inscribirse</x-button>
                    <x-button class="mr-2">Flyer</x-button>
                    <x-button class="bg-fogra-darkish text-white-ghost">Compartir</x-button>

                    <div class="container mt-4">
                        <h1 class="text-2xl font-bold">{{ $event->name }}</h1>
                        <a class="text-2xl text-red-600" href={{ route('evento', $event->id) }}
                            id={{ $event->id }}>Ver mas</a>

                        <div class="container mt-2">

                        <h2 class="text-lg font-semibold">Organiza:
                            <span class="font-normal">{{$event->user->name}} {{$event->user->surname}}</span>
                        </h2>

                        @if(count($event->coorganizers) > 0)
                        <div class="flex flex-row mt-1">
                            <h2 class="text-lg font-semibold">Co-organiza: </h2>
                            <ul class="text-lg ml-1">
                                @foreach($event->coorganizers as $coorganizer)
                                    <li>{{$coorganizer->user->name}} {{$coorganizer->user->surname}}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <h3 class="font-bold mt-2">Fecha de inicio: {{$event->start_date}}</h3>

                        <h3 class="font-bold mt-1">Fecha de finalización: {{$event->start_date}}</h3>

                        @if(!is_null($event->pre_registration))
                            @if($event->pre_registration)
                                <h3 class="font-bold mt-1">Fecha límite de preinscripción: {{$event->inscription_end_date}}</h3>
                            @endif
                        @endif

                        <h3 class="font-bold mt-4">Modalidad: {{$event->eventModality->description}}</h3>

                        @if(!is_null($event->endorsementRequest))
                            @if($event->endorsementRequest->endorsed)
                                <x-verified-badge class="mt-4" />
                            @endif
                        @endif

                        <h2 class="text-2xl font-bold mt-4">Sobre este evento</h2>
                        {!! $event->description !!}
                    </div>

                </div>
            </div>
        </x-slot>
    @endif
</x-jet-dialog-modal>
