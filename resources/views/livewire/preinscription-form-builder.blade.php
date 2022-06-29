
    <div class="create-event bg-[#0B0D19]">
        <div
            class="create-event-container max-w-md md:max-w-3xl lg:max-w-4xl xl:max-w-6xl mx-auto rounded-[0.25rem] py-[3vh] px-[3vh]">
            <x-pink-header>Crear formulario de preinscripción</x-pink-header>
            <div class="bg-[#EFEFEF] p-[1.25rem]">
                <x-button class="text-center" wire:click="showModal">Añadir pregunta</x-button>
                <div class="container">
                    @foreach ($inputs as $input)
                        
                    @endforeach
                </div>
            </div>
        </div>

        @livewire('form-builder-modal')

    </div>
