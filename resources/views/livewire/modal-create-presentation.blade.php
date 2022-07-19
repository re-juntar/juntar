<div>
    <button type="button" wire:click="$set('openCreate',true)"'><i class="fa-solid fa-plus ml-2 fa-lg"></i></button>
    <x-jet-dialog-modal wire:model='openCreate'>
        <x-slot name='content'>
            <x-button class="bg-transparent text-black font-extrabold absolute top-4 right-4 z-10 hover:overscroll-auto hover:text-white-ghost" wire:click="$set('openCreate', false)">X</x-button>
            <div class="bg-white-ghost p-5">
                <div class="my-5 text-4xl text-awesome">
                    <p>Crear Presentacion</p>
                </div>
                <div class="inputGroup mb-4">
                    <p>Titulo:</p>
                    <div>
                        <x-jet-input type='text' class="w-full" wire:model="title" />
                        <x-jet-input-error for='title' class="text-[1rem]"/>                    
                    </div>
                </div>
{{--                 <div class="mb-4" wire:ignore>
                    <x-label for="description">Descripcion *</x-label>
                    <x-jet-input type='textarea' id="description" class="block w-full" name="description" rows="10" wire:model.defer="description"/>
                    <x-jet-input-error for='description' class="text-[1rem]"/>   
                </div> --}}
                <div wire:ignore>
                    <x-label for="description">Descripcion *</x-label>
                    <textarea id="description" class="block w-full" name="description" rows="10" wire:model="description">
                        {{ old('description') }}
                    </textarea>
                    {{-- <x-jet-input-error for='description' class="text-[1rem]"/>    --}}
                </div>
                <div class="inputGroup mb-4">
                    <p>Fecha:</p>
                    <div>
                        <x-jet-input type='date' wire:model="date" />
                        <x-jet-input-error for='date' class="text-[1rem]"/>                    
                    </div>
                </div>
                <div class="inputGroup mb-4">
                    <div>
                        <p>Hora Inicio</p>
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
                <x-button class="mt-4" wire:click='save' >Crear </x-button>
                <p class="italic">Los campos marcados con (*) son obligatorios.</p>
            </div>
        </x-slot>
    </x-jet-dialog-modal>
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script>        
        const editor =  CKEDITOR.replace('description');
        editor.on('change', function(event){
            console.log(event.editor.getData());                    
            @this.set('description', event.editor.getData());
        })    
    </script>
</div>
