@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
    $attached = isset($attachable)
@endphp

@include('themes.frontend.siddhamahayog.components.video.layouts.'.$componentValue['video_layout'],['_loadComponentBuilder' => $_loadComponentBuilder,'attached' => $attached])
