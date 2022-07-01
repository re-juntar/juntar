<x-jet-dialog-modal wire:model="open">
    <x-slot name="content">
        <div class="bg-white-ghost p-10">

            {{ Aire::open()->id('addQForm')->setAttribute('wire:submit.prevent', 'submit') }}

            {{ Aire::select(['' => 'Seleccione una opción', 'Texto' => 'Texto', 'Checkbox' => 'Checkbox', 'Dropdown' => 'Dropdown', 'Fecha' => 'Fecha', 'Correo' => 'Correo', 'Numero' => 'Numero', 'Radio' => 'Radio', 'Textarea' => 'Area de Texto'], 'type', 'Seleccionar tipo de campo')->id('type')->setAttribute('wire:model', 'type')->setAttribute('x-model', 'type')}}
            @error('type')
                <span class="error">{{ $message }}</span>
            @enderror

            {{ Aire::input($name = 'label', $label = 'Ingrese la pregunta')->id('label')->setAttribute('wire:model', 'label') }}
            @error('label')
                <span class="error">{{ $message }}</span>
            @enderror

            <div x-show="type == 'Checkbox' || type == 'Dropdown' || type == 'Radio'">
                {{ Aire::input($name = 'options', $label = 'Ingrese las opciones')->id('options')->setAttribute('wire:model', 'options') }}
            </div>

            {{ Aire::submit('Guardar')->addClass('bg-awesome text-white-ghost') }}
            
            {{ Aire::close() }}

        </div>

    </x-slot>
</x-jet-dialog-modal>

