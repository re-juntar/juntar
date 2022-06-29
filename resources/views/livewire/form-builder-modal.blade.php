<x-jet-dialog-modal wire:model="open">
    <x-slot name="content">
        <div class="bg-white-ghost p-10">

            {{ Aire::open()->asAlpineComponent()->id('addQForm') }}

            {{ Aire::select([0 => 'Seleccione una opción', 1 => 'Texto', 2 => 'Checkbox', 3 => 'Dropdown', 4 => 'Fecha', 5 => 'Correo', 6 => 'Número', 7 => 'Radio', 8 => 'Area de Texto'], 'type', 'Seleccionar tipo de campo')->id('type')->value(0)}}
            @error('type') <span class="error">{{ $message }}</span> @enderror

            {{ Aire::input($name = 'label', $label = 'Ingrese la pregunta')->id('label') }}
            @error('label') <span class="error">{{ $message }}</span> @enderror

            <div x-show="type == 2 || type == 3 || type == 7">
                {{ Aire::input($name = 'options', $label = 'Ingrese las opciones')->id('options') }}
            </div>

            {{ Aire::submit('Guardar campo')->addClass('bg-awesome text-white-ghost') }}
            
            {{ Aire::close() }}

        </div>

        <script>
            let submitPrevent = document.createAttribute('wire:submit.prevent');
            submitPrevent.value = 'submit';
            document.getElementById("addQForm").setAttributeNode(submitPrevent);

            let wireModelType = document.createAttribute('wire:model');
            wireModelType.value = 'type';
            document.getElementById("type").setAttributeNode(wireModelType);

            let wireModelLabel = document.createAttribute('wire:model');
            wireModelLabel.value = 'label';
            document.getElementById("label").setAttributeNode(wireModelLabel);

            let wireModelOptions = document.createAttribute('wire:model');
            wireModelOptions.value = 'options';
            document.getElementById("options").setAttributeNode(wireModelOptions);
        </script>

    </x-slot>
</x-jet-dialog-modal>

