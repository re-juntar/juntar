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
                                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">Nombre</th>
                                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">Estado</th>
                                    <th scope="col" class="hidden sm:flex text-sm font-medium text-white px-6 py-4">
                                        Fecha de cracion
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">Acciones</th>
                                </tr>
                            </thead class="border-b">
                            <tbody class="bg-white-ghost">
                                @foreach ($events as $event)
                                    <tr class="bg-white border-b">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            @if (strlen($event->name) > 25)
                                                {{ substr($event->name, 0, 25) . '...' }}
                                            @else
                                                {{ $event->name }}
                                            @endif
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            @switch($event->event_status_id)
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
                                        <td
                                            class="hidden sm:table-cell text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap items-center">
                                            {{ $event->start_date }}
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <div class="justify-center hidden sm:grid sm:gap-2 sm:grid-cols-2 lg:flex">
                                                <x-button class="bg-blue-400">Editar</x-button>
                                                <x-button>Borrar</x-button>
                                                <x-button class="bg-green-500">Publicar</x-button>
                                                <x-button>Finalizar</x-button>
                                                {{-- <x-button>Ver</x-button> --}}
                                            </div>

                                            {{-- More Actions dots button that shows on phones --}}
                                            <div id="dropdown-{{ $event->id }}"
                                                class="inline-block sm:hidden relative text-left dropdown">
                                                <button
                                                    class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out bg-white shadow-none"
                                                    type="button" aria-haspopup="true" aria-expanded="true"
                                                    onclick="toggleDropdownMenu('dropdown-menu-{{ $event->id }}', 'dropdown-{{ $event->id }}')"
                                                    aria-controls="headlessui-menu-items-117">
                                                    <img src="{{ url('/images/icons/dots-vertical.svg') }}"
                                                        alt="more options icon">
                                                </button>
                                                <div id="dropdown-menu-{{ $event->id }}"
                                                    class="opacity-0
                                                    invisible transition-all duration-300 transform
                                                    origin-top-right -translate-y-2 scale-95">
                                                    <div class="absolute right-0 w-56 mt-2 origin-top-right bg-white-ghost border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none"
                                                        aria-labelledby="headlessui-menu-button-1"
                                                        id="headlessui-menu-items-117" role="menu">
                                                        <ul class="list-none bg-white-ghost">
                                                            <li>
                                                                <x-button class="w-full bg-blue-400">Editar</x-button>
                                                            </li>
                                                            <li>
                                                                <x-button class="w-full">Borrar</x-button>
                                                            </li>
                                                            <li>
                                                                <x-button class="w-full bg-green-500">Publicar
                                                                </x-button>
                                                            </li>
                                                            <li>
                                                                <x-button class="w-full">Finalizar</x-button>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
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
        {{-- edit styles on resources/views/pagination/tailwind.blade.php --}}
        <div class="flex justify-center">
            {{ $events->links() }}
        </div>
    </section>

    {{-- Actions table funcionality --}}
    <style>
        .dropdown-menu {
            opacity: 1;
            transform: translate(0) scale(1);
            visibility: visible;
        }
    </style>

    <script>
        // toggle dropdownMenu hidden on focusout
        let dropdowns = document.querySelectorAll(`.dropdown`);
        for (let i = 0; i < dropdowns.length; i++) {
            dropdowns[i].addEventListener('focusout', () => {
                dropdowns[i].lastElementChild.classList.remove('dropdown-menu');
            })
        }

        function toggleDropdownMenu(idDropdownMenu, idDropdown) {
            let dropdownMenu = document.querySelector(`#${idDropdownMenu}`);
            dropdownMenu.classList.toggle("dropdown-menu");
        }
    </script>

</x-app-layout>
