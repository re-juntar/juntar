<x-app-layout>
    <x-hero>
        <img class="max-w-full h-auto mb-4" src="{{ asset('images/logos/juntar-logo-w.svg') }}" alt="" />
        <h5 class="text-white-ghost uppercase font-medium text-xl mb-4">Sistema de gestión de eventos</h5>
        <x-jet-button class="bg-awesome uppercase text-lg text-white-ghost hover:bg-fogra-dark">Empezar</x-jet-button>
    </x-hero>

    <section class="bg-fogra-darkish w-full text-white-ghost pt-16 pb-5 px-4">
        {{-- Table --}}
        <div class="flex flex-col max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-white-ghost uppercase mb-2 font-medium leading-6 text-3xl">Mis eventos creados</h2>
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden rounded-lg">
                        <table class="min-w-full text-center">
                            <thead class="border-b bg-gray-800">
                                <tr>
                                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">Nombre del
                                        evento </th>
                                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">Estado </th>
                                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">Fecha de cracion
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">Acciones</th>
                                </tr>
                            </thead class="border-b">
                            <tbody class="bg-white-ghost">
                                @foreach ($eventos as $evento)
                                    <tr class="bg-white border-b">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $evento->name }}
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            @switch($evento->event_status_id)
                                                @case(1)
                                                    Activo
                                                @break

                                                @case(2)
                                                    Inhabilitado
                                                @break

                                                @case(1)
                                                    Finalizado
                                                @break

                                                @case(1)
                                                    Borrador
                                                @break

                                                @default
                                                    -
                                            @endswitch
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            {{ $evento->start_date }}
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
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
                </div>
            </div>
        </div>

        {{-- Table Navigation --}}
        <div class="flex justify-center">
            <nav aria-label="Page navigation example">
                <ul class="flex list-style-none bg-white-ghost rounded">
                    <li class="page-item"><a
                            class="page-link relative block py-3 px-6 border-0 outline-none transition-all duration-300 rounded text-gray-800 focus:shadow-none"
                            href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a></li>
                    <li class="page-item"><a
                            class="page-link relative block py-3 px-6 border-0 outline-none transition-all duration-300 rounded text-gray-800 focus:shadow-none"
                            href="#">1</a></li>
                    <li class="page-item"><a
                            class="page-link relative block py-3 px-6 border-0 outline-none transition-all duration-300 rounded text-awesome hover:bg-gray-200 focus:shadow-none"
                            href="#">2</a></li>
                    <li class="page-item"><a
                            class="page-link relative block py-3 px-6 border-0 outline-none transition-all duration-300 rounded text-awesome hover:bg-gray-200 focus:shadow-none"
                            href="#">3</a></li>
                    <li class="page-item"><a
                            class="page-link relative block py-3 px-6 border-0 outline-none transition-all duration-300 rounded text-awesome hover:bg-gray-200 focus:shadow-none"
                            href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a></li>
                </ul>
            </nav>
        </div>
    </section>


</x-app-layout>
