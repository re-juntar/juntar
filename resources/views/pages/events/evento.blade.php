<link rel="stylesheet" href="{{asset('vendor/ckeditor/contents.css')}}">

@php
  $flyerSrc = $event->image_flyer;
  if ($event->image_flyer == null) {
      $flyerSrcNull = 'Flyer en construcción';
  }
  $logoSrc = $event->image_logo;
  if ($event->image_logo == null) {
      $logoSrcNull = 'Logo en construcción';
  }
@endphp

<x-app-layout>
  <x-hero>
    <h5 class="text-white-ghost uppercase font-medium text-[1.5rem] md:text-[2.5rem] mb-4 text-center leading-[1.2]">{{$event->name}}
    </h5>
    <h5 class="text-white-ghost uppercase font-medium text-[16px] md:text-[24px] mb-[0.5rem]"><i class="fa-regular fa-calendar mr-3"></i>{{$event->start_date}}</h5>
    <h5 class="text-white-ghost uppercase font-medium text-[16px] md:text-[24px] mb-[0.5rem]"><i class="fa-solid fa-location-dot mr-3"></i>{{$event->modality_description}}</h5>
    <h5 class="text-white-ghost uppercase font-medium text-[20px] mb-[0.5rem]">
    @if($event->endorsed)    
      <x-verified-badge></x-verified-badge>
    @endif
        
  </x-hero>
  <div class="event bg-[#0B0D19] break-words	">
    <div class="event-container max-w-md md:max-w-3xl lg:max-w-4xl xl:max-w-7xl mx-auto rounded-[0.25rem] py-[7vh] px-[3vh]">
      <div class="event-body bg-[#fff]">
        
        <x-pink-header class="text-[#856404]  bg-[#fff3cd] uppercase h-auto">
          @if($event->end_date<=date("Y-m-d"))
            El evento se encuentra finalizado
          @elseif($event->start_date<=date("Y-m-d")&&$event->end_date>=date("Y-m-d"))
            El evento ya ha iniciado
          @else
            El evento aun no ha comenzado
          @endif
        </x-pink-header>
        @if($hasPermission)
          <x-pink-header class="h-[50px]" style="justify-content: start">
            <x-button class="h-full hover:bg-fogra-darkish"><i class="fa-solid fa-pen"></i> Editar</x-button>
            <x-button class="h-full hover:bg-fogra-darkish"><i class="fa-solid fa-eye"></i> Ver Inscriptos</x-button>
          </x-pink-header>
        @endif
        <div class="event-body-hero flex flex-col md:flex md:flex-row p-[15px] ">
          <div class="general-info flex flex-col justify-around items-start w-full md:w-8/12 md:flex">
            <p class="text-[16px] mb-[0.5rem] flex items-center justify-center"><i class="fa-regular fa-calendar mr-3"></i>{{$event->start_date}}</p>
            <h2 class="text-[2rem] mb-[0.5rem] font-bold">{{$event->name}}</h2>
              <h3 class="text-[1rem]">Evento organizado por {{$organizer->user_name}} {{$organizer->user_surname}}</h3>
            @if($coorganizers)
            <h3 class="text-[1rem] mb-[0.5rem]">Coorganizado por:
              @foreach($coorganizers as $coorganizer)
                <span>{{$coorganizer->name}} {{$coorganizer->surname}}.</span>
              @endforeach
            </h3>
            @endif
            @if($event['image_flyer'])
              <a class="text-[1rem]" href="{{asset($flyerSrc)}}" download>
                <x-button class="text-[1rem]">
                  <i class="fas fa-file-download mr-3"></i>Flyer
                </x-button>
              </a>
            @else
                <x-button class="bg-fogra-darkish text-[16px]">
                  <i class="fa-solid fa-ban mr-3"></i>Flyer no Disponible
                </x-button>
            @endif
          </div>
          <div class="event-flyer-and-logo py-[1rem] flex flex-col items-center justify-center md:flex w-full md:w-4/12">
            <div class="event-flyer">
              @if($event['image_flyer'])
                <img class="rounded-lg w-full max-w-[80%] mx-auto" src="{{asset($flyerSrc)}}" alt="Flyer {{$event->name}}">
              @else
                {{$flyerSrc}}
              @endif
            </div> 
            <div class="event-logo pt-[0.5rem]">
              @if($event['image_logo'])
                <img class="rounded-lg max-w-[50%] mx-auto" src="{{ asset($logoSrc) }}" alt="Logo {{$event->name}}">
              @else
                {{$logoSrcNull}}
              @endif
            </div>
          </div>
        </div>
        <div class="event-body-inscription flex flex-col md:flex md:flex-row py-[3vh] bg-[#F2F2F2]">
          <div class="quota flex items-center w-full md:w-8/12 px-[15px]">
            @if($event->capacity > 0)
              <p class="text-[1rem]">CUPOS DISPONIBLES: {{$event->capacity}} 
            @else
              <p class="text-[1rem]">CUPOS ILIMITADOS</p>
            @endif
            @if($event->pre_registration)
              <span class="text-[#ff0000] font-bold"> *Requiere preinscipción* </span></p>
            @endif
          </div>
          <div class="status w-full md:w-4/12 px-[15px]">
            @if(($event->pre_registration && $event->inscription_end_date>=date("Y-m-d")))
              <x-button class="bg-cyan-500 mr-2 text-[16px]">Inscribirse</x-button>
              <p>Fecha limite: {{$event->inscription_end_date}}</p>
            @elseif($event->start_date>=date("Y-m-d"))
              <x-button class="bg-cyan-500 mr-2 text-[16px]">Inscribirse</x-button>
            @elseif($event->start_date<=date("Y-m-d") && $event->end_date>date("Y-m-d"))
              <p>El evento ya ha iniciado</p>
            @elseif($event->end_date<=date("Y-m-d"))
              <p>El evento se encuentra finalizado</p>
            @endif
          </div>
        </div>
        <div class="event-body-main flex-col flex-wrap md:flex md:flex-row pb-[3rem] p-[15px]">
          <div class="event-info flex flex-col justify-between items-start w-full md:w-8/12 xl:w-9/12 pr-3 pb-3">
            <h2 class="text-[1.4rem] font-bold mb-[0.5rem]">Sobre este evento</h2>
            @if($event->description)
                <div class="w-full text-[1rem]">
                  {!!$event->description!!}
                </div>
                <br>
                <div class="organizer-contact">
                  <h3 class="text-[1.2rem]">Contacto del Organizador</h3>
                  <h4 class="text-[1rem]">{{$organizer->user_email}}</h4>
                </div>
            @else
              <p>No hay descripcion del evento.</p>
            @endif
          </div>
          <div class="more-event-info w-full md:w-4/12 xl:w-3/12  text-white-ghost px-[15px] bg-[#0B0D19]">
            <ul class=" flex flex-col justify-center items-start w-10/12 mx-auto text-[1rem]">
              <li class="py-[0.75rem] ">
                <p class="mb-[1rem] font-bold">Fecha de Inicio:</p>
                <span>{{$event->start_date}}</span>
              </li>
              <li class="py-[0.75rem] ">
                <p class="mb-[1rem] font-bold">Fecha de Finalización:</p>
                <span>{{$event->end_date}}</span>
              </li>
              @if($event->pre_registration)
                <li class="py-[0.75rem] ">
                  <p class="mb-[1rem] font-bold">Fecha Límite de Inscripción:</p>
                  <span>{{$event->inscription_end_date}}</span>
                </li>
              @endif
              <li class="py-[0.75rem] ">
                <p class="mb-[1rem] font-bold">Lugar:</p>
                <span>{{$event->venue}}</span>
              </li>
              <li class="py-[0.75rem] ">
                <p class="mb-[1rem] font-bold">Modalidad: </p>
                <span>{{$event->modality_description}}</span>
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
        @if(count($presentations))
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-[15px] ">
          <div class="agenda flex items-center mb-[0.5rem]">
            <h2 class="uppercase text-[1.4rem]">Agenda</h2>
            @if($hasPermission)
            <x-button class="ml-[2rem]">Agregar Presentacion</x-button>
            @endif
          </div>
          <table class="w-full text-sm text-left text-fogra-darkish d text-[1rem]">
              <thead class="text-center text-xs bg-fogra-darkish text-white-ghost uppercase rounded-[1.25rem]">
                  <tr>
                      <th scope="col" class="text-left px-6 py-3">#</th>
                      <th scope="col" class="text-left px-6 py-3">Titulo</th>
                      <th scope="col" class="px-6 py-3">Descripcion</th>
                      <th scope="col" class="px-6 py-3">Dia</th>
                      <th scope="col" class="px-6 py-3">Inicio</th>
                      <th scope="col" class="px-6 py-3">Recursos</th>
                      <th scope="col" class="px-6 py-3">Expositores</th>
                  </tr>
              </thead>
              <tbody>
                @foreach($presentations as $presentation)
                  <tr class="text-center bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                      <th scope="row" class="text-left px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">{{$presentation->id}}</th>
                      <td class="text-left px-6 py-4">{{$presentation->title}}</td>
                      <td class="px-6 py-4">{{$presentation->description}}</td>
                      <td class="px-6 py-4">{{substr($presentation->date, 0, 10)}}</td>
                      <td class="px-6 py-4">{{substr($presentation->start_time, 0, 5)}}</td>
                      <td class="px-6 py-4"><a href="{{$presentation->resources_link}}"><i class="fa-solid fa-paperclip text-sky-600"></i></a></td>
                      <td class="px-6 py-4">{{$presentation->exhibitors}}</td>
                    </tr>
                  @endforeach
              </tbody>
          </table>
        </div>
        @endif
      </div>
    </div>
  </div>
</x-app-layout>