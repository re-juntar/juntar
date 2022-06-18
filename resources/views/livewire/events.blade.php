<x-app-layout>
    
         
         <div class="my-[1rem]">
            <h2 class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">Mis eventos creados </h2>
            <hr class="my-[1rem]">

            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                    <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <table class="min-w-full text-center">
                            <thead class="border-b bg-gray-800>
                                <tr class="border-b">
                                    <th class="my-[1rem]" scope="col" class="text-sm font-medium text-white px-6 py-4">
                 Nombre del evento </th>

                                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                                    estado </th>
                                
                                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                                    Fecha de cracion</th>
                                
                                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">
                                    Acciones</th>
                                </tr>
                            </thead class="border-b"> 

                        <tbody>
                            @foreach ($eventos as $evento)

                            <tr class="bg-white border-b">
                                <td  class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    <div class="flex items-center">
                                        {{ $evento->name }}
                                    </div>
                                </td>

                                <td  class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    <div class="flex items-center">
                                      
                                        @if($evento->event_status_id == 1) Activo
                                        @elseif ($evento->event_status_id == 2) Inhabilitado
                                        @elseif ($evento->event_status_id == 3) Finalizado
                                        @elseif ($evento->event_status_id == 4) Borrador
                                        @endif
                                    </div>
                                </td>

                                <td  class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    <div class="flex items-center">
                                        {{ $evento->start_date }}
                                    </div>
                                </td>

                                <td  class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    <button class="bg-transparent hover:bg-blue text-blue-dark font-semibold hover:text-white py-2 px-4 border border-blue hover:border-transparent rounded"> Editar </button>
                                    <button class="bg-transparent hover:bg-blue text-blue-dark font-semibold hover:text-white py-2 px-4 border border-blue hover:border-transparent rounded"> Borrar </button>
                                    <button class="bg-transparent hover:bg-blue text-blue-dark font-semibold hover:text-white py-2 px-4 border border-blue hover:border-transparent rounded"> Publicar </button>
                                    <button class="bg-transparent hover:bg-blue text-blue-dark font-semibold hover:text-white py-2 px-4 border border-blue hover:border-transparent rounded"> Finalizar </button>
                                    <button class="bg-transparent hover:bg-blue text-blue-dark font-semibold hover:text-white py-2 px-4 border border-blue hover:border-transparent rounded"> Ver </button>   
                                </td>
                            </tr  class="bg-white border-b">
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div></div>
        </div>
    </div>
</x-app-layout>
