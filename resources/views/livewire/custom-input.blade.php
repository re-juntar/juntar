@switch($input['type'])
    @case('Texto')
        {{ Aire::input()->label($input['label']) }}
        @break
 
    @case('Checkbox')
        {{ Aire::checkboxGroup($input['options'], 'radio', $input['label']) }}
        @break
 
    @case('Dropdown')
        {{ Aire::select($input['options'], 'select', $input['label']) }}
        @break

    @case('Fecha')
        {{ Aire::date('date_input', $input['label']) }}
        @break

    @case('Correo')
        {{ Aire::email('email', $input['label']) }}
        @break

    @case('Numero')
        {{ Aire::number('number', $input['label']) }}
        @break

    @case('Radio')
        {{ Aire::radioGroup($input['options'], 'radio', $input['label']) }}
        @break

    @case('Textarea')
        {{ Aire::textArea('textArea', $input['label']) }}
        @break
@endswitch