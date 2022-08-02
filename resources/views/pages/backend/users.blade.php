<div class="">
    <x-card class="max-w-4xl mx-auto">
        <section class="my-5 text-4xl text-awesome">
            Usuarios
        </section>
        <livewire:backend.user-table />
    </x-card>
    <x-card class="max-w-4xl mx-auto my-5">
        <livewire:add-user-academic-unit-modal />
        <section class="my-5 text-4xl text-awesome">
            Validadores
        </section>
        <livewire:backend.academic-unit-user-table />
    </x-card>
</div>
