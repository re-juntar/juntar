<div class="bg-fogra-darkish">
    <section class="w-full lg:w-10/12 mx-auto py-[70px]">
        <div class="cards-container w-10/12 mx-auto px-[15px]">
            <div>
                <x-pink-header>Crear Presentacion</x-pink-header>
                <x-button class="bg-transparent text-black font-extrabold absolute top-4 right-4 z-10 hover:overscroll-auto hover:text-white-ghost" wire:click="$set('openCreate', false)">X</x-button>
                <div class="bg-white-ghost p-5">
                    <div class="inputGroup mb-4">
                        <p>Titulo *</p>
                        <div>
                            <x-jet-input type='text' class="w-full" wire:model="title" name="title" placeholder="Ingrese Titulo de la Presentacion"/>
                            <x-jet-input-error for='title' class="text-[1rem]"/>                    
                        </div>
                    </div>
                    <div wire:ignore class="mb-4" >
                        <x-label for="description">Descripcion *</x-label>
                        <textarea id="description" class="block w-full" name="description" rows="10" wire:model="description">
                            {{ old('description') }}
                        </textarea>
                    </div>
                    <x-jet-input-error for='description' class="text-[1rem] mb-4"/>   
                    <div class="inputGroup mb-4">
                        <p>Fecha: *</p>
                        <div>
                            <x-jet-input type='date' wire:model="date" name="date"/>
                            <x-jet-input-error for='date' class="text-[1rem]"/>                    
                        </div>
                    </div>
                    <div class="inputGroup mb-4">
                        <p>Hora de Inicio *</p>
                        <div>
                            <x-jet-input type='time' wire:model="start_time" name="start_time"/>
                            <x-jet-input-error for='start_time' class="text-[1rem]"/>                    
                        </div>
                    </div>
                    <div class="inputGroup mb-4">
                        <p>Hora de Finalizacion *</p>
                        <div>
                            <x-jet-input type='time' wire:model="end_time" name="end_time"/>
                            <x-jet-input-error for='end_time' class="text-[1rem]"/>                    
                        </div>
                    </div>
                    <div class="inputGroup mb-4">
                        <p>Expositores</p>
                        <div>
                            <x-jet-input type='text' class="w-full" wire:model="exhibitors" name="exhibitors"/>
                            <x-jet-input-error for='exhibitors' class="text-[1rem]"/>                    
                        </div>
                    </div>
                    <div class="inputGroup mb-4">
                        <p>Link a recursos</p>
                        <div>
                            <x-jet-input type='text' class="w-full" wire:model="resources_link" name="resources_link" placeholder="https://ejemplo.com o http://ejemplo.com"/>
                            <x-jet-input-error for='resources_link' class="text-[1rem]"/>                    
                        </div>
                    </div>
                    <p class="italic mb-[1rem]">Los campos marcados con (*) son obligatorios.</p>
                    <x-button wire:click='save' >Crear </x-button>
                </div>

                <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
                <script>        
                    const editor =  CKEDITOR.replace('description');
                    editor.on('change', function(event){
                        @this.set('description', event.editor.getData());
                    })    
                </script>
            </div>
        </div>
    </section>
</div>