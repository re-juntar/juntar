<div>
    <a href="#{{$event->id}}" wire:click="$set('open', true)">
        @php
            $src = $event['image_flyer'];
            if ($event['image_flyer'] == null) {
                $src = 'images/public/event-card-placeholder.png';
            }
        @endphp
        <img class="rounded-lg" src="{{ asset($src) }}" alt="">
        <x-verified-badge class="absolute top-4 right-4 z-10" />
    </a>

    <x-jet-dialog-modal wire:model="open" class="bg-gray-50">
        <x-slot name="content">

            <x-button
                class="bg-transparent text-black font-extrabold absolute top-4 right-4 z-10 hover:overscroll-auto hover:text-white-ghost"
                wire:click="$set('open', false)">X</x-button>

            <div class="bg-white-ghost md:min-h-[60vh] md:relative">

                <div class="flex justify-center rounded-lg p-4 h-full md:w-2/4">
                    <img class="shadow-lg rounded-lg" src="{{ asset($src) }}" alt="">
                </div>

                <div class="p-4 overscroll-contain md:absolute md:w-2/4 md:overflow-y-scroll md:ml-[50%] md:inset-y-0 md:left-0">

                        <x-button class="bg-cyan-500 mr-2">Inscribirse</x-button>
                        <x-button class="mr-2">Flyer</x-button>
                        <x-button class="bg-fogra-darkish text-white-ghost">Compartir</x-button>

                    <div class="container mt-4">
                        <h1 class="text-2xl font-bold">{{ $event->name }}</h1>

                        <div class="container mt-2">

                            <h2 class="text-lg font-semibold">Organiza:
                                <span class="font-normal">Organizador</span>
                            </h2>

                            <div class="flex flex-row mt-1">
                                <h2 class="text-lg font-semibold">Co-organiza: </h2>
                                <ul class="text-lg ml-1">
                                    <li>Coorganizador 1</li>
                                    <li>Coorganizador 2</li>
                                </ul>
                            </div>

                            <h3 class="font-bold mt-2">Fecha de inicio: </h3>

                            <h3 class="font-bold mt-1">Fecha de finalización: </h3>

                            <h3 class="font-bold mt-1">Fecha límite de inscripción: </h3>

                            <h3 class="font-bold mt-4">Modalidad: </h3>

                            <x-verified-badge class="mt-4" />

                            <h2 class="text-2xl font-bold mt-4">Sobre este evento</h2>
                            <p class="mt-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque doloribus,
                                ipsa aut, dolorem cupiditate,
                                ipsum vero est corporis laboriosam odio amet repellendus praesentium illum optio
                                exercitationem dolor hic fugit animi!
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque doloribus,
                                ipsa aut, dolorem cupiditate,
                                ipsum vero est corporis laboriosam odio amet repellendus praesentium illum optio
                                exercitationem dolor hic fugit animi!
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque doloribus,
                                ipsa aut, dolorem cupiditate,
                                ipsum vero est corporis laboriosam odio amet repellendus praesentium illum optio
                                exercitationem dolor hic fugit animi!
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque doloribus,
                                ipsa aut, dolorem cupiditate,
                                ipsum vero est corporis laboriosam odio amet repellendus praesentium illum optio
                                exercitationem dolor hic fugit animi!
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque doloribus,
                                ipsa aut, dolorem cupiditate,
                                ipsum vero est corporis laboriosam odio amet repellendus praesentium illum optio
                                exercitationem dolor hic fugit animi!
                            </p>

                        </div>

                    </div>

                    <div class="container">
                        <h2 class="text-2xl font-bold mt-4">Agenda {{-- <x-button wire:click="addPresentation">+</x-button> --}}</h2>
                        @foreach($presentations as $presentation)
                        <table class="min-w-full text-center border mt-2">
                            <thead class="bg-fogra-darkish text-white-ghost">
                                <tr>
                                    <th scope="col" colspan="2" class="text-xl py-3">
                                            {{-- <livewire:edit-field :model="'\App\Models\Presentation'" :entity="$presentation" :field="'title'" :key="'title'.$presentation->id"/> --}}
                                                {{$presentation->title}}
                                            {{-- 
                                            <div class="col-span-1">
                                                <x-button wire:click="deletePresentation({{$presentation}})" class="">Del</x-button>
                                            </div> --}}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                @if($presentation->date)
                                <tr class="border-b bg-gray-200">
                                    <td class="text-lg font-medium text-gray-900 px-6 py-2">
                                        Fecha
                                    </td>
                                    <td>
                                        {{-- <livewire:edit-field :model="'\App\Models\Presentation'" :entity="$presentation" :field="'date'" :key="'date'.$presentation->id"/> --}}
                                        {{$presentation->date}}
                                    </td>
                                </tr>
                                @endif

                                @if($presentation->start_time)
                                <tr class="border-b">
                                    <td class="text-lg font-medium text-gray-900 px-6 py-2">
                                        Hora
                                    </td>
                                    <td>
                                        {{-- {{ substr($presentation->start_time, 0, 5) . " a " . substr($presentation->end_time, 0, 5)}} --}}
                                        Desde {{$presentation->start_time}}
                                        {{-- <livewire:edit-field :model="'\App\Models\Presentation'" :entity="$presentation" :field="'start_time'" :key="'start'.$presentation->id"/> --}}
                                        @if($presentation->end_time)
                                        Hasta {{$presentation->end_time}}
                                        {{-- <livewire:edit-field :model="'\App\Models\Presentation'" :entity="$presentation" :field="'end_time'" :key="'end'.$presentation->id"/> --}}
                                        @endif
                                    </td>
                                </tr>
                                @endif

                                @if($presentation->resources_link)
                                <tr class="border-b bg-gray-200">
                                    <td class="text-lg font-medium text-gray-900 px-6 py-2">
                                        Recursos
                                    </td>
                                    <td>
                                        {{-- <livewire:edit-field :model="'\App\Models\Presentation'" :entity="$presentation" :field="'resources_link'" :key="'resources'.$presentation->id"/> --}}
                                        <a href="{{$presentation->resources_link}}">Link (icon)</a>
                                    </td>
                                </tr>
                                @endif

                                @if($presentation->exhibitors)
                                <tr class="border-b">
                                    @php
                                        $exhibitors = explode('-', $presentation->exhibitors);
                                        $rowspan = count($exhibitors)
                                    @endphp
                                    <td class="text-lg font-medium text-gray-900 px-6 py-2" rowspan="{{$rowspan/2}}">
                                        Presentadores
                                    </td>
                                    <td>
                                        {{-- <livewire:edit-field :model="'\App\Models\Presentation'" :entity="$presentation" :field="'exhibitors'" :key="'exhibitors'.$presentation->id"/> --}}
                                        <ul>
                                            @foreach($exhibitors as $exh)
                                            <li>{{$exh}}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                                @endif

                            </tbody>
                        </table>
                        @endforeach
                    </div>
                </div>
            </div>
        </x-slot>
    </x-jet-dialog-modal>
</div>
