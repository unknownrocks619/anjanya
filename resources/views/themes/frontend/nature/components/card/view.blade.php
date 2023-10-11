@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp
@isset($attachable)
    @include('themes.frontend.nature.components.card.type.attachable',['_loadComponentBuilder' => $_loadComponentBuilder])
@else
    @include('themes.frontend.nature.components.card.type.default',['_loadComponentBuilder' => $_loadComponentBuilder])
@endisset
