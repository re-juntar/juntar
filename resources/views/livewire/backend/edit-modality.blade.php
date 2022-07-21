<div>
    <x-card class="max-w-4xl mx-auto">
        <livewire:backend.event-modalities />
        <div class="sm:flex sm:items-center">
            <div class="mt-4 ">
                <x-button wire:click="$set('open',true)">Agregar Modalidad</x-button>
            </div>

        </div>
    </x-card>

    <div>

        <x-jet-dialog-modal wire:model='open'>
            <x-slot name='content'>
                <div class="bg-white-ghost p-5">
                    <p>Nombre/Descripcion:</p>
                    <div>
                        <x-jet-input type='text' class="w-full" wire:model="description" value='{{ $description }}' />
                        <x-jet-input-error for='description' class="text-[1rem]" />
                    </div>
                    <x-button class="mt-4" wire:click='save'>Guardar</x-button>
                </div>
            </x-slot>
        </x-jet-dialog-modal>
    </div>
</div>
