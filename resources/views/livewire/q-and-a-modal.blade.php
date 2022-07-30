<x-jet-dialog-modal wire:model="open">
    <x-slot name="content">
        <div class="bg-[#0B0D19]">
            <div class="max-w-md md:max-w-3xl lg:max-w-4xl xl:max-w-6xl mx-auto rounded-lg py-[3vh] px-[3vh]">
                <x-pink-header>Preguntas y Respuestas</x-pink-header>
                <div class="bg-white-ghost p-5">
                    <div class="container overflow-x-scroll lg:overflow-hidden">
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
                                        Respuestas
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($questions as $question)
                                
                                
                                <tr @class(['border-b', 'bg-gray-300' => !$loop->even])>
                                    <td class="text-lg font-medium text-gray-900 px-2 py-2">
                                        {{$question->label}}
                                    </td>
        
                                    <td class="text-lg font-medium text-gray-900 px-2 py-2">
                                        {{$question->type}}
                                    </td>
        
                                    <td class="flex justify-center text-lg font-medium text-gray-900 px-2 py-2">
                                        @php
                                            $optionsArray = explode("/", $question->options);
                                        @endphp
                                        @if(1 < count($optionsArray))
                                        <ul class="list-disc">
                                            @foreach($optionsArray as $option)
                                            <li class="text-left"> {{ $option }} </li>
                                            @endforeach
                                        </ul>
                                        @else
                                        <p class="text-sm">No posee</p>
                                        @endif
                                    </td>
                                    <td class="text-lg font-medium text-gray-900 px-2 py-2">
                                        @foreach ($answers as $answer)
                                        @if ($answer->question_id === $question->id)
                                            {{$answer->description}}
                                        @endif
                                    @endforeach
                                    </td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-jet-dialog-modal>
