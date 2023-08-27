@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
    $view = 'slider';
    if ($componentValue['type'] == 'category') {
        $view = 'category';
    } elseif($componentValue['type'] == 'post') {
        $view = 'post';
    }
@endphp
{!! $user_theme->components('slider.type.'.$view,['_loadComponentBuilder' => $_loadComponentBuilder]) !!}
