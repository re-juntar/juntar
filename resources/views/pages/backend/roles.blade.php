
    <x-card class="max-w-4xl mx-auto">
        @livewire('backend.role-modal') 
        @livewire('backend.role-modal-create') 
        <section class="my-5 text-4xl text-awesome">
            Roles
        </section>        
        <div class="sm:flex sm:items-center">
            <div class="mt-4 ">
                {{-- <a href="{{ route('addModality') }}"> --}}
                <x-button wire:click="$emit('showRoleModalcreate')">Agregar Rol</x-button>
                {{-- </a> --}}

            </div>

        </div>

         <livewire:backend.role-table /> 
    </x-card>

