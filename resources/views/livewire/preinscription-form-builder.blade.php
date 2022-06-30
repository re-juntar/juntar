<div class="create-event bg-[#0B0D19]">
    <div class="create-event-container max-w-md md:max-w-3xl lg:max-w-4xl xl:max-w-6xl mx-auto rounded-[0.25rem] py-[3vh] px-[3vh]">
        <x-pink-header>Crear formulario de preinscripción</x-pink-header>
        <div class="bg-[#EFEFEF] p-[1.25rem]">
            <x-button class="text-center" wire:click="showModal">Añadir pregunta</x-button>
            <div class="container">
                <table class="min-w-full text-center border mt-2">
                    <thead class="bg-fogra-darkish text-white-ghost">
                        <tr>
                            <th class="text-xl py-3">
                                Pregunta
                            </th>
                            <th class="text-xl py-3">
                                Tipo
                            </th>
                            <th class="text-xl py-3">
                                Opciones
                            </th>
                            <th class="text-xl py-3">
                                Eliminar
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inputs as $input)
                        <tr class="border-b bg-gray-200">
                            <td class="text-lg font-medium text-gray-900 px-6 py-2">
                                {{ $input['label'] }}
                            </td>

                            <td class="text-lg font-medium text-gray-900 px-6 py-2">
                                {{ $input['type'] }}
                            </td>

                            <td class="text-lg font-medium text-gray-900 px-6 py-2">
                                @if(count($input['options'])) {{-- FIX --}}
                                <ul class="list-disc">
                                    @foreach($input['options'] as $option)
                                    <li class="text-left"> {{ $option }} </li>
                                    @endforeach
                                </ul>
                                @else
                                <hr class="border-2 border-black">
                                @endif
                            </td>

                            <td class="text-lg font-medium px-6 py-2">
                                <x-button wire:click="removeQuestion({{ $loop->index }})"><i class="fa fa-trash"></i></x-button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @livewire('form-builder-modal')
</div>