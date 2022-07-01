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

            <form method="POST" action="event-category" enctype="multipart/form-data" >
                @csrf
                {{-- Descripcion categoria --}}
                <div class="mb-4">
                    <x-label for="description">Descripcion *</x-label>
                    <x-input id='description' class="w-full" type='text' name='description'
                        placeholder="Descripcion" value="{{ old('description') }}"  />

                    @if($message)
                    
                        <div class="flex items-center">
                            <p class="text-red-600">{{ $message }}</p>
                        </div>
                    @endif
                </div>

                {{-- Cargar --}}
                <x-button class="text-[16px]" type="submit"> Crear Categoria </x-button>
            </form>


        </div>
    </x-slot>
</x-jet-dialog-modal>
