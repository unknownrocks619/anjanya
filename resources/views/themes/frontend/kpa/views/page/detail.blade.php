@php
    $bannerImage = $page->getImage->where('type','banner_image')->first();
    if ( $bannerImage) {
        $bannerImage = App\Classes\Helpers\Image::getImageAsSize($bannerImage->image->filepath,'m');
    }  else {
        $bannerImage = asset('images/breadcrumb-banner.jpeg');
    }
    $post = new App\Models\Post;
    $post->title = $page->title;
@endphp

@extends($user_theme->frontend_layout($extends))
@section("page_title") {{$page->title}} @endsection

@section('main')
    {!! $user_theme->partials('post.cover',['post' => $post]) !!}

    <div class="rts-blog-grid-area rts-section-gap">
        <div class="container-xl">
    

            @if($page->getImage->where('type','featured_image')->first())
                <div class="row">
                    <div class="col-md-12"><img src="{{App\Classes\Helpers\Image::getImageAsSize($page->getImage->where('type','featured_image')->first()->image->filepath,'m')}}" alt="" class="img img-responsive img-fluid"></div>
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <h2>{{$page->title}}</h2>
                </div>
                <div class="col-md-12 mt-2">
                    {!! $page->full_description!!}
                </div>
            </div>

            @include('frontend.components.lister', ['model' => $page])

        </div>
    </div>
@endsection