@php /** @var  \App\Models\Post $post */ @endphp
<aside class="widget widget_latest_post widget-post-thumb">
    <h3 class="widget-title">Recent Post</h3>
    <ul>

        @foreach (\App\Models\Post::recentPost() as $recentPost)
            @continue($recentPost->getKey() == $post->getKey())
            @php
                $category = 'uncategorized';
                $getCategories = $recentPost->getCategories();
                if ($getCategories->count()) {
                    $category = $getCategories->first()?->slug;
                }
                $image = $recentPost->getImage()->where('type','intro_image')->first() ?? $recentPost->getImage()->where('type','featured_image')->first();

                if ($image) {
                    $image = \App\Classes\Helpers\Image::getImageAsSize($image->image->filepath,'m');
                } else {
                    $image = \App\Classes\Helpers\SystemSetting::logo();
                }

            @endphp
        <li>
            <figure class="post-thumb">
                <a href="{{route('frontend.category.post',['slug'=>$category,'post_slug' => $recentPost->slug])}}"><img src="{{$image}}" alt="{{$recentPost->title}}"></a>
            </figure>
            <div class="post-content">
                <h5>
                    <a href="{{route('frontend.category.post',['slug'=>$category,'post_slug' => $recentPost->slug])}}">{{$recentPost->title}}</a>
                </h5>
                <div class="entry-meta">
                     <span class="posted-on">
                        <a href="{{route('frontend.category.post',['slug'=>$category,'post_slug' => $recentPost->slug])}}">{{ date("F d, Y", strtotime($recentPost->created_at)) }}</a>
                     </span>
                    <span class="comments-link">
                        <a href="{{route('frontend.category.post',['slug'=>$category,'post_slug' => $recentPost->slug])}}">Read More</a>
                     </span>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
</aside>
