@php
    if (isset($currentPost) ) {
        $posts = App\Models\Post::recentPost($currentPost);
    } else {
        $posts = App\Models\Post::recentPost();
    }
@endphp
<div class="rts-single-wized Recent-post">
    <div class="wized-header">
        <h5 class="title">
            Recent Posts
        </h5>
    </div>
    <div class="wized-body">
        @foreach ($posts as $post)
            @php
                $featuredImage = $post->getImage()->where('type','featured_image')->latest()->first();

                if ( ! $featuredImage ) {
                    $featuredImage = $post->getImage()->where('type','intro_image')->latest()->first();
                }
                if ( $featuredImage) {
                    $featuredImage = App\Classes\Helpers\Image::getImageAsSize($featuredImage->image->filepath,'s');
                } else {
                    $featuredImage = \App\Classes\Helpers\SystemSetting::logo();
                }
                $category = App\Models\Category::whereIn('id',$post->categories)->first();
            @endphp
        <!-- recent-post -->
        <div class="recent-post-single">
            <div class="thumbnail">
                <a href="#"><img src="{{$featuredImage}}" alt="{{$post->title}}"></a>
            </div>
            <div class="content-area">
                <div class="user">
                    <i class="fal fa-clock"></i>
                    <span>{{ date('d M, Y', strtotime($post->updated_at)) }}</span>
                </div>
                <a class="post-title" href="{{ route('frontend.category.post', ['slug' => $category->slug ?? 'uncategorized', 'post_slug' => $post->slug]) }}">
                    <h6 class="title">{{$post->title}}</h6>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
