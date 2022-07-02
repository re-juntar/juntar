@aware(['component'])

<x-jet-dialog-modal wire:model="open">
    <x-slot name="content">

        <x-button
            class="bg-transparent text-black font-extrabold absolute top-4 right-4 z-10 hover:overscroll-auto hover:text-white-ghost"
            wire:click="$set('open', false)">X</x-button>

        <div class="bg-white-ghost md:min-h-[32vh] md:relative p-4">
            <section class="my-5 text-4xl text-awesome">
                Nueva Categoria
            </section>

            <form method="POST" action="event-category" >
                @csrf
                {{-- Descripcion categoria --}}
                
                <div class="mb-4 form-group">
                    <x-label for="description">Descripcion *</x-label>
                    <x-input class="w-full form-control" type='text' name='description'
                        placeholder="Descripcion" value="{{ old('description') }}" {{-- wire:model="description" --}}/>
                    <x-jet-input-error for='description' class="text-[1rem]"/>      
                    {{-- @error('description')
                        <div class="flex items-center">
                            <p class="error">{{ $message }}</p>
                        </div>
                    @enderror --}}
                </div>

                {{-- Cargar --}}
                <x-button class="text-[16px]" type="submit"> Crear Categoria </x-button>
            </form>


        </div>
    </x-slot>
</x-jet-dialog-modal>
