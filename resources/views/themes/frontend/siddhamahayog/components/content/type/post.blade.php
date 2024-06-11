@php
    /** @var array $post */

    $postQuery = \App\Models\Post::where('status','active')->with(['getImage' => function($query) {
        return $query->with('image');
    }]);

    if (! $post['latest'] ) {
        $posts = $postQuery->whereIn('id',$post['ids'])->get();
    } else {
        $posts = $postQuery->orderBy('id','DESC')->limit(6)->get();
    }
@endphp
<div class="row">
    @foreach ($posts as $row)
        <div class="col-md-6 col-lg-4">
            <article class="post">
                @php
                    $category = 'uncategorized';
                    $categoryName = 'Uncategorized';
                    $categories = $row->getCategories();
                    if ($categories->count() ) {
                        $category = ($categories->first())?->slug;
                        $categoryName = ($categories->first())?->category_name;
                    }
                    $image = $row->getImage()->where('type','intro_image')->first();
                    if ( ! $image) {
                        $image = $row->getImage()->where('type','featured_image')->first();
                    }

                    if (  $image ) {
                        $image = \App\Classes\Helpers\Image::getImageAsSize($image->image->filepath,'m');
                    }

                @endphp
                @if($image)
                    <figure class="feature-image">
                        <a href="{{route('frontend.category.post',['slug' => $category,'post_slug' => $row->slug])}}" title="{{$row->title}}">
                            <img src="{{$image}}" alt="{{$row->title}}">
                        </a>
                        <span class="cat-meta">
                            <a href="{{route('frontend.category.detail',['slug' => $category])}}">{{strtoupper($categoryName)}}</a>
                         </span>
                    </figure>
                @endif
                <div class="entry-content">
                    <h4>
                        <a href="{{route('frontend.category.post',['slug' => $category,'post_slug' => $row->slug])}}" title="{{$row->title}}">
                            {{$row->title}}
                        </a>
                    </h4>
                </div>
                <div class="entry-meta">
                     <span class="posted-on">
                        <a href="{{route('frontend.category.post',['slug' => $category,'post_slug' => $row->slug])}}">
                            {{date('M d, Y', strtotime($row->updated_at))}}
                        </a>
                     </span>
                </div>
            </article>
        </div>
    @endforeach

</div>
