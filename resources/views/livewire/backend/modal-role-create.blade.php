<x-jet-dialog-modal wire:model="opencreate">
    <x-slot name="content">

        <x-button
            class="bg-transparent text-black font-extrabold absolute top-4 right-4 z-10 hover:overscroll-auto hover:text-white-ghost"
            wire:click="$set('open', false)">X</x-button>

        <div class="bg-white-ghost md:min-h-[32vh] md:relative p-4">
            <section class="my-5 text-4xl text-awesome">
                Crear Role
            </section>

            <form method= "POST" action="rolecreates" enctype="multipart/form-data" >
                @csrf
                {{-- Nombre rolecreate --}}
                <div class="mb-4">
                    <x-label for="name">Nombre * </x-label>
                    <x-input id='name' class="w-full" type='text' name='name'
                        placeholder="Name" value="{{ old('name')}}" />
                    @error('name')
                        <div class="flex items-center">
                            <p class="text-red-600">{{ $message }}</p>
                        </div>
                    @enderror
                </div>
                {{-- Nombre rolecreate --}}
                <div class="mb-4">
                    <x-label for="description">Descripcion *</x-label>
                    <x-input id='description' class="w-full" type='text' name='description'
                        placeholder="Descripcion" value="{{ old('description') }}" />
                    @error('Descripcion')
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