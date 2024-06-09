@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
    if ($componentValue['layout_type'] == 'full-width') {
        $componentValue['layout_type'] = 'default';
    }
@endphp
@include('themes.frontend.siddhamahayog.components.single_image_content.types.'.$componentValue['layout_type'],['_loadComponentBuilder' => $_loadComponentBuilder])
