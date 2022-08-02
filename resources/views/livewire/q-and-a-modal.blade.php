<x-jet-dialog-modal wire:model="open">
    <x-slot name="content">
        <x-pink-header>Preguntas y Respuestas</x-pink-header>
        <div class="bg-gray-200 p-5">
            <div class="container overflow-x-scroll lg:overflow-hidden ">
                @foreach ($answers as $answer)
                    @if($idInscription == $answer->inscription_id)
                        <table class="min-w-full text-center border rounded-lg mt-2">
                            <thead class="bg-white-ghost">
                                <tr>
                                    <th class="px-6 py-4 text-xs text-gray-500   dark:text-gray-400">
                                        PREGUNTA
                                    </th>
                                    <th class="px-6 py-4 text-xs text-gray-500   dark:text-gray-400">
                                        TIPO
                                    </th>
                                    <th class="px-6 py-4 text-xs text-gray-500   dark:text-gray-400">
                                        OPCIONES
                                    </th>
                                    <th class="px-6 py-4 text-xs text-gray-500   dark:text-gray-400">
                                        RESPUESTA
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($questions as $question)
                                <tr @class(['border-b', 'bg-gray-300' => !$loop->even])>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium dark:text-white">
                                        {{$question->label}}
                                    </td>
                                    <td class=" px-6 py-4 whitespace-nowrap text-sm font-medium dark:text-white">
                                        {{$question->type}}
                                    </td>
                                    <td class="flex justify-center px-6 py-4 whitespace-nowrap text-sm font-medium dark:text-white">
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
                                        <p class="text-sm text-gray-500">No posee</p>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium dark:text-white">
                                        @foreach ($answers as $answer)
                                        @if ($answer->question_id === $question->id && $answer->description)
                                            {{$answer->description}}
                                        @else
                                            <p class="text-gray-500"> No tiene respuesta.</p>
                                        @endif
                                    @endforeach
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-xl py-3 flex justify-center">NO TIENE RESPUESTAS</p>
                    @endif
                @endforeach
            </div>
        </div>
    </x-slot>
</x-jet-dialog-modal>
