@php
    $contentType = 'custom';

    if ($values->layout == 'category_content') {
        $categories = \App\Models\Category::getPosts($card_content, 5);
        $contentType = 'category_content';
    } elseif ($values->layout == 'post_content') {
        $contentType = 'post_content';
        if ($values->latest == true || empty($card_content)) {
            $posts = \App\Models\Post::where('status', 'active')
                ->orderBy('updated_at', 'desc')
                ->limit(5)
                ->get();
        } else {
            $posts = \App\Models\Post::where('status', 'active')
                ->whereIn('id', $card_content)
                ->orderBy('updated_at', 'desc')
                ->get();
        }
    } elseif ($values->layout == 'page_content') {
        $contentType = 'page_content';
        $pages = \App\Models\Page::where('active', true)
            ->whereIn('id', $card_content)
            ->get();
    }
@endphp
<div class="section-header">
    <h3 class="section-title">{{ $component->component_name }}</h3>
    <img src="{{ asset('frontend/default/images/wave.svg') }}" class="wave" alt="wave">
</div>

@if ($contentType == 'category_content')
    <div class="padding-30 rounded bordered">
        <div class="row gy-5">
            @foreach ($categories as $category)
                @php
                    $defaultFeaturedImage = $category->category_featured_image;
                    if ($category->post_intro_image) {
                        $defaultFeaturedImage = $category->post_intro_image;
                    } elseif ($category->post_featured_image) {
                        $defaultFeaturedImage = $category->post_featured_image;
                    }

                    if ($defaultFeaturedImage) {
                        $image = \App\Classes\Helpers\Image::getImageAsSize($defaultFeaturedImage, 'm');
                    } else {
                        $image = \App\Classes\Helpers\SystemSetting::logo();
                    }
                @endphp
                @if ($loop->iteration == 1)
                    <div class="col-sm-6">
                        <!-- post -->
                        <div class="post">
                            <div class="thumb rounded mt-4">
                                <a href="{{ route('frontend.category.detail', ['slug' => $category->cat_slug]) }}"
                                    class="category-badge position-absolute">{{ $category->cat_name }}</a>
                                <span class="post-format">
                                    <i class="icon-picture"></i>
                                </span>
                                <a
                                    href="{{ route('frontend.category.post', ['slug' => $category->cat_slug, 'post_slug' => $category->slug]) }}">
                                    <div class="inner">
                                        <img src="{{ $image }}" alt="{{ $category->title }}" class="w-100">
                                    </div>
                                </a>
                            </div>
                            <ul class="meta list-inline mt-4 mb-0">
                                <li class="list-inline-item"><a href="#"><img
                                            src="{{ \App\Classes\Helpers\SystemSetting::logo() }}" class="author"
                                            alt="author"
                                            style="width:25px; height:25px;">{{ \App\Classes\Helpers\SystemSetting::basic_configuration('site_name') }}</a>
                                </li>
                                <li class="list-inline-item">{{ date('M d Y', strtotime($category->created_at)) }}</li>
                            </ul>
                            <h5 class="post-title mb-3 mt-3"><a
                                    href="{{ route('frontend.category.post', ['slug' => $category->cat_slug, 'post_slug' => $category->slug]) }}">{{ $category->title }}</a>
                            </h5>
                            <p class="excerpt mb-0">{{ $category->intro_description }}</p>
                        </div>
                    </div>
                @else
                    @if ($loop->iteration == 2)
                        <div class="col-sm-6">
                    @endif
                    <!-- post -->
                    <div class="post post-list-sm square">
                        <div class="thumb rounded mt-4">
                            <a
                                href="{{ route('frontend.category.post', ['slug' => $category->cat_slug, 'post_slug' => $category->slug]) }}">
                                <div class="inner">
                                    <img src="{{ $image }}" alt="{{ $category->title }}">
                                </div>
                            </a>
                        </div>
                        <div class="details clearfix">
                            <h6 class="post-title my-0"><a
                                    href="{{ route('frontend.category.post', ['slug' => $category->cat_slug, 'post_slug' => $category->slug]) }}">{{ $category->title }}</a>
                            </h6>
                            <ul class="meta list-inline mt-1 mb-0">
                                <li class="list-inline-item">{{ date('M d Y', strtotime($category->created_at)) }}</li>
                            </ul>
                        </div>
                    </div>
                    @if ($loop->last)
        </div>
@endif
@endif
@endforeach
</div>
</div>
@endif

@if ($contentType == 'post_content')
    <div class="padding-30 rounded bordered">
        <div class="row gy-5">
            @foreach ($posts as $post)
                @php
                    $intro_image = $post
                        ->getImage()
                        ->where('type', 'intro_image')
                        ->first();
                    $featured_image = $post
                        ->getImage()
                        ->where('type', 'featured_image')
                        ->first();
                    $image = null;

                    if ($intro_image) {
                        $image = \App\Classes\Helpers\Image::getImageAsSize($intro_image->image->filepath, 'm');
                    } elseif ($featured_image) {
                        $image = \App\Classes\Helpers\Image::getImageAsSize($featured_image->image->filepath, 'm');
                    }

                    if (!$image) {
                        $image = \App\Classes\Helpers\SystemSetting::logo();
                    }
                @endphp
                @if ($loop->iteration == 1)
                    <div class="col-sm-6">
                        <!-- post -->
                        <div class="post">
                            <div class="thumb rounded mt-4">
                                @foreach ($post->getCategories() as $category)
                                    <a href="{{ route('frontend.category.detail', ['slug' => $category->slug]) }}"
                                        class="category-badge position-absolute">{{ $category->category_name }}</a>
                                @endforeach
                                <span class="post-format">
                                    <i class="icon-picture"></i>
                                </span>
                                <a
                                    href="{{ route('frontend.category.post', ['slug' => $category?->slug, 'post_slug' => $post->slug]) }}">
                                    <div class="inner">
                                        <img src="{{ $image }}" alt="{{ $post->title }}" class="w-100">
                                    </div>
                                </a>
                            </div>
                            <ul class="meta list-inline mt-4 mb-0">
                                <li class="list-inline-item"><a href="#"><img
                                            src="{{ \App\Classes\Helpers\SystemSetting::logo() }}" class="author"
                                            alt="author"
                                            style="width:25px; height:25px;">{{ \App\Classes\Helpers\SystemSetting::basic_configuration('site_name') }}</a>
                                </li>
                                <li class="list-inline-item">{{ date('M d Y', strtotime($post->created_at)) }}</li>
                            </ul>
                            <h5 class="post-title mb-3 mt-3"><a
                                    href="{{ route('frontend.category.post', ['slug' => $category?->slug, 'post_slug' => $post->slug]) }}">{{ $post->title }}</a>
                            </h5>
                            <p class="excerpt mb-0">{{ $post->intro_description }}</p>
                        </div>
                    </div>
                @else
                    @if ($loop->iteration == 2)
                        <div class="col-sm-6">
                    @endif
                    <!-- post -->
                    <div class="post post-list-sm square">
                        <div class="thumb rounded mt-4">
                            <a
                                href="{{ route('frontend.category.post', ['slug' => $post->getCategories()[0], 'post_slug' => $post->slug]) }}">
                                <div class="inner">
                                    <img src="{{ $image }}" alt="{{ $post->title }}">
                                </div>
                            </a>
                        </div>
                        <div class="details clearfix">
                            <h6 class="post-title my-0"><a
                                    href="{{ route('frontend.category.post', ['slug' => $post->getCategories()[0], 'post_slug' => $post->slug]) }}">{{ $post->title }}</a>
                            </h6>
                            <ul class="meta list-inline mt-1 mb-0">
                                <li class="list-inline-item">{{ date('M d Y', strtotime($post->created_at)) }}</li>
                            </ul>
                        </div>
                    </div>
                    @if ($loop->last)
        </div>
@endif
@endif
@endforeach
</div>
</div>
@endif
