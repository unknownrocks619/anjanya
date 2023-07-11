@if (isset($values->layout))
    @include('themes.components.icon_column.view.public.layouts.' . $values->layout, ['values' => $values])
@endif
