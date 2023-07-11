@php
    $columnSize = 'col-lg-12';
    if ($component->display_location && is_array($component->display_location)) {
        $columnSize = 'col-lg-8';
    }
@endphp
@if (
    $component->active ||
        auth()->guard('admin')->check())
    <div class="my-2 @if ($component->display_location && is_array($component->display_location)) sidebar-content @endif">
        <div class="row">
            <div class="{{ $columnSize }}">
                {!! $component->values !!}
            </div>
            @if ($component->display_location && is_array($component->display_location))
                <div class="col-md-4">
                    <div class="sidebar">
                        @foreach ($component->display_location as $sidebarValue)
                            {!! $user_theme->widget($sidebarValue) !!}
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
@endif
