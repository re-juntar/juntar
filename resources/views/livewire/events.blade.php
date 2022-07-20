<x-app-layout>
    <x-hero>
        <img class="max-w-full h-auto mb-4" src="{{ asset('images/logos/juntar-logo-w.svg') }}" alt="" />
        <h5 class="text-white-ghost uppercase font-medium text-xl mb-4">Sistema de gestión de eventos</h5>
    </x-hero>

    <section class="bg-fogra-darkish w-full text-white-ghost pt-16 pb-5 px-4">
        {{-- Table --}}
        <div class="flex flex-col max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-white-ghost uppercase mb-2 font-medium leading-6 text-3xl">Mis eventos creados</h2>
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden rounded-lg m-1">
                        <livewire:user-events-table>
                    </div>
                    <h2 class="text-white-ghost mt-11 uppercase mb-5 font-medium leading-6 text-3xl">Eventos donde soy Coorganizador</h2>  
                    <div class="overflow-hidden rounded-lg  ">
                        <livewire:coorganizer-event-table>
           
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
