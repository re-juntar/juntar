<x-app-layout>
    <x-hero>
        <img class="max-w-full h-auto mb-4" src="{{ asset('images/logos/juntar-logo-w.svg') }}" alt="" />
        <h5 class="text-white-ghost uppercase font-medium text-xl mb-4">Sistema de gestión de eventos</h5>
        <x-jet-button class="bg-awesome uppercase text-lg text-white-ghost hover:bg-fogra-dark">Empezar</x-jet-button>
    </x-hero>

    <section class="bg-fogra-darkish w-full">
        @livewire('search-sort-form')
    </section>


    <section class="bg-fogra-darkish w-full text-white-ghost">

        <div class="container mx-auto">
            <table class="table-auto table-fixed hover:table-fixed">
                <thead class="border-b bg-white">
                    <tr>
                        <th>
                            <h5 class="text-violet-600 uppercase font-medium text-xl mb-4">Organizar eventos</h5>
                        </th>
                    </tr>
                </thead>

                <thead class="border-b bg-gray-800">
                            
                               
                    <th >
                    Nombre del evento </th>

                    <th scope="col" class="text-sm font-medium px-6 py-4">
                        estado </th>

                    <th scope="col" class="text-sm font-medium px-6 py-4">
                        Fecha de cracion</th>

                    <th scope="col" class="text-sm font-medium px-6 py-4">
                        Acciones</th>
                    </tr>
                </thead class="border-b">

                <tbody>
                    @foreach ($eventos as $evento)

                    <tr class="bg-white border-b">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium ">
                            <div class="flex items-center">
                                {{ $evento->name }}
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium ">
                            <div class="flex items-center">

                                @if($evento->event_status_id == 1) Activo
                                @elseif ($evento->event_status_id == 2) Inhabilitado
                                @elseif ($evento->event_status_id == 3) Finalizado
                                @elseif ($evento->event_status_id == 4) Borrador
                                @endif
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium ">
                            <div class="flex items-center">
                                {{ $evento->start_date }}
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium ">
                            <button
                                class="bg-transparent hover:bg-blue  font-semibold hover:text-white py-2 px-4 border border-blue hover:border-transparent rounded">
                                Editar </button>
                            <button
                                class="bg-transparent hover:bg-blue  font-semibold hover:text-white py-2 px-4 border border-blue hover:border-transparent rounded">
                                Borrar </button>
                            <button
                                class="bg-transparent hover:bg-blue  font-semibold hover:text-white py-2 px-4 border border-blue hover:border-transparent rounded">
                                Publicar </button>
                            <button
                                class="bg-transparent hover:bg-blue  font-semibold hover:text-white py-2 px-4 border border-blue hover:border-transparent rounded">
                                Finalizar </button>
                            <button
                                class="bg-transparent hover:bg-blue  font-semibold hover:text-white py-2 px-4 border border-blue hover:border-transparent rounded">
                                Ver </button>
                        </td>
                    </tr class="bg-white border-b">
                    @endforeach
                </tbody>
            </table>
        </div>

    </section>


</x-app-layout>