<x-jet-dialog-modal wire:model="open">
    @if(!isset($eventCategory))
    <x-slot name="content">
        <h1 class="text-awesome">Categoria no seleccionada</h1>
    </x-slot>
    @else
    <x-slot name="content">

        <x-button
            class="bg-transparent text-black font-extrabold absolute top-4 right-4 z-10 hover:overscroll-auto hover:text-white-ghost"
            wire:click="$set('open', false)">X</x-button>

        <div class="bg-white-ghost md:min-h-[32vh] md:relative p-4">
            <section class="my-5 text-4xl text-awesome">
                {{ $eventCategory->description }}
            </section>

            <form method="POST" action="event-category" enctype="multipart/form-data" >
                @csrf
                @method('put')

                <input hidden name="id" id="id" value="{{ $eventCategory->id }}">

                {{-- Descripcion categoria --}}
                <div class="mb-4">
                    <x-label for="description">Descripcion *</x-label>
                    <x-input id='description' class="w-full" type='text' name='description'
                        placeholder="Descripcion" value="{{ old('description') ? old('description') : $eventCategory->description }}" required/>
                    @error('description')
                        <div class="flex items-center">
                            <p class="text-red-600">{{ $message }}</p>
                        </div>
                    @enderror
                </div>

                {{-- Cargar --}}
                <x-button class="text-[16px]" type="submit"> Modificar </x-button>
            </form>


        </div>
    </x-slot>
    @endif
</x-jet-dialog-modal>
