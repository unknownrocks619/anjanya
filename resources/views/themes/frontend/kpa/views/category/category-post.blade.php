@extends($user_theme->frontend_layout($extends))

@section('page_title')
    {{ $category->category_name }}
@endsection

@section('main')
    <!-- section main content -->
    <section class="main-content mt-0">
        <div class="container-xl">
            <div class="row mt-2">
                <div class="@if (\App\Classes\Helpers\SystemSetting::PageConfiguration('sidebar', true)) col-md-8 sidebar-content @else col-md-12 @endif">
                    <div class="row">
                        @foreach ($posts as $post)
                        
                        @php
                            $post->cat_slug = $category->slug;
                        @endphp
                            {!! $user_theme->partials('post.grid',['post' => $post]) !!}
                        @endforeach
                    </div>
                </div>
                @if (\App\Classes\Helpers\SystemSetting::PageConfiguration('sidebar', true))
                    <div class="col-md-4">
                        <div class="sidebar">
                            @foreach (\App\Classes\Helpers\SystemSetting::PageConfiguration('sidebar', true, 'additonal_text') as $widget)
                                {!! $user_theme->widget($widget) !!}
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            @include('frontend.components.lister', ['model' => $category])

        </div>
    </section>
@endsection
