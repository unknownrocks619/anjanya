@php
$featuredImage = $post->getImage()->where('type','featured_image')->latest()->first();

if ( ! $featuredImage ) {
    $featuredImage = $post->getImage()->where('type','intro_image')->latest()->first();
}
if ( $featuredImage) {
    $featuredImage = App\Classes\Helpers\Image::getImageAsSize($featuredImage->image->filepath,'m');
}

@endphp
@extends($user_theme->frontend_layout($extends))
@section("page_title"){{$post->title}}@endsection

@section('main')
    {{$user_theme->partials('post.cover',['post' => $post,'category' => $category])}}
        <!-- rts blog mlist area -->
        <div class="rts-blog-list-area rts-section-gap">
            <div class="container">
                <div class="row g-5">
                    <!-- rts blo post area -->
                    <div class="col-xl-8 col-md-12 col-sm-12 col-12">
                        <!-- single post -->
                        <div class="blog-single-post-listing details mb--0">
                            @if ( $featuredImage)
                                <div class="thumbnail">
                                    <img src="{{$featuredImage}}" alt="{{$post->title}}" style="max-height: 485px;">
                                </div>
                            @endif
                            <div class="blog-listing-content">
                                <h3 class="title">{{$post->title}}</h3>
                                <div class="disc">
                                    {!! $post->full_description !!}
                                </div>
                            </div>
                        </div>
                        <!-- single post End-->

                        @include('frontend.components.lister', ['model' => $post])

                    </div>

                    <!--rts blog wizered area -->
                    <div class="col-xl-4 col-md-12 col-sm-12 col-12">
                       
                        <!-- single wizered End -->
                        <!-- single wizered start -->
                        {!! $user_theme->widget('categories') !!}
                        {!! $user_theme->widget('recent-post') !!}
                        {!! $user_theme->widget('contact-card') !!}
                    </div>
                    <!-- rts- blog wizered end area -->
                </div>
            </div>
        </div>
        <!-- rts blog mlist area End -->
    
@endsection