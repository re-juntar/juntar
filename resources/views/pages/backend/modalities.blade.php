<div class="">
    <x-card class="max-w-4xl mx-auto">
        <livewire:backend.event-modalities />
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-xl font-semibold text-gray-900">Modalidades</h1>
                    <p class="mt-2 text-sm text-gray-700">A list of all the users.</p>
                </div>
                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <a href="{{route ('addModality')}}">
                    <x-button class="text-[10 px]">Agregar Modalidad</x-button>
                    </a>
                </div>
            </div>
            
    </x-card>
</div>
