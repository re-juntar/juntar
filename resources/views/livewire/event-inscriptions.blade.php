<div>
    <x-hero>
        <img class="max-w-full h-auto mb-4" src="{{ asset('images/logos/juntar-logo-w.svg') }}" alt="" />
        <h5 class="text-white-ghost uppercase font-medium text-xl mb-4">Sistema de gestión de eventos</h5>
    </x-hero>

    <section class="bg-fogra-darkish w-full pt-16 pb-5 px-4">
        {{-- Table --}}
        <div class="flex flex-col max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-white-ghost uppercase mb-2 font-medium leading-6 text-3xl">Pre - Inscriptos </h2>
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">     
                    <div class="overflow-hidden rounded-lg  ">
                    <livewire:preinscription-table event="{{$eventId}}">
                    </div>
                </div>
            </div>
            
            

            <h2 class="text-white-ghost uppercase mb-2 font-medium leading-6 text-3xl">Inscriptos </h2>
            
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                
                
                <div class=" py-4 inline-block min-w-full sm:px-6 lg:px-8 " >
                    <a class="inline px-6 py-2.5 bg-blue-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-500 hover:shadow-lg focus:bg-blue-500 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-600 active:shadow-lg transition duration-150 ease-in-out" 
                    data-icon="arrow-alt-circle-up"
                    href="{{route('descargar.inscriptos',$eventId)}}"
                    
                    >Exportar listado
                </a>            
                </div>
                <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">     
                    

                    <div class="overflow-hidden rounded-lg  ">
                        <livewire:event-inscriptions-table  event="{{$eventId}}">
                        @livewire('q-and-a-modal')
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
