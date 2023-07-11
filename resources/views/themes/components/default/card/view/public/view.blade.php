@php
    $containerSize = 'container-fluid';
    $card_content = $values->card_content;
    $layout = $values->display_type ?? 'default';
    $columnSize = 'col-lg-12';
    if ($component->display_location && is_array($component->display_location)) {
        $columnSize = 'col-lg-8';
        $containerSize = 'container-xl';
    }
@endphp
@if (
    $component->active ||
        auth()->guard('admin')->check())
    <div class="image-card-section">
        <div class="container-fluid">
            @if ($component->display_location && is_array($component->display_location))
                <div data-sidebar="{{ str($component->component_name)->slug('-') }}_{{ $component->getKey() }}"
                    class="{{ $containerSize }} @if ($component->display_location && is_array($component->display_location)) sidebar-content @endif {{ str($component->component_name)->slug('-') }}_{{ $component->getKey() }}">
                    <div class="row gy-4">

                        <div class="{{ $columnSize }}">
            @endif
            @include('themes.components.default.card.view.public.layout.' . $layout, [
                'card_content' => $card_content,
                'values' => $values,
            ])

            @if ($component->display_location && is_array($component->display_location))
        </div>
        <div class="col-md-4">
            <div class="sidebar"
                data-parent="{{ str($component->component_name)->slug('-') }}_{{ $component->getKey() }}">
                @foreach ($component->display_location as $sidebarValue)
                    {!! $user_theme->widget($sidebarValue) !!}
                @endforeach
            </div>
        </div>

    </div>
    </div>
@endif

</div>
</div>
@endif
