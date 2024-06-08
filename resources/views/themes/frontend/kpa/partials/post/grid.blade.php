@php
    $createdDate = strtotime($post->created_at);
@endphp
<div class="col-lg-4 col-md-6 col-sm-12 col-12">
    <!-- start blog grid inner -->
    <div class="blog-grid-inner">
        <div class="blog-header">
            <a class="thumbnail text-center" href="blog-details.html" class="text-align">
                <img style="max-height: 340px;max-width:395px;" src="{{(($post->post_featured_image) ? $post->post_featured_image : ( ($post->post_intro_image) ? $post->post_intro_image : ($post->category_featured_image ?? \App\Classes\Helpers\SystemSetting::logo()) ))}}" alt="{{$post->title}}">
            </a>
            <div class="blog-info">
                <div class="user">
                    <i class="fal fa-tags"></i>
                    <span>{{$post->cat_name}}</span>
                </div>
            </div>
            <div class="date">
                <h6 class="title">{{date('d',$createdDate)}}</h6>
                <span>{{date('M',$createdDate)}}</span>
            </div>
        </div>
        <div class="blog-body">
            <a href="{{ route('frontend.category.post', ['slug' => ($post?->cat_slug) ? $post?->cat_slug : ($post->slug ?? 'uncategorized'), 'post_slug' => $post->slug]) }}">
                <h5 class="title">{{$post->title}}
                </h5>
            </a>
        </div>
    </div>
    <!-- end blog grid inner -->
</div>
