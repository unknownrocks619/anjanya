<div class="widget rounded">
    <div class="widget-header text-center">
        <h3 class="widget-title">Latest Posts</h3>
        <img src="{{ asset('images/wave.svg') }}" class="wave" alt="wave" />
    </div>
    <div class="widget-content">
        <div class="post-carousel-widget">
            <!-- post -->
            @foreach (\App\Models\Post::latestPost() as $latestPost)
                @php
                    $postImage = $latestPost
                        ->getImage()
                        ->where('type', 'intro_image')
                        ->first();
                    
                    if (!$postImage) {
                        $postImage = $latestPost
                            ->getImage()
                            ->where('type', 'featured_image')
                            ->first();
                    }
                    
                    if ($postImage) {
                        $image = \App\Classes\Helpers\Image::getImageAsSize($postImage->image->filepath, 'm');
                        $width = false;
                    } else {
                        $image = \App\Classes\Helpers\SystemSetting::logo();
                        $width = true;
                    }
                    
                @endphp

                <div class="post post-carousel">
                    <div class="thumb rounded">
                        @foreach ($latestPost->getCategories() as $postCategory)
                            <a href="category.html"
                                class="category-badge position-absolute">{{ $postCategory->category_name }}</a>
                        @endforeach
                        <a href="blog-single.html">
                            <div class="inner">
                                <img src="{{ $image }}" alt="{{ $latestPost->title }}"
                                    @if ($width) class="w-50" @endif />
                            </div>
                        </a>
                    </div>
                    <h5 class="post-title mb-0 mt-4"><a
                            href="{{ route('frontend.category.post', ['slug' => $postCategory, 'post_slug' => $latestPost->slug]) }}">{{ $latestPost->title }}</a>
                    </h5>
                    <ul class="meta list-inline mt-2 mb-0">
                        <li class="list-inline-item"><a href="#">
                                {{ \App\Classes\Helpers\SystemSetting::basic_configuration('site_name') }}</a></li>
                        <li class="list-inline-item">{{ date('d m Y', strtotime($latestPost->created_at)) }}</li>
                    </ul>
                </div>
            @endforeach
            <!-- post -->
        </div>
        <!-- carousel arrows -->
        <div class="slick-arrows-bot">
            <button type="button" data-role="none" class="carousel-botNav-prev slick-custom-buttons"
                aria-label="Previous"><i class="icon-arrow-left"></i></button>
            <button type="button" data-role="none" class="carousel-botNav-next slick-custom-buttons"
                aria-label="Next"><i class="icon-arrow-right"></i></button>
        </div>
    </div>
</div>
