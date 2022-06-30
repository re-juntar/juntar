@switch($input['type'])
    @case(1)
        {{ Aire::input()->label($input['label']) }}
        @break
 
    @case(2)
        {{ Aire::checkboxGroup($input['options'], 'radio', $input['label']) }}
        @break
 
    @case(3)
        {{ Aire::select($input['options'], 'select', $input['label']) }}
        @break

    @case(4)
        {{ Aire::date('date_input', $input['label']) }}
        @break

    @case(5)
        {{ Aire::email('email', $input['label']) }}
        @break

    @case(6)
        {{ Aire::number('number', $input['label']) }}
        @break

    @case(7)
        {{ Aire::radioGroup($input['options'], 'radio', $input['label']) }}
        @break

    @case(8)
        {{ Aire::textArea('textArea', $input['label']) }}
        @break
@endswitch