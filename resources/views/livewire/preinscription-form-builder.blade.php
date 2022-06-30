<div class="bg-[#0B0D19]">
    <div class="max-w-md md:max-w-3xl lg:max-w-4xl xl:max-w-6xl mx-auto rounded-lg py-[3vh] px-[3vh]">
        <x-pink-header>Crear formulario de preinscripción</x-pink-header>
        <div class="bg-white-ghost p-5">
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
                                @php
                                    $optionsArray = explode("/", $input['options']);
                                @endphp
                                <ul class="list-disc">

                                    @foreach($optionsArray as $option)
                                    <li class="text-left"> {{ $option }} </li>
                                    @endforeach

                                </ul>
                            </td>

                            <td class="text-lg font-medium px-6 py-2">
                                <x-button wire:click="removeQuestion({{ $loop->index }})"><i class="fa fa-trash"></i></x-button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <x-button class="text-center mt-4" wire:click="saveForm">Guardar</x-button>
            </div>
        </div>
    </div>
    @livewire('form-builder-modal')
</div>