@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
    $categories = [];
    $posts = [];
    if ( empty($componentValue['data']) ) {
        $getLatestPost = \App\Models\Post::where('status','active')->orderBy('created_at','desc')->limit(15)->get();
        foreach ($getLatestPost as $post) {
            $categories = array_merge($categories ,array_keys($post->getCategories()->keyBy('id')->toArray()));
        }
    } else {
        $categories = $componentValue['data'];
    }
    $posts = \App\Models\Category::getPosts($categories);
    $postIds = [];
@endphp

<section class="hero-carousel my-1">
    <div class="row post-carousel-featured post-carousel">
        <!-- post -->
        @foreach ($posts as $category)
            @php
                if (in_array($category->post_id, $postIds)) {
                    continue;
                }

                if (count($postIds) > 15 ) {
                    break;
                }
                $postIds[] = $category->post_id;

                $image = $category->category_featured_image;

                if ($category->post_featured_image) {
                    $image = $category->post_featured_image;
                }

                if ($category->post_intro_image) {
                    $image = $category->post_intro_image;
                }

                if ($image) {
                    $image = \App\Classes\Helpers\Image::getImageAsSize($image, 'm');
                } else {
                    $image = \App\Classes\Helpers\SystemSetting::logo();
                }
            @endphp
            <div class="post featured-post-md">
                <div class="details clearfix">
                    <a href="{{ route('frontend.category.detail', ['slug' => $category->cat_slug]) }}"
                       class="category-badge">{{ $category->cat_name }}</a>
                    <a href="{{ route('frontend.category.post-type', ['post_type' => $category->type]) }}"
                       class="category-badge">{{ ucwords($category->type) }}</a>
                    <h4 class="post-title"><a
                            href="{{ route('frontend.category.post', ['slug' => $category->cat_slug, 'post_slug' => $category->post_slug]) }}">{{ $category->title }}</a>
                    </h4>
                    <ul class="meta list-inline mb-0">
                        <li class="list-inline-item"><a
                                href="#">{{ \App\Classes\Helpers\SystemSetting::basic_configuration('site_name') }}</a>
                        </li>
                        <li class="list-inline-item">
                            {{ date('Y-m-d', strtotime($category->created_at)) }}
                        </li>
                    </ul>
                </div>
                <a
                    href="{{ route('frontend.category.post', ['slug' => $category->cat_slug, 'post_slug' => $category->post_slug]) }}">
                    <div class="thumb rounded">

                        <div class="inner data-bg-image" data-bg-image="{{ $image }}"></div>
                    </div>
                </a>
            </div>
        @endforeach
        <!-- post -->
    </div>
</section>
