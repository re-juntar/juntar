<div>
    <a href="#modal" wire:click="$set('open', true)">
        @php
            $src = $event['image_flyer'];
            if ($event['image_flyer'] == null) {
                $src = 'images/public/event-card-placeholder.png';
            }
        @endphp
        <img class="rounded-lg" src="{{ asset($src) }}" alt="">
    </a>

    <x-jet-dialog-modal wire:model="open" class="bg-gray-50">
        <x-slot name="content">
            <x-button
                class="bg-transparent text-black font-extrabold absolute top-4 right-2 hover:overscroll-auto hover:text-white-ghost"
                wire:click="$set('open', false)">X</x-button>
            <div class="grid grid-cols-2 bg-white-ghost">

                <div class="rounded-lg p-4">
                    <img class="rounded-lg" src="{{ asset($src) }}" alt="">
                </div>

                <div class="container p-4 overscroll-auto overflow-y-auto max-h-screen">

                    <div class="flex flex-row">
                        <x-button class="bg-cyan-500 mr-4">Inscribirse</x-button>
                        <x-button class="bg-awesome">Flyer</x-button>
                    </div>

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

                            <h2 class="text-2xl font-bold mt-4">Sobre este evento</h2>
                            <p class="mt-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque doloribus,
                                ipsa aut, dolorem cupiditate,
                                ipsum vero est corporis laboriosam odio amet repellendus praesentium illum optio
                                exercitationem dolor hic fugit animi!
                            </p>

                        </div>

                    </div>

                    <div class="container">
                        @if($presentationsAndExhibitors)
                        <h2 class="text-2xl font-bold mt-4">Agenda</h2>
                        @for ($i=0; $i < count($presentationsAndExhibitors); $i++)
                        @php
                            $presentation = $presentationsAndExhibitors[$i]['presentation'];
                        @endphp
                        <table class="min-w-full text-center border mt-2">
                            <thead class="bg-fogra-darkish text-white-ghost">
                                <tr>
                                    <th scope="col" colspan="2" class="text-xl py-3">
                                        {{ $presentationsAndExhibitors[$i]['presentation']->title }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b bg-gray-200">
                                    <td class="text-lg font-medium text-gray-900 px-6 py-2">
                                        Fecha
                                    </td>
                                    <td>
                                        {{ substr($presentation->date, 0, 10) }}
                                    </td>
                                </tr>
                                <tr class="border-b">
                                    <td class="text-lg font-medium text-gray-900 px-6 py-2">
                                        Hora
                                    </td>
                                    <td>
                                        {{ substr($presentation->start_time, 0, 5) . " - " . substr($presentation->end_time, 0, 5)}}
                                    </td>
                                </tr>
                                <tr class="border-b bg-gray-200">
                                    <td class="text-lg font-medium text-gray-900 px-6 py-2">
                                        Recursos
                                    </td>
                                    <td>
                                        icon
                                    </td>
                                </tr>
                                <tr class="border-b">
                                    <td class="text-lg font-medium text-gray-900 px-6 py-2">
                                        Expositores
                                    </td>
                                    <td>
                                        <ul class="list-disc">
                                            @foreach ($presentationsAndExhibitors[$i]['exhibitors'] as $exhibitor)
                                                <li class="text-left">{{ $exhibitor['0']->name }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </x-slot>
    </x-jet-dialog-modal>
</div>
