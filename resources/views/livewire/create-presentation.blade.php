<div>
    <button type="button" wire:click="$set('open',true)"'><i class="fa-solid fa-plus ml-2 fa-lg"></i></button>
    <x-jet-dialog-modal wire:model='open'>
        <x-slot name='content'>
            <div class="bg-white-ghost p-5">
                <div class="inputGroup mb-4">
                    <p>Titulo:</p>
                    <div>
                        <x-jet-input type='text' class="w-full" wire:model="title" />
                        <x-jet-input-error for='title' class="text-[1rem]"/>                    
                    </div>
                </div>
                <div class="inputGroup mb-4">
                    <p>Descripcion:</p>
                    <div>
                        <x-jet-input type='text' class="w-full" wire:model="description" />
                        <x-jet-input-error for='description' class="text-[1rem]"/>                    
                    </div>
                </div>
                <div class="inputGroup mb-4">
                    <p>Fecha:</p>
                    <div>
                        <x-jet-input type='date' wire:model="date" />
                        <x-jet-input-error for='date' class="text-[1rem]"/>                    
                    </div>
                </div>
                <div class="inputGroup mb-4">
                    <p>Hora Inicio</p>
                    <div>
                        <x-jet-input type='time' wire:model="start_time" />
                        <x-jet-input-error for='start_time' class="text-[1rem]"/>                    
                    </div>
                </div>
                <div class="inputGroup mb-4">
                    <p>Hora Fin</p>
                    <div>
                        <x-jet-input type='time' wire:model="end_time" />
                        <x-jet-input-error for='end_time' class="text-[1rem]"/>                    
                    </div>
                </div>
                <div class="inputGroup mb-4">
                    <p>Presentadores</p>
                    <div>
                        <x-jet-input type='text' class="w-full" wire:model="exhibitors" />
                        <x-jet-input-error for='exhibitors' class="text-[1rem]"/>                    
                    </div>
                </div>
                <div class="inputGroup mb-4">
                    <p>Recursos</p>
                    <div>
                        <x-jet-input type='text' class="w-full" wire:model="resources_link" />
                        <x-jet-input-error for='resources_link' class="text-[1rem]"/>                    
                    </div>
                </div>
                <x-button class="mt-4" wire:click='save' >Crear Presentacion</x-button>
            </div>
        </x-slot>
    </x-jet-dialog-modal>
</div>