@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp
@include('themes.frontend.nature.components.background_video.types.'.$componentValue['layout_type'],['componentValue' => $componentValue]);
{{--@if($componentValue['enquiry_form'])--}}
{{--    @include('themes.frontend.nature.components.background_image.types.enquiry-form',['componentValue' => $componentValue])--}}
{{--@elseif( $componentValue['video_link'] && $componentValue['video_poster'])--}}
{{--    @include('themes.frontend.nature.components.background_image.types.video',['componentValue' => $componentValue])--}}
{{--@else--}}
{{--    @include('themes.frontend.nature.components.background_image.types.single',['componentValue' => $componentValue])--}}
{{--@endif--}}
