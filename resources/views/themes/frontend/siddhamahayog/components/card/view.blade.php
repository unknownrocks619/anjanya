@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp

@include('themes.frontend.siddhamahayog.components.card.layouts.'.$componentValue['card_layout'],['_loadComponentBuilder' => $_loadComponentBuilder])
