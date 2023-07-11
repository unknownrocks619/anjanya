@php
    $containerSize = $values->display_type ?? 'container';
    $posts = [];
    if ($values->block_type == 'posts') {
        $postQuery = \App\Models\Post::where('status', 'active');
    
        if ($values->latest_posts) {
            $postQuery->orderBy('updated_at', 'desc');
        }
    
        $posts = $postQuery->paginate(10);
    }
    
    if ($values->block_type == 'categories') {
    }
    
    if ($values->block_type == 'pages') {
    }
    
    $columnSize = 'col-lg-12';
    if ($component->display_location && is_array($component->display_location)) {
        $columnSize = 'col-lg-8';
    }
@endphp
@if (
    $component->active ||
        auth()->guard('admin')->check())
    <section class=" mt-5">
        <div data-sidebar="{{ str($component->component_name)->slug('-') }}_{{ $component->getKey() }}"
            class="{{ $containerSize }} @if ($component->display_location && is_array($component->display_location)) sidebar-content @endif {{ str($component->component_name)->slug('-') }}_{{ $component->getKey() }}">
            <div class="row gy-4">

                <div class="{{ $columnSize }}">
                    @if ($values->block_type == 'posts')
                        <div class="row gy-4">
                            @include('themes.components.default.block.view.public.posts', [
                                'posts' => $posts,
                                'values' => $values,
                            ])
                        </div>
                    @endif

                </div>

                @if ($component->display_location && is_array($component->display_location))
                    <div class="col-md-4">
                        <div class="sidebar"
                            data-parent="{{ str($component->component_name)->slug('-') }}_{{ $component->getKey() }}">
                            @foreach ($component->display_location as $sidebarValue)
                                {!! $user_theme->widget($sidebarValue) !!}
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center">{{ $posts->links() }}</div>
            </div>

        </div>
    </section>
@endif
