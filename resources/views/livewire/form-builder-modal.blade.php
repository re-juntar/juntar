<x-jet-dialog-modal wire:model="open">
    <x-slot name="content">
        <div class="bg-white-ghost p-10">

            {{ Aire::open()->id('addQForm') }}

            {{ Aire::select(['' => 'Seleccione una opción', 'Texto' => 'Texto', 'Checkbox' => 'Checkbox', 'Dropdown' => 'Dropdown', 'Fecha' => 'Fecha', 'Correo' => 'Correo', 'Numero' => 'Numero', 'Radio' => 'Radio', 'Textarea' => 'Area de Texto'], 'type', 'Seleccionar tipo de campo')->id('type')}}
            @error('type')
                <span class="error">{{ $message }}</span>
            @enderror

            {{ Aire::input($name = 'label', $label = 'Ingrese la pregunta')->id('label') }}
            @error('label')
                <span class="error">{{ $message }}</span>
            @enderror

            <div x-show="type == 'Checkbox' || type == 'Dropdown' || type == 'Radio'">
                {{ Aire::input($name = 'options', $label = 'Ingrese las opciones')->id('options') }}
            </div>

            {{ Aire::submit('Guardar')->addClass('bg-awesome text-white-ghost') }}
            
            {{ Aire::close() }}

        </div>

        <script>

            let submitPrevent = document.createAttribute('wire:submit.prevent');
            submitPrevent.value = 'submit';
            document.getElementById("addQForm").setAttributeNode(submitPrevent);

            let wireModelType = document.createAttribute('wire:model');
            wireModelType.value = 'type';
            document.getElementById('type').setAttributeNode(wireModelType);

            let wireModelLabel = document.createAttribute('wire:model');
            wireModelLabel.value = 'label';
            document.getElementById('label').setAttributeNode(wireModelLabel);

            let wireModelOptions = document.createAttribute('wire:model');
            wireModelOptions.value = 'options';
            document.getElementById('options').setAttributeNode(wireModelOptions);

            let onClickButton = document.createAttribute('x-model');
            onClickButton.value = 'type';
            document.getElementById('type').setAttributeNode(onClickButton);

        </script>

    </x-slot>
</x-jet-dialog-modal>

