@php
    $componentValue = $_loadComponentBuilder->values;
@endphp

{!! $user_theme->components('slider.layout.' . $componentValue['layout'], [
    'type' => $componentValue['type'],
    'value' => $componentValue['value'],
    'buttons' => $componentValue['buttons'],
    'latest' => $componentValue['latest'],
]) !!}
