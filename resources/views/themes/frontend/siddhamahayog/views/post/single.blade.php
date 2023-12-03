@php

$glittersBackground = \App\Models\GalleryAlbums::where('id',$post->glitter_background)
                                            ->where('active',true)
                                            ->with(['items' => function($query) {
                                                $query->with(['getImage' => function($query) {
                                                    $query->with('image');
                                                }])
                                                ->limit('3');
                                            }])
                                            ->first();
    $allImages = $post->getImage()->get();

    $featuredImage = $allImages->where('type','featured')->first();

    $postCategories = $post->getCategories();
@endphp

@extends($user_theme->frontend_layout($extends))

@section("page_title" ,' | '.$post->title)

@section('main')
    {!! $user_theme->partials('page-header',['title' => $post->title,'glittersBackground' => $glittersBackground]) !!}

        <div class="edu-blog-details-area edu-section-gap bg-color-white">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-10 offset-lg-1">
                        <div class="blog-details-1 style-variation3">
                            <div class="content-blog-top">

                                <div class="content-status-top d-flex flex-wrap justify-content-between mb--30 align-items-center">
                                    <div class="status-group mt_sm--10">
                                        @if(count($postCategories))
                                            <a href="#" class="eduvibe-status status-05 color-primary w-600">{{$postCategories->first()->category_name}}</a>
                                        @endif
                                    </div>
                                    <ul class="blog-meta mt_sm--10">
                                        <li><i class="icon-calendar-2-line"></i>{{ date('M d, Y') }}</li>
                                        <li><i class="icon-time-line"></i>
                                            {{App\Classes\Helpers\SystemSetting::total_readtime(strip_tags($post->full_description))}} Min Read
                                        </li>
                                    </ul>
                                </div>

                                <h4 class="title">
                                {{$post->title}}
                                </h4>

                                @if($featuredImage)
                                    <div class="thumbnail block-alignwide">
                                        <img class="radius-small w-100 mb--30" src="{{ App\Classes\Helpers\Image::getImageAsSize($featuredImage->image->filepath,'xl')}}" alt="{{$post->title}}">
                                    </div>
                                @endif
                            </div>

                            <div class="blog-main-content">
                                {!! $post->full_description !!}
                            </div>

                            <div class="blog-tag-and-share mt--50">
                                <div class="blog-tag">
                                    <div class="tag-list bg-shade">
                                        @foreach ($postCategories as $category)
                                            {!! $user_theme->links('category-link',['slug' => $category->slug,'label' => $category->category_name]) !!}
                                        @endforeach
                                    </div>
                                </div>
                                <div class="blog-share">
                                    <div class="blog-share">
                                        <div class="eduvibe-post-share">
                                            <span>Share: </span>
                                            <div class="sharethis-inline-share-buttons"></div><!-- ShareThis END -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {!! $user_theme->widget('comment') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@push('page_script')
    <script id="dsq-count-scr" src="//https-siddhamahayog-org.disqus.com/count.js" async></script>
@endpush
