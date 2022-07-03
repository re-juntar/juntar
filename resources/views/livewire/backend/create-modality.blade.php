<div class="max-w-4xl mx-auto mt-5">
    <div class="max-w-4xl mx-auto mt-5">
        <div class="px-4 sm:px-6 lg:px-8">
            <form wire:submit.prevent="save">
                <div class="mb-6">
                    <x-label for="description">Descripcion/Nombre</x-label>
                    <x-input id="description" class="w-full" wire:model="eventModality.description" name="description" />
                    @error('eventModality.description')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex items-center justify-start space-x-4">
                    <x-button class="text-[0.8rem]" type="submit">Crear Modalidad</x-button>
                </div>
            </form>
        </div>
    </div>
</div>
