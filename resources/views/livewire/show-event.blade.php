@php
    $flyerSrc = $event->image_flyer;
    if ($event->image_flyer == null) {
    $flyerSrcNull = 'Flyer en construcción';
    }
    $logoSrc = $event->image_logo;
    if ($event->image_logo == null) {
    $logoSrcNull = 'Logo en construcción';
    }
    $today = strtotime(date('d-m-Y'));

    $start_date = new DateTime($event->start_date);
    $start_date = strtotime($start_date->format('d-m-Y'));

    $end_date = new DateTime($event->end_date);
    $end_date = strtotime($end_date->format('d-m-Y'));

    $inscription_end_date = new DateTime($event->inscription_end_date);
    $inscription_end_date = strtotime($inscription_end_date->format('d-m-Y'));
@endphp
<div>

    {{-- Flyer Modal --}}
    <x-jet-dialog-modal wire:model="openFlyerModal">
        <x-slot name="content">
            <x-button
                    class="bg-transparent text-black font-extrabold absolute top-4 right-4 z-10 hover:overscroll-auto hover:text-white-ghost"
                    wire:click="$set('openFlyerModal', false)">X</x-button>

            <div class="bg-white-ghost p-10">
                <div class="mt-5">
                    @if ($flyerSrc)
                        <img class="rounded-lg w-full mx-auto" src="{{ asset($flyerSrc) }}" alt="Flyer del evento">
                    @endif
                </div>

                <div class="flex justify-end">
                    @if ($flyerSrc)
                        <a class="my-5 text-[1rem]" href="{{ asset($flyerSrc) }}" download>
                            <x-button class="text-[1rem]">
                                <i class="fas fa-file-download mr-3"></i>Bajar
                            </x-button>
                        </a>
                    @endif
                    <x-button wire:click="$set('openFlyerModal', false)" class="ml-2 my-5 text-[1rem]">
                        Cerrar
                    </x-button>
                </div>
            </div>
        </x-slot>
    </x-jet-dialog-modal>


    {{-- Body content --}}
    <x-hero>
        <h5 class="text-white-ghost uppercase font-medium text-[1.5rem] md:text-[2.5rem] mb-4 text-center leading-[1.2]">
            {{ $event->name }}
        </h5>
        <h5 class="text-white-ghost uppercase font-medium text-[16px] md:text-[24px] mb-[0.5rem]"><i class="fa-regular fa-calendar mr-3"></i>{{ $event->start_date }}</h5>
        <h5 class="text-white-ghost uppercase font-medium text-[16px] md:text-[24px] mb-[0.5rem]"><i class="fa-solid fa-location-dot mr-3"></i>{{ $event->modality_description }}</h5>
        <h5 class="text-white-ghost uppercase font-medium text-[20px] mb-[0.5rem]">
        @if ($endorsementRequest && $endorsementRequest->endorsed)
            @livewire('verified-badge', ['endorsementRequest' => $endorsementRequest, 'academicUnits' => $academicUnits])
        @endif
    </x-hero>

    <div class="event bg-[#0B0D19] break-words">
        <div class="event-container max-w-md md:max-w-3xl lg:max-w-4xl xl:max-w-7xl mx-auto rounded-[0.25rem] py-[7vh] px-[3vh]">
            <div class="event-body bg-[#fff]">

                <x-pink-header class="text-[#856404]  bg-[#fff3cd] uppercase h-auto">
                    @if($start_date > $today)
                        EL EVENTO NO HA COMENZADO
                    @elseif($start_date <= $today && $today <= $end_date)
                        EL EVENTO YA HA COMENZADO
                    @else
                        EL EVENTO YA HA TERMINADO
                    @endif
                </x-pink-header>

                {{-- Edit Event Nav --}}
                @if ($hasPermission)
                    <x-pink-header header class="h-[50px]" style="justify-content: start">
                        <a href="{{route('edit-event', $event->id)}}">
                            <x-button class="h-full hover:bg-fogra-darkish">
                                <i class="fa-solid fa-pen"></i> Editar
                            </x-button>
                        </a>

                        <a href="{{route('inscriptions', $event->id)}}">
                            <x-button class="h-full hover:bg-fogra-darkish">
                                <i class="fa-solid fa-eye"></i> Ver Inscriptos
                            </x-button>
                        </a>

                        @if($event->pre_registration)
                            <a href="{{ route('formbuilder', $event->id) }}">
                                <x-button class="h-full hover:bg-fogra-darkish">
                                    <i class="fa-solid fa-clipboard"></i>
                                    @if(count($event->questions) == 0)
                                        Crear formulario de preinscipción
                                    @else
                                        Editar formulario de preinscripción
                                    @endif
                                </x-button>
                            </a>
                        @endif

                        @if (!$endorsementRequest)
                            @livewire('endorsement-button')
                            @livewire('choose-endorsement', ['event' => $event])

                            {{-- <form method="POST" action="{{route('avales')}}" class="inline-block" enctype="multipart/form-data">
                                @csrf_token
                                <input type="hidden" for="eventId" name="eventId" id="eventId" value="{{$event->id}}">
                                <x-button class="h-full hover:bg-fogra-darkish" type=submit> Solicitar aval
                                </x-button>
                            </form> --}}

                        @elseif ($endorsementRequest->endorsed == 1)

                        @elseif ($endorsementRequest->endorsed === 0)
                            <h2 class="">La solicitud de aval fue rechazada</h2>
                        @elseif ($endorsementRequest->endorsed === null)
                            <h2 class="">La solicitud de aval ya fue enviada</h2>
                        @endif

                    </x-pink-header>
                @endif

                {{-- Organizer, Coorganizer, logo and flyer --}}
                <div class="event-body-hero flex flex-col md:flex md:flex-row p-[15px] ">
                    <div class="general-info flex flex-col items-start w-full md:w-8/12 md:flex">
                        <p class="my-5 text-[16px] mb-[0.5rem] flex items-center justify-center"><i class="fa-regular fa-calendar mr-3"></i>{{ $event->start_date }}</p>
                        <h2 class="my-5 text-[2rem] mb-[0.5rem] font-bold">{{ $event->name }}</h2>

                        <h3 class="mt-5 text-[1rem]">Evento organizado por <b>{{ $organizer->name }}
                                {{ $organizer->surname }}</b></h3>
                        @if($coorganizers && count($coorganizers) > 0)
                            <h3 class="text-[1rem] mb-[0.5rem]">Coorganizado por:
                                @foreach ($coorganizers as $coorganizer)
                                    <span><b>{{$coorganizer->name}} {{$coorganizer->surname}}</b>.</span>
                                @endforeach
                            </h3>
                        @endif
                        <div class="my-3">
                            @if ($event['image_flyer'] && $flyerSrc)
                                <x-button wire:click="$set('openFlyerModal', true)" class="text-[1rem]">
                                    <i class="fas fa-file-download mr-3"></i>Flyer
                                </x-button>
                            @else
                                <x-button class="bg-fogra-darkish text-[16px]">
                                    <i class="fa-solid fa-ban mr-3"></i>Flyer no Disponible
                                </x-button>
                            @endif
                        </div>
                    </div>
                    <div class="event-flyer-and-logo flex flex-col items-center justify-center md:flex w-full md:w-4/12">
                        <div class="event-logo">
                            @if ($event['image_logo'])
                                <img class="rounded-lg max-w-[80%] mx-auto" src="{{ asset($logoSrc) }}" alt="Logo {{ $event->name }}">
                            @else
                                {{ $logoSrcNull }}
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Details on event, dates and inscription limits --}}
                <div class="event-body-inscription px-[15px] flex justify-between md:flex md:flex-row py-[3vh] bg-[#F2F2F2]">
                    <div class="flex flex-col items-center justify-center md:flex">
                        @if ($event->capacity > 0)
                            <p class="text-[1rem]">CUPOS DISPONIBLES: {{ $event->capacity }}
                        @else
                            <p class="text-[1rem]">CUPOS ILIMITADOS</p>
                        @endif

                        @if ($event->pre_registration && $event->inscription_end_date)
                            <span class="text-[#ff0000] font-bold">&nbsp;*Requiere pre-inscripción* </span></p>
                        @endif
                    </div>

                    <div class="flex flex-col items-center justify-center md:flex w-full md:w-4/12">
                        @if($event->pre_registration)
                                <a href="{{route('preinscripcionform', $event->id)}}">
                                    <x-button class="bg-cyan-500 text-[16px]">Preinscribirse</x-button>
                                </a>
                                <p>Fecha limite: {{ $event->inscription_end_date }}</p>
                        @else
                            @if($today < $end_date)
                                <a href="{{route('inscribir', $event->id )}}">
                                    <x-button class="bg-cyan-50 text-[16px]">Inscribirse</x-button>
                                </a>
                            @endif
                        @endif
                    </div>
                </div>

                <div class="event-body-main flex-col flex-wrap md:flex md:flex-row pb-[3rem] p-[15px]">
                    <div class="event-info flex flex-col items-start w-full md:w-8/12 xl:w-9/12 pr-3 pb-3">
                        <h2 class="text-[1.4rem] font-bold mb-[0.5rem]">Sobre este evento</h2>
                        @if ($event->description)
                            <div class="w-full text-[1rem]">
                                {!! $event->description !!}
                            </div>
                            <br>
                            <div class="organizer-contact">
                                <h3 class="text-[1.2rem]">Contacto del Organizador</h3>
                                <h4 class="text-[1rem]">{{ $organizer->email }}</h4>
                            </div>
                        @else
                            <p>No hay descripcion del evento.</p>
                        @endif
                    </div>

                    {{-- More event info on the right side --}}
                    <div class="more-event-info flex flex-col items-center justify-center md:flex w-full md:w-4/12 xl:w-3/12  text-white-ghost px-[15px] bg-[#0B0D19]">
                        <ul class=" flex flex-col justify-center items-start w-10/12 mx-auto text-[1rem]">
                            <li class="py-[0.75rem]">
                                <p class="mb-[1rem] font-bold">Fecha de Inicio:</p>
                                <span>{{ $event->start_date }}</span>
                            </li>
                            <li class="py-[0.75rem]">
                                <p class="mb-[1rem] font-bold">Fecha de Finalización:</p>
                                <span>{{ $event->end_date }}</span>
                            </li>

                            @if ($event->pre_registration && $event->inscription_end_date)
                                <li class="py-[0.75rem]">
                                    <p class="mb-[1rem] font-bold">Fecha Límite de Preinscripción:</p>
                                    <span>{{ $event->inscription_end_date }}</span>
                                </li>
                            @endif

                            @if($event->venue)
                                <li class="py-[0.75rem]">
                                    <p class="mb-[1rem] font-bold">Lugar:</p>
                                    <span>{{ $event->venue }}</span>
                                </li>
                            @endif

                            @if($event->meeting_link)
                                <li class="py-[0.75rem]">
                                    <p class="mb-[1rem] font-bold">Enlace:</p>
                                    <span>{{ $event->meeting_link }}</span>
                                </li>
                            @endif

                            <li class="py-[0.75rem]">
                                <p class="mb-[1rem] font-bold">Modalidad: </p>
                                <span>{{ $event->modality_description }}</span>
                            </li>

                            @if($event->capacity != -1)
                                <li class="py-[0.75rem]">
                                    <p class="mb-[1rem] font-bold">Capacidad: </p>
                                    <span>{{ $event->capacity }}</span>
                                </li>
                            @endif

                            <li class="py-[0.75rem]">
                                <p class="mb-[1rem] font-bold">Fecha Publicación: </p>
                                <span>{{ $event->updated_at }}</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="pb-[3rem] p-[15px]">
                    <livewire:presentation-table event="{{ $event->id }}">
                </div>
            </div>
        </div>
    </div>

</div>
