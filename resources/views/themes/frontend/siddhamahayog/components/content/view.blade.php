@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp

@include('themes.frontend.siddhamahayog.components.content.layout.'.$componentValue['layout_type'],['_loadComponentBuilder' => $_loadComponentBuilder])
