<?php
if (isset($event)) {
    $today = strtotime(date('d-m-Y'));

    $start_date = new DateTime($event->start_date);
    $start_date = strtotime($start_date->format('d-m-Y'));

    $end_date = new DateTime($event->end_date);
    $end_date = strtotime($end_date->format('d-m-Y'));

    $inscription_end_date = new DateTime($event->inscription_end_date);
    $inscription_end_date = strtotime($inscription_end_date->format('d-m-Y'));

    $arrIsEnrolled = $this->is_enrolled($event->id);
}
?>
<x-jet-dialog-modal wire:model="open">
    @if (!isset($event))
        <x-slot name="content">
            <h1 class="text-awesome">No event loaded</h1>
        </x-slot>
    @else
        <x-slot name="content">

            <x-button
                class="bg-transparent text-black font-extrabold absolute top-3 right-3 z-10 hover:overscroll-auto hover:text-white-ghost"
                wire:click="$set('open', false)">X</x-button>

            <div class="bg-white-ghost md:min-h-[60vh] md:relative">

                <div class="flex justify-center rounded-lg p-4 mt-7 h-full md:w-2/4">
                    @php
                        $src = $event['image_flyer'];
                        if ($event['image_flyer'] == null) {
                            $src = 'images/public/event-card-placeholder.png';
                        }
                    @endphp
                    <img class="shadow-lg rounded-lg" src="{{ asset($src) }}" alt="">
                </div>

                <div class="p-4 overscroll-contain md:absolute  md:w-2/4 md:overflow-y-scroll md:ml-[50%] md:inset-y-0 md:left-0">
                    <a href={{ route('evento', $event->id) }} id={{ $event->id }}>
                        <x-button class="text-[1rem] my-1 bg-slate-600">
                            <i class="fa-solid fa-eye mr-1"></i> Ver Más
                        </x-button>
                    </a>
                    @if ($today <= $inscription_end_date && $event->capacity != 0 && $event->event_status_id == 1)
                        @if ($event->pre_registration)
                            @if (count($arrIsEnrolled) == 1)
                                <a href="{{ route('unsubscribe', $event->id) }}">
                                    <x-button class="text-[16px] ">Desinscribirse</x-button>
                                </a>
                            @else
                                <x-button wire:click='confirmPreRegistration({{ $event }})'
                                    class="bg-cyan-500 my-1 ">Pre Inscribirse</x-button>
                            @endif
                        @else
                            @if (count($arrIsEnrolled) == 1)
                                <x-button wire:click='confirmUnsuscribe({{ $event }})' class="text-[16px] ">Desinscribirse</x-button>
                            @else
                                <x-button wire:click='confirm({{ $event }})'
                                    class="bg-cyan-500 my-1  text-[16px]">
                                    Inscribirse</x-button>
                            @endif
                        @endif
                    @endif

                    @if ($event['image_flyer'])
                        <a class=" text-[1rem] mr-1" href="{{ asset($event['image_flyer']) }}" download>
                            <x-button class="text-[1rem] mt-1">
                                <i class="fas fa-file-download mr-3"></i>Flyer
                            </x-button>
                        </a>
                    @else
                        <x-button class="bg-fogra-darkish text-[16px] mt-1">
                            <i class="fa-solid fa-ban mr-3"></i>Flyer no Disponible
                        </x-button>
                    @endif

                    <div class="container mt-4">
                        <h1 class="text-3xl font-bold mb-3">{{ $event->name }}</h1>

                        <div class="container mt-2">

                            <h2 class="text-lg font-semibold">Organiza:
                                <span class="font-normal">{{ $event->user->name }} {{ $event->user->surname }}</span>
                            </h2>

                            @if (count($event->coorganizers) > 0)
                                <div class="flex flex-row mt-1">
                                    <h2 class="text-lg font-semibold">Co-organiza: </h2>
                                    <ul class="text-lg ml-1">
                                        @foreach ($event->coorganizers as $coorganizer)
                                            <li>{{ $coorganizer->user->name }} {{ $coorganizer->user->surname }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <h3 class="font-bold mt-2">Fecha de inicio: {{ $event->start_date }}</h3>

                            <h3 class="font-bold mt-1">Fecha de finalización: {{ $event->end_date }}</h3>

                            @if (!is_null($event->pre_registration))
                                @if ($event->pre_registration)
                                    <h3 class="font-bold mt-1">Fecha límite de preinscripción:
                                        {{ $event->inscription_end_date }}</h3>
                                @endif
                            @endif

                            <h3 class="font-bold mt-4">Modalidad: {{ $event->eventModality->description }}</h3>

                            @php
                                $endorsementRequest = $event->endorsementRequest;
                            @endphp

                            @if (!is_null($endorsementRequest))
                                @if ($endorsementRequest->endorsed)
                                    <div class="mt-4">
                                        @livewire('verified-badge', ['endorsementRequest' => $endorsementRequest, 'academicUnits' => $academicUnits])
                                    </div>
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
