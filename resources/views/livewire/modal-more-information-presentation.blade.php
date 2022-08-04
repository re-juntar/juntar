<div>
    @if(isset($presentation))
        <x-jet-dialog-modal wire:model="open" useDefaultStyle={{false}}>
            <x-slot name="content" class="px-0 py-0">
                <x-pink-header>Información de la Presentación</x-pink-header>
                <div class="p-5 overflow-auto">
                    <x-button
                    class="bg-transparent text-black font-extrabold absolute top-4 right-4 z-10 hover:overscroll-auto hover:text-white-ghost"
                    wire:click="$set('open', false)">X</x-button>
                    <table class="w-full text-left border  rounded-lg  ">
                        <thead class="bg-white-ghost">
                            <tr>
                                <th class="pl-4 py-4  text-fogra-darkish text-[2rem] col-span-2 dark:text-gray-400">
                                    {{$presentation->title}}
                                </th>
                            </tr>
                        </thead>
                        <tbody >
                            <tr>
                                <th class="pl-4 py-4  text-fogra-darkish bg-gray-300  dark:text-gray-400">
                                    Nombre
                                </th>
                                <th class="pl-4 py-4  text-fogra-darkish  bg-gray-300 col-span-2 dark:text-gray-400">
                                    {{$presentation->title}}
                                </th>
                            </tr>
                            <tr>
                                <th class="pl-4 py-4  text-fogra-darkish   dark:text-gray-400">
                                    Descripcion
                                </th>
                                <th class="pl-4 py-4  text-fogra-darkish  col-span-2 dark:text-gray-400">
                                    {!! $presentation->description !!}
                                </th>
                            </tr>
                            <tr>
                                <th class="pl-4 py-4  text-fogra-darkish bg-gray-300  dark:text-gray-400">
                                    Dia de la Presentacion
                                </th>
                                <th class="pl-4 py-4  text-fogra-darkish  bg-gray-300 col-span-2 dark:text-gray-400">
                                    {{$presentation->date}}
                                </th>
                            </tr>
                            <tr>
                                <th class="pl-4 py-4  text-fogra-darkish   dark:text-gray-400">
                                    Hora de Inicio
                                </th>
                                <th class="pl-4 py-4  text-fogra-darkish  col-span-2 dark:text-gray-400">
                                    {{$presentation->start_time}}
                                </th>
                            </tr>
                            <tr>
                                <th class="pl-4 py-4  text-fogra-darkish bg-gray-300  dark:text-gray-400">
                                    Hora de Finalizacion
                                </th>
                                <th class="pl-4 py-4  text-fogra-darkish  bg-gray-300 col-span-2 dark:text-gray-400">
                                    {{$presentation->end_time}}
                                </th>
                            </tr>
                            <tr>
                                <th class="pl-4 py-4  text-fogra-darkish   dark:text-gray-400">
                                    Recursos
                                </th>
                                @if($presentation->resources_link)
                                    <th class="pl-4 py-4  text-fogra-darkish  col-span-2 dark:text-gray-400">
                                        <a target="_blank" href="{{$presentation->resources_link}}" rel="noopener noreferrer"><i class="fa fa-paperclip text-awesome"></i></a>           
                                    </th>
                                @else       
                                    <th class="pl-4 py-4  text-fogra-darkish col-span-2 dark:text-gray-400">
                                        Sin Recursos
                                    </th>           
                                @endif       
                            </tr>

                        </tbody>
                    </table>
                </div>
            </x-slot>
        </x-jet-dialog-modal>
    @endif
</div>