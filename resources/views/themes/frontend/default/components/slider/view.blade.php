@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
    $view = 'slider';
    if (isset($componentValue['type']) && $componentValue['type'] == 'category') {
        $view = 'category';
    } elseif(isset($componentValue['type']) && $componentValue['type'] == 'post') {
        $view = 'post';
    }
@endphp
{!! $user_theme->components('slider.type.'.$view,['_loadComponentBuilder' => $_loadComponentBuilder]) !!}
