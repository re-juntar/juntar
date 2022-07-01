<div>
    <x-card class="max-w-4xl mx-auto">
        {{-- <livewire:backend.event-modalities /> --}}
        <div class="sm:flex sm:items-center">
            <div class="mt-4 ">
                {{-- <a href="{{ route('addModality') }}"> --}}
                <x-button wire:click="$set('open',true)">Agregar Modalidad</x-button>
                {{-- </a> --}}

            </div>

        </div>
    </x-card>

    <div>

        <x-jet-dialog-modal wire:model='open'>
            <x-slot name='title'>
                {{-- <div class="text-grey-100">
                    Menu para agregar nuevas modalidades
                </div> --}}
            </x-slot>

            <x-slot name='content'>
                <div class="text-grey-100">
                    Menu para agregar nuevas modalidades
                </div>
                <strong class="text-red-500">Nombre/Modalidad</strong>
                <div class="mt-4">
                   
                    <x-jet-input type='text' class="w-full" wire:model.defer="description" />
                     <x-jet-input-error for='description' />                    
                    
                    @error('description')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <x-jet-danger-button class="mt-4" wire:click='save'>
                    Guardar
                </x-jet-danger-button>
                
            </x-slot>
            <x-slot name='footer'>
            </x-slot>

            </x-jet-dialog-modal>
    </div>
</div>
