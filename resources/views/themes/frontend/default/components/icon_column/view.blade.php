@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp
{!! $user_theme->components('icon_column.types.'.$componentValue['position'],['_loadComponentBuilder' => $_loadComponentBuilder]) !!}
