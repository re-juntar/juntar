@php
  $flyerSrc = $event['image_flyer'];
  if ($event['image_flyer'] == null) {
      $flyerSrc = 'Flyer en construcción';
  }
  $logoSrc = $event['image_logo'];
  if ($event['image_logo'] == null) {
      $logoSrcNull = 'Logo en construcción';
  }
@endphp

<x-app-layout>
  <x-hero>
    <h5 class="text-white-ghost uppercase font-medium text-[2.5rem] mb-4 text-center leading-[1.2]">{{$event->name}}
    </h5>
    <h5 class="text-white-ghost uppercase font-medium text-[24px] mb-[0.5rem]"><i class="fa-regular fa-calendar mr-3"></i>{{$event->start_date}}</h5>
    <h5 class="text-white-ghost uppercase font-medium text-[24px] mb-[0.5rem]"><i class="fa-solid fa-location-dot mr-3"></i>{{$event->modality}}</h5>
    <h5 class="text-white-ghost uppercase font-medium text-[20px] mb-[0.5rem]">
    @if($event->endorsed)    
      <h5 class="text-white-ghost uppercase font-medium text-[20px] mb-[0.5rem]">
        Evento avalado por la FAI 
      </h5>
    @endif
        
  </x-hero>
  <div class="event bg-[#0B0D19] break-words	">
    <div class="event-container max-w-md md:max-w-3xl lg:max-w-4xl xl:max-w-7xl mx-auto rounded-[0.25rem] py-[7vh] px-[3vh]">
      <div class="event-body bg-[#fff]">
        {{-- Header --}}
        <x-pink-header class="h-[50px] text-[#856404]  bg-[#fff3cd] uppercase">
          @if($event->end_date<=date("Y-m-d"))
            El evento se encuentra finalizado
          @elseif($event->start_date<=date("Y-m-d")&&$event->end_date>=date("Y-m-d"))
            El evento ya ha iniciado
          @else
            El evento aun no ha comenzado
          @endif
        </x-pink-header>
        <x-pink-header class="h-[50px] border-0 rounded-none"></x-pink-header>
        {{-- Hero --}}
        <div class="event-body-hero flex p-[15px] ">
          <div class="general-info flex flex-col justify-around items-start w-full md:w-8/12">
            <p class="text-[16px] mb-[0.5rem] flex items-center justify-center"><i class="fa-regular fa-calendar mr-3"></i>{{$event->start_date}}</p>
            <h2 class="text-[2rem] mb-[0.5rem] font-bold">{{$event->name}}</h2>
            @if($event->user_id == null)
              <p class="text-[20px] mb-[0.5rem]">Sin organizador</p>
            @else
              <p>Evento organizado por User con ID {{$event->user_id}}</p>
            @endif
            @if($event['image_flyer'])
              <a href="{{asset($flyerSrc)}}" download>
                <x-button class="text-[16px]">
                  <i class="fas fa-file-download mr-3"></i>Flyer
                </x-button>
              </a>
            @else
                <x-button class="bg-fogra-darkish text-[16px]">
                  <i class="fa-solid fa-ban mr-3"></i>Flyer no Disponible
                </x-button>
            @endif
          </div>
          <div class="flex flex-col w-full md:w-4/12">
            {{-- <div class="event-flyer">
              @if($event['image_flyer'])
                <img class="rounded-lg" src="{{asset($flyerSrc)}}" alt="Flyer {{$event->name}}">
              @else
                {{$flyerSrc}}
              @endif
            </div> --}}
            <div class="event-logo w-1/2">
              @if($event['image_logo'])
                <img class="rounded-lg" src="{{ asset($logoSrc) }}" alt="Logo {{$event->name}}">
              @else
                {{$logoSrcNull}}
              @endif
            </div>
          </div>
        </div>
        {{-- Preinscripcion/Inscripcion --}}
        <div class="event-body-inscription flex py-[3vh] bg-[#F2F2F2]">
          <div class="quota flex items-center w-full md:w-8/12 px-[15px]">
            @if($event->capacity > 0)
              <p>CUPOS DISPONIBLES: {{$event->capacity}} 
            @else
              <p>CUPOS ILIMITADOS</p>
            @endif
            @if($event->pre_registration)
              <span class="text-[#ff0000] font-bold"> *Requiere preinscipción* </span></p>
            @endif
          </div>
          <div class="status w-full md:w-4/12 px-[15px]">
            @if($event->start_date>=date("Y-m-d"))
              <x-button class="bg-cyan-500 mr-2">Inscribirse</x-button>
            @elseif($event->start_date<=date("Y-m-d") && $event->end_date>date("Y-m-d"))
              <p>El evento ya ha iniciado</p>
            @elseif($event->end_date<=date("Y-m-d"))
              <p>El evento se encuentra finalizado</p>
            @endif
          </div>
        </div>
        {{-- Main Content --}}
        <div class="event-body-main flex py-[3rem]">
          <div class="event-info flex flex-col justify-start overflow-auto items-start w-full md:w-8/12 px-[15px]">
            @if($event->description)
              {!!$event->description!!}
            @else
              <p>No hay descripcion del evento.</p>
            @endif
          </div>
          <div class="more-event-info w-full md:w-4/12 px-[15px] mx-[15px] text-white-ghost bg-[#0B0D19]">
            <ul class=" flex flex-col justify-center items-start">
              <li class="py-[0.75rem] ">
                <p class="mb-[1rem] font-bold">Fecha de Inicio:</p>
                <span>{{$event->start_date}}</span>
              </li>
              <li class="py-[0.75rem] ">
                <p class="mb-[1rem] font-bold">Fecha de Finalización:</p>
                <span>{{$event->end_date}}</span>
              </li>
              <li class="py-[0.75rem] ">
                <p class="mb-[1rem] font-bold">Fecha Límite de Inscripción:</p>
                <span>{{$event->inscription_end_date}}</span>
              </li>
              <li class="py-[0.75rem] ">
                <p class="mb-[1rem] font-bold">Lugar:</p>
                <span>{{$event->venue}}</span>
              </li>
              <li class="py-[0.75rem] ">
                <p class="mb-[1rem] font-bold">Modalidad: </p>
                <span>{{$event->event_modality_id}}</span>
              </li>
              <li class="py-[0.75rem] ">
                <p class="mb-[1rem] font-bold">Capacidad: </p>
                <span>{{$event->capacity}}</span>
              </li>
              <li class="py-[0.75rem] ">
                <p class="mb-[1rem] font-bold">Fecha Publicación: </p>
                <span>{{$event->created_at}}</span>
              </li>
            </ul>
          </div>
        </div>
        {{-- Agenda --}}
        <div class="event-body schedule px-[15px]">
          <h4 class="uppercase text-[24px]">Agenda</h4>
          <div class="tabla">
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>