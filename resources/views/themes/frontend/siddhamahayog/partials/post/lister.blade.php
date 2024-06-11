@php /** @var \App\Models\Post $post */@endphp
@php /** @var \App\Models\Category $category */@endphp

@php

    # This is just plain model,
    if (  $post instanceof \App\Models\Post) {
        $image = $post->getImage()->where('type','intro_image')->first() ?? $post->getImage()->where('type','featured_image')->first();

        if ($image) {
            $image = \App\Classes\Helpers\Image::getImageAsSize($image->image->filepath,'m');
        }

    } else {

        if ($post->post_featured_image) {
            $image = \App\Classes\Helpers\Image::getImageAsSize($post->post_featured_image,'m');
        }

        if ( ! $post->post_featured_image && $post->post_intro_image) {
            $image  = \App\Classes\Helpers\Image::getImageAsSize($post->post_intro_image,'m');
        }

        if (! isset ($image) && $post->category_featured_image ) {
            $image = \App\Classes\Helpers\Image::getImageAsSize($post->category_featured_image,'m');
        }
    }

    if ( ! isset($image) ||  ! $image ) {
        $image = $category->getImage()->where('type','featured')->first();

        if ($image) {
            $image = \App\Classes\Helpers\Image::getImageAsSize($image->image->filepath,'m');
        }
    }


    if ( ! isset ($image) ||  ! $image ) {
        $image = \App\Classes\Helpers\SystemSetting::logo();
    }

@endphp


<div class="edu-blog blog-type-2 variation-2 radius-small bg-color-gray">
    <div class="inner">
        <div class="thumbnail">
            <a href="{{route('frontend.category.post',['slug' => $post->cat_slug ?? $category->slug,'post_slug' => $post->slug]) }}">
                <img src="{{$image}}" alt="{{$post->title}}" />
            </a>
        </div>
        <div class="content">

            <div class="blog-date-status">
                <span class="day">{{date("d",strtotime($post->created_at))}}</span>
                <span class="month">{{date('M', strtotime($post->created_at))}}</span>
            </div>

            <div class="status-group status-style-5">

                <a class="eduvibe-status status-05" href="#">
                    <i class="icon-price-tag-3-line"></i>
                    {{$post->cat_name ?? $category->category_name}}
                </a>

                <span class="eduvibe-status status-05">
                    <i class="icon-time-line"></i> 
                    {{App\Classes\Helpers\SystemSetting::total_readtime(strip_tags($post->full_description))}} Min Read
                </span>

            </div>

            <h5 class="title">
                <a href="{{route('frontend.category.post',['slug' => $post->cat_slug ?? $category->slug,'post_slug' => $post->slug])}}">
                    {{$post->title}}
                </a>
            </h5>
        </div>
    </div>
</div>