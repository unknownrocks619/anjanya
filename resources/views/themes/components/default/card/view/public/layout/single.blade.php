@php
    $contentType = 'custom_content';
    
    if ($values->layout == 'category_content') {
        $categories = \App\Models\Category::getPosts($card_content, 1);
        $category = $categories[0];
        $contentType = 'category_content';
    } elseif ($values->layout == 'post_content') {
        $contentType = 'post_content';
        if ($values->latest == true || empty($card_content)) {
            $posts = [
                \App\Models\Post::where('status', 'active')
                    ->orderBy('updated_at', 'desc')
                    ->first(),
            ];
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

@if ($contentType == 'custom_content')

    <div class="row gy-4">
        @foreach ($card_content as $card_element)
            <div class="col-lg-{{ $values->size }} my-2">

                <div class="card">
                    @if ($card_element->title)
                        <div class="card-header"
                            @if ($card_element->background_color) style="background : {{ $card_element->background_color }};border:none;color:#ffffff" @else style="background:transparent;border:none" @endif>
                            <h2>{{ $card_element->title }}</h2>
                        </div>
                    @endif
                    <div class="card-body">
                        @if ($card_element->media->type == 'image')
                            <img src="{{ \App\Classes\Helpers\Image::getImageAsSize($card_element->media->images, 'm') }}"
                                class="img-fluid" />
                        @endif
                        @if ($card_element->media->type == 'video')
                            @if (isset($card_element->media->video->query->host))
                                {!! \App\Classes\Helpers\Video::renderCardVimeo($card_element->media->video->id) !!}
                            @else
                                {!! \App\Classes\Helpers\Video::renderCardYoutube($card_element->media->video->id) !!}
                            @endif
                        @endif

                        {!! htmlspecialchars_decode($card_element->body) !!}
                    </div>
                    @if (isset($card_element->footer->label) && $card_element->footer->label != '')
                        <div class="card-footer d-flex justify-content-{{ $card_element->footer->position }}"
                            style="border: none; background: transparent">
                            <a href='{{ $card_element->footer->link }}'>{!! htmlspecialchars_decode($card_element->footer->label) !!}</a>
                        </div>
                    @endif
                </div>

            </div>
        @endforeach
    </div>
@endif

@if ($contentType == 'category_content')
    <section id="hero" class="my-3">
        <div class="container-xl my-4">
            <div class="row gy-4">
                <div class="col-lg-12">
                    <!-- featured post large -->
                    <div class="post featured-post-lg">
                        <div class="details clearfix">
                            <a href="{{ route('frontend.category.detail', ['slug' => $category->cat_slug]) }}"
                                class="category-badge">{{ $category->cat_name }}</a>
                            <h2 class="post-title">
                                <a
                                    href="{{ route('frontend.category.post', ['slug' => $category->cat_slug, 'post_slug' => $category->slug]) }}">{{ $category->title }}</a>
                            </h2>
                            <ul class="meta list-inline mb-0">
                                <li class="list-inline-item"><a
                                        href="#">{{ \App\Classes\Helpers\SystemSetting::basic_configuration('site_name') }}</a>
                                </li>
                                <li class="list-inline-item">{{ date('M d Y', strtotime($category->created_at)) }}</li>
                            </ul>
                        </div>
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
                        <a href="">
                            <div class="thumb rounded">
                                <div class="inner data-bg-image" data-bg-image="{{ $image }}"
                                    style="background-image: url(&quot;{{ $image }}&quot;);"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif


@if ($contentType == 'post_content')
    <section id="hero" class="my-4">
        <div class="container-xl my-4">
            <div class="row gy-4">
                @foreach ($posts as $post)
                    <div class="col-lg-12">
                        <!-- featured post large -->
                        <div class="post featured-post-lg">
                            <div class="details clearfix">
                                @foreach ($post->getCategories() as $category)
                                    <a href="{{ route('frontend.category.detail', ['slug' => $category->slug]) }}"
                                        class="category-badge">{{ $category->category_name }}</a>
                                @endforeach
                                <h2 class="post-title">
                                    <a
                                        href="{{ route('frontend.category.post', ['slug' => $category?->slug, 'post_slug' => $post->slug]) }}">{{ $post->title }}</a>
                                </h2>
                                <ul class="meta list-inline mb-0">
                                    <li class="list-inline-item"><a
                                            href="#">{{ \App\Classes\Helpers\SystemSetting::basic_configuration('site_name') }}</a>
                                    </li>
                                    <li class="list-inline-item">{{ date('Y-m-d', strtotime($post->created_at)) }}</li>
                                </ul>
                            </div>
                            @php
                                $image = \App\Classes\Helpers\SystemSetting::logo();
                                $images = $post
                                    ->getImage()
                                    ->where('type', 'intro_image')
                                    ->first();
                                
                                if (!$images) {
                                    $images = $post
                                        ->getImage()
                                        ->where('type', 'featured_image')
                                        ->first();
                                }
                                
                                if ($images) {
                                    $image = \App\Classes\Helpers\Image::getImageAsSize($images->image->filepath, 'm');
                                }
                                
                            @endphp
                            <a href="">
                                <div class="thumb rounded">
                                    <div class="inner data-bg-image" data-bg-image="{{ $image }}"
                                        style="background-image: url(&quot;{{ $image }}&quot;);"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

@if ($contentType == 'page_content')
    <section id="hero" class="my-4">
        <div class="container-xl my-4">
            <div class="row gy-4">
                @foreach ($pages as $page)
                    <div class="col-lg-12">
                        <!-- featured post large -->
                        <div class="post featured-post-lg">
                            <div class="details clearfix">
                                <h2 class="post-title">
                                    <a
                                        href="{{ route('frontend.pages.page', ['slug' => $page->slug]) }}">{{ $page->title }}</a>
                                </h2>
                                <ul class="meta list-inline mb-0">
                                    <li class="list-inline-item"><a
                                            href="#">{{ \App\Classes\Helpers\SystemSetting::basic_configuration('site_name') }}</a>
                                    </li>
                                    <li class="list-inline-item">{{ date('Y-m-d', strtotime($page->created_at)) }}</li>
                                </ul>
                            </div>
                            @php
                                $image = \App\Classes\Helpers\SystemSetting::logo();
                                $images = $page
                                    ->getImage()
                                    ->where('type', 'intro_image')
                                    ->first();
                                
                                if (!$images) {
                                    $images = $page
                                        ->getImage()
                                        ->where('type', 'featured_image')
                                        ->first();
                                }
                                
                                if ($images) {
                                    $image = \App\Classes\Helpers\Image::getImageAsSize($images->image->filepath, 'm');
                                }
                                
                            @endphp
                            <a href="">
                                <div class="thumb rounded">
                                    <div class="inner data-bg-image" data-bg-image="{{ $image }}"
                                        style="background-image: url(&quot;{{ $image }}&quot;);"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
