
    <x-card class="max-w-4xl mx-auto">
        @livewire('backend.role-modal') 
        @livewire('backend.role-modal-create') 
        <section class="my-5 text-4xl text-awesome">
            Roles
        </section>        
        <div class="sm:flex sm:items-center">
            <div class="-mb-10 z-20 " >
                {{-- <a href="{{ route('addModality') }}"> --}}
                <button class="nline-flex justify-center w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:text-cyan-50 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600" wire:click="$emit('showRoleModalcreate')">Agregar Rol</button>
                {{-- </a> --}}

            </div>

        </div>

         <livewire:backend.role-table /> 
    </x-card>

