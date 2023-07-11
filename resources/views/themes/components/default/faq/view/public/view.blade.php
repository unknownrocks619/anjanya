@if (isset($values->layout))
    @include('themes.components.default.faq.view.public.layouts.' . $values->layout, ['values' => $values])
@endif
