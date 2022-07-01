<div class="">
    <x-card class="max-w-4xl mx-auto">
        <section class="my-5 text-4xl text-awesome">
            Categorias
        </section>
        
        @livewire('backend.event-category-modal')

        @error('description')
            {{-- @livewire('backend.new-event-category-modal', ['message' => $message]) --}}
            <livewire:backend.new-event-category-modal :message="$message" wire:imit="$emit('showNewCategoryModal')">
        @else
            @livewire('backend.new-event-category-modal', ['message' => ''])
        @enderror
        
        

        <livewire:backend.event-category-table />
        
    </x-card>
</div>
