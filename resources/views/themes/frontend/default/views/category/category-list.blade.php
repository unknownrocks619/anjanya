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
                                        <a href="{{ route('frontend.category.detail', ['slug' => $category->slug]) }}">
                                            <div class="inner">
                                                <img src="{{ $image }}" alt="{{ $category->category_name }}" />
                                            </div>
                                        </a>
                                    </div>
                                    <div class="details">
                                        <ul class="meta list-inline mb-0">
                                            <li class="list-inline-item"><a href="#"><img
                                                        src="images/other/author-sm.png" class="author"
                                                        alt="author" />Katen Doe</a></li>
                                            <li class="list-inline-item">29 March 2021</li>
                                        </ul>
                                        <h5 class="post-title mb-3 mt-3">
                                            {!! $user_theme->links('category', ['category' => $category]) !!}
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
