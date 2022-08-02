<div class="">
    <x-card class="max-w-4xl mx-auto">
        <section class="my-5 text-4xl text-awesome">
            Modalidades
        </section>
        <livewire:backend.event-modalities-table />
        @livewire('backend.modal-create-modality')
        @livewire('backend.modal-edit-modality')
    </x-card>
</div>
