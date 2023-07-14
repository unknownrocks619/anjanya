@extends($user_theme->frontend_layout($extends))

@section('page_title')
    | {{ $menu->menu_name }}
@endsection

@section('main')
    <!-- section main content -->
    <section class="main-content mt-0">
        <div class="container-xl">
            <div class="row mt-2">
                <div class="@if (\App\Classes\Helpers\SystemSetting::PageConfiguration('sidebar', true)) col-md-8 sidebar-content @else col-md-12 @endif">
                    <div class="row">
                        @foreach ($categories as $category)
                            <div class="col-6 my-3">
                                @php
                                    $image = \App\Classes\Helpers\SystemSetting::logo();
                                    
                                    $categoryImage = $category
                                        ->getImage()
                                        ->where('type', 'featured_image')
                                        ->latest()
                                        ->first();
                                    
                                    if ($categoryImage) {
                                        $featuredImage = $categoryImage->image;
                                        if ($featuredImage) {
                                            $image = \App\Classes\Helpers\Image::getImageAsSize($featuredImage->filepath, 'm');
                                        }
                                    }
                                @endphp
                                <!-- post -->
                                <div class="post post-grid rounded bordered">
                                    <div class="thumb top-rounded">

                                        <img src="{{ $image }}" alt="{{ $category->category_name }}" />
                                    </div>
                                    <div class="details">
                                        <h5 class="post-title mb-0 mt-4">
                                            {!! $user_theme->links('category-link', ['category' => $category]) !!}

                                        </h5>
                                        @if ($category->full_description)
                                            <div class="excerpt mb-0">
                                                {!! $category->full_description !!}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="post-bottom clearfix d-flex align-items-center">
                                        <div class="more-button float-end">

                                            <a class="btn btn-default text-white"
                                                href="{{ route('frontend.category.detail', ['slug' => $category->slug]) }}">View
                                                Category</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
        </div>
    </section>
@endsection
