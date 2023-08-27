@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
    $posts = [];

    if ($componentValue['latest_post'] == true || empty ($componentValue['data'])) {
        $posts = \App\Models\Post::where('status','active')
                                    ->latest()
                                    ->with(['getImage.image'])
                                    ->limit(15)
                                    ->get();
    } else {
        $posts = \App\Models\Post::where('status','active')
                                    ->with(['getImage.image'])
                                    ->whereIn('id',$componentValue['data'])
                                    ->orderBy('created_at','desc')
                                    ->get();
    }
@endphp
    <section class="hero-carousel my-1">
        <div class="row post-carousel-featured post-carousel">
            @foreach ($posts as $post)
                <!-- post -->
                @php
                    $image = null;
                    $categoryText = null;
                    $category = null;

                    $image = $post->getImage()->where('type','intro_image')->first();
                    if (! $image ) {
                        $image = $post->getImage()->where('type','featured_image')->first();
                    }

                    if ( $image) {
                        $image = \App\Classes\Helpers\Image::getImageAsSize($image->image->filepath, 'm');
                    } else {
                        $image = \App\Classes\Helpers\SystemSetting::logo();
                    }

                    $category = $post->getCategories();
                    if ( count ($category) ) {
                        $category = $category?->first();
                        $categoryText = $category?->first()?->slug;
                    } else {
                        $categoryText = null;
                    }
                @endphp
                <div class="post featured-post-md">
                    <div class="details clearfix">
                        @if ($categoryText)

                        <a href="{{ route('frontend.category.detail', ['slug' => $category?->slug]) }}"
                           class="category-badge">{{ $category?->category_name?? 'Uncategorized' }}</a>
                        <a href="{{ route('frontend.category.post-type', ['post_type' => $post->type]) }}"
                           class="category-badge">{{ ucwords($post->type) }}</a>
                        @endif
                        <h4 class="post-title"><a
                                href="{{ route('frontend.category.post', ['slug' => $category?->slug ?? 'uncategorized', 'post_slug' => $post->slug]) }}">{{ $post->title }}</a>
                        </h4>
                        <ul class="meta list-inline mb-0">
                            <li class="list-inline-item"><a
                                    href="#">{{ \App\Classes\Helpers\SystemSetting::basic_configuration('site_name') }}</a>
                            </li>
                            <li class="list-inline-item">
                                {{ date('Y-m-d', strtotime($post->created_at)) }}
                            </li>
                        </ul>
                    </div>
                    <a
                        href="{{ route('frontend.category.post', ['slug' => $category?->slug ?? 'uncategorized', 'post_slug' => $post->slug]) }}">
                        <div class="thumb rounded">

                            <div class="inner data-bg-image" data-bg-image="{{ $image }}"></div>
                        </div>
                    </a>
                </div>
          @endforeach
        <!-- post -->
        </div>
    </section>
