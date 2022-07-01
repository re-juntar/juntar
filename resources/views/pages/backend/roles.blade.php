<div>
    <x-card class="max-w-4xl mx-auto">
        <section class="my-5 text-4xl text-awesome">
            Roles
        </section>
        @livewire('backend.role-modal') 
        @livewire('backend.role-modal-create') 
         <livewire:backend.role-table /> 
    </x-card>
</div>
