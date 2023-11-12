@php
    /** @var array $page */

    $pageQuery = \App\Models\Page::where('active',true)->with(['getImage' => function($query) {
        return $query->with('image');
    }]);

    if (! $page['latest'] ) {
        $pages = $pageQuery->whereIn('id',$page['ids'])->get();
    } else {
        $pages = $pageQuery->orderBy('id','DESC')->limit(6)->get();
    }
@endphp
<div class="row">
    @foreach ($pages as $row)
        <div class="col-md-6 col-lg-4">
            <article class="post">
                @php
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
                        <a href="{{route('frontend.pages.page',['slug' => $row->slug])}}" title="{{$row->title}}">
                            <img src="{{$image}}" alt="{{$row->title}}">
                        </a>
                    </figure>
                @endif
                <div class="entry-content">
                    <h4>
                        <a href="{{route('frontend.pages.page',['slug' => $row->slug])}}" title="{{$row->title}}">
                            {{$row->title}}
                        </a>
                    </h4>
                </div>
                <div class="entry-meta">
                     <span class="posted-on">
                        <a href="{{route('frontend.pages.page',['slug' => $row->slug])}}">
                            {{date('M d, Y', strtotime($row->updated_at))}}
                        </a>
                     </span>
                </div>
            </article>
        </div>
    @endforeach

</div>
