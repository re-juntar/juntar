<div>
    <x-jet-dialog-modal wire:model="open" useDefaultStyle={{false}}>
        <x-slot name="content" class="px-0 py-0">
            <x-pink-header>Preguntas y Respuestas</x-pink-header>
            <div class="bg-gray-200 p-5">
                <div class="container overflow-x-scroll lg:overflow-hidden ">
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
                            @foreach ($questionsAndAnswers as $questionAndAnswer)
                            <tr @class(['border-b','bg-white-ghost', 'bg-gray-300' => !$loop->even])>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium dark:text-white">
                                    {{$questionAndAnswer->label}}
                                </td>
                                <td class=" px-6 py-4 whitespace-nowrap text-sm font-medium dark:text-white">
                                    {{$questionAndAnswer->type}}
                                </td>
                                <td class="flex justify-center px-6 py-4 whitespace-nowrap text-sm font-medium dark:text-white">
                                    @php
                                        $optionsArray = explode("/", $questionAndAnswer->options);
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
                                    @if ($questionAndAnswer->description)
                                        {{$questionAndAnswer->description}}
                                    @else
                                        <p class="text-gray-500"> Sin Respuesta</p>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </x-slot>
    </x-jet-dialog-modal>
</div>