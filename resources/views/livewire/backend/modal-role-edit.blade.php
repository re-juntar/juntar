<x-jet-dialog-modal wire:model="open">
    @if(!isset($role))
    <x-slot name="content">
        <h1 class="text-awesome">Rol no Seleccionado</h1>
    </x-slot>
    @else
    <x-slot name="content">

        <x-button
            class="bg-transparent text-black font-extrabold absolute top-4 right-4 z-10 hover:overscroll-auto hover:text-white-ghost"
            wire:click="$set('open', false)">X</x-button>

        <div class="bg-white-ghost md:min-h-[32vh] md:relative p-4">
            <section class="my-5 text-4xl text-awesome">
                Editar
            </section>

            <form method= "POST" action="roles" enctype="multipart/form-data" >
                @csrf
                @method('PUT')
                {{-- Nombre role --}}
                <input hidden name="id" id="id" value="{{ $role->id }}">
                <div class="mb-4">
                    <x-label for="name">Nombre * </x-label>
                    <x-input id='name' class="w-full" type='text' name='name'
                        placeholder="Name" value="{{ old('name') ? old('name') : $role->name }}" />
                    @error('name')
                        <div class="flex items-center">
                            <p class="text-red-600">{{ $message }}</p>
                        </div>
                    @enderror
                </div>
                {{-- Nombre role --}}
                <div class="mb-4">
                    <x-label for="description">Descripcion *</x-label>
                    <x-input id='description' class="w-full" type='text' name='description'
                        placeholder="Descripcion" value="{{ old('description') ? old('description') : $role->description }}" />
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