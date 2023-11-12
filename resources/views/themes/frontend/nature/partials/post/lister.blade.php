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
            $image  = \App\Classes\Helpers\Image::getImageAsSize($post->post_intro_iamge,'m');
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
<div class="grid-item col-md-6">

    <article class="post">
        <figure class="feature-image">
            <a href="{{route('frontend.category.post',['slug' => $post->cat_slug ?? $category->slug,'post_slug' => $post->slug]) }}">
                <img src="{{$image}}" alt="{{$post->title}}">
            </a>
            <span class="cat-meta">
               <a href="{{ route('frontend.category.detail',['slug' => $post->cat_slug ?? $category->slug]) }}">{{$post->cat_name ?? $category->category_name}}</a>
            </span>
        </figure>
        <div class="entry-content">
            <h4>
                <a href="{{route('frontend.category.post',['slug' => $post->cat_slug ?? $category->slug,'post_slug' => $post->slug])}}">
                    {{$post->title}}
                </a>
            </h4>
            <div>
                {!! $post->intro_description !!}
            </div>
        </div>
        <div class="entry-meta">
            <span class="posted-on">
                <a href="{{route('frontend.category.detail',['slug' => $post->cat_slug ?? $category->slug,'post_slug' => $post->slug])}}">
                    {{date('F d, Y',strtotime($post->created_at))}}
                </a>
            </span>
        </div>
    </article>
</div>
