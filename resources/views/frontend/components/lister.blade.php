<?php
// first model is needed.
$model->load([
    'getComponents' => function ($query) {
        $query->with(['getImage']);
    },
]);
$components = $model->getComponents;
?>

@if ($components && $components->count())
    @foreach ($components as $component)
        @if (
            \View::exists(
                'themes.components.' . $user_theme->theme_name() . '.' . $component->component_type . '.view.public.view'))
            @include(
                'themes.components.' .
                    $user_theme->theme_name() .
                    '.' .
                    $component->component_type .
                    '.view.public.view',
                [
                    'component' => $component,
                    'values' => json_decode($component->values),
                ]
            )
        @else
            @include('themes.components.' . $component->component_type . '.view.public.view', [
                'component' => $component,
                'values' => json_decode($component->values),
            ])
        @endif
    @endforeach
@endif
