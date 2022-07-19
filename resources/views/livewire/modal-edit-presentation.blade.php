<x-jet-dialog-modal wire:model="openEdit">
    @if (!isset($presentation))
        <x-slot name="content">
            <h1 class="text-awesome">Presentacion no Seleccionada</h1>
        </x-slot>
    @else
        <x-slot name="content">
            <div class="bg-white-ghost md:min-h-[32vh] md:relative p-4">
                <x-button
                    class="bg-transparent text-black font-extrabold absolute top-4 right-4 z-10 hover:overscroll-auto hover:text-white-ghost"
                    wire:click="$set('openEdit', false)">X</x-button>
                <section class="my-5 text-4xl text-awesome">
                    Editar
                </section>

                <form wire:submit.prevent="submit">
                    {{-- Nombre presentation --}}
                    <div class="mb-4">
                        <x-label for="name">Nombre * </x-label>
                        <x-input wire:model='name' id="name" class="w-full" type='text' name='name'
                            placeholder="nombre" value="{{ old('name') ? old('name') : $presentation->name }}" required />
                        @error('name')
                            <div class="flex items-center">
                                <p class="text-red-600">{{ $message }}</p>
                            </div>
                        @enderror
                    </div>
                    {{-- Nombre presentation --}}

                    {{-- Cargar --}}
                    <x-button class="text-[16px]" wire:click='submit'> Modificar </x-button>
                </form>


            </div>
        </x-slot>
        <x-slot name='content'>
            <div class="bg-white-ghost p-5">
                <x-button
                class="bg-transparent text-black font-extrabold absolute top-4 right-4 z-10 hover:overscroll-auto hover:text-white-ghost"
                wire:click="$set('openEdit', false)">X</x-button>
                <div class="my-5 text-4xl text-awesome">
                    <p>Editar Presentacion</p>
                </div>
                <div class="inputGroup mb-4">
                    <p>Titulo:</p>
                    <div>
                        <x-jet-input type='text' class="w-full" wire:model="title" />
                        <x-jet-input-error for='title' class="text-[1rem]"/>                    
                    </div>
                </div>
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
                <x-button class="mt-4" wire:click='save' >Guardar </x-button>
                <p class="italic">Los campos marcados con (*) son obligatorios.</p>
            </div>
        </x-slot>
    @endif
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script>        
        const editor =  CKEDITOR.replace('description');
        editor.on('change', function(event){
            console.log(event.editor.getData());                    
            @this.set('description', event.editor.getData());
        })    
    </script>
</x-jet-dialog-modal>
