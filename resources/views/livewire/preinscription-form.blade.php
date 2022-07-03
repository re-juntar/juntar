<div class="bg-[#0B0D19]">
    <div class="max-w-md md:max-w-3xl lg:max-w-4xl xl:max-w-6xl mx-auto rounded-lg py-[3vh] px-[3vh]">
        <x-pink-header>Formulario de preinscripción</x-pink-header>
        <div class="bg-white-ghost p-5">
            <div class="mx-auto w-4/5 sm:w-3/6">
            <x-aire::form wire:submit.prevent='store'>

                @foreach($fields as $field)

                    @switch($field['type'])

                        @case('Texto')
                            <x-aire::input name="textInput{{$loop->index}}" label="{{$field['label']}}" id="textInput{{$loop->index}}" wire:model="inputs.{{$field['QuestionId']}}"/>
                            @break
                    
                        @case('Checkbox')
                            @foreach($field['options'] as $option)
                            <x-aire::checkbox name="checkbox{{$loop->parent->index}}[]" label="{{$option}}" id="checkbox{{$loop->index}}" value="{{$option}}" wire:model="inputs.{{$field['QuestionId']}}.{{$loop->index}}" />
                            @endforeach
                            @break
                    
                        @case('Dropdown')
                            {{ Aire::select($field['options'], 'select'.$loop->index, $field['label'])->setAttribute('wire:model', 'inputs.'.$field['QuestionId']) }}
                            @break
                    
                        @case('Fecha')
                            {{ Aire::date('date_input'.$loop->index, $field['label'])->setAttribute('wire:model', 'inputs.'.$field['QuestionId']) }}
                            @break
                    
                        @case('Correo')
                            {{ Aire::email('email'.$loop->index, $field['label'])->setAttribute('wire:model', 'inputs.'.$field['QuestionId']) }}
                            @break
                    
                        @case('Numero')
                            {{ Aire::number('number'.$loop->index, $field['label'])->setAttribute('wire:model', 'inputs.'.$field['QuestionId']) }}
                            @break
                    
                        @case('Radio')
                            {{ Aire::radioGroup($field['options'], 'radio'.$loop->index, $field['label'])->setAttribute('wire:model', 'inputs.'.$field['QuestionId']) }}
                            @break
                    
                        @case('Textarea')
                            {{ Aire::textArea('textArea'.$loop->index, $field['label'])->setAttribute('wire:model', 'inputs.'.$field['QuestionId']) }}
                            @break

                    @endswitch

                @endforeach

                {{ Aire::submit('Guardar')->addClass('bg-awesome text-white-ghost') }}

            </x-aire::form>
            </div>
        </div>
    </div>
</div>

{{-- ->setAttribute('wire:model', 'label') --}}