<div class="widget rounded">
    <div class="widget-header text-center">
        <h3 class="widget-title">Latest Posts</h3>
        <img src="{{ asset('images/wave.svg') }}" class="wave" alt="wave" />
    </div>
    <div class="widget-content">
        <div class="post-carousel-widget">
            <!-- post -->
            @foreach (\App\Models\Post::latestPost() as $latestPost)
                <div class="post post-carousel">
                    <div class="thumb rounded">
                        @foreach ($latestPost->getCategories() as $postCategory)
                            <a href="category.html"
                                class="category-badge position-absolute">{{ $postCategory->category_name }}</a>
                        @endforeach
                        <a href="blog-single.html">
                            <div class="inner">
                                <img src="images/widgets/widget-carousel-1.jpg" alt="post-title" />
                            </div>
                        </a>
                    </div>
                    <h5 class="post-title mb-0 mt-4"><a href="blog-single.html">{{ $latestPost->title }}</a></h5>
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
