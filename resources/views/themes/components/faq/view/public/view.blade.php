@if (isset($values->layout))
    @include('themes.components.faq.view.public.layouts.' . $values->layout, ['values' => $values])
@endif
