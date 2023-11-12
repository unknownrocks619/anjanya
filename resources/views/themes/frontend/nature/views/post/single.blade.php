@php
    /** @var  \App\Models\Post $post */
    $pageFeaturedImage = $post
        ->getImage()
        ->where('type', 'featured_image')
        ->first();
    $banner_image = $post->getImage()->where('type','banner_image')->first();

    if ($banner_image ) {
        $banner_image =\App\Classes\Helpers\Image::getImageAsSize($banner_image->image?->filepath, 'm');
    }

    $image = null;
    if ($pageFeaturedImage) {
        $image = \App\Classes\Helpers\Image::getImageAsSize($pageFeaturedImage->image?->filepath, 'm');
    }
    $sliders = $post->getImage()->where('type','slider')->get();
@endphp

@extends($user_theme->frontend_layout($extends))

@section('page_title')
    {{ $post->title }}
@endsection

@section('main')
    {!! $user_theme->partials('page-header',['bannerImage' => $banner_image,'title' => $post->title,'date' => date('F d, Y', strtotime($post->updated_at))]) !!}
    <!-- Inner Banner html end-->
    <div class="charity-page-section">
        <div class="charity-page-inner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 primary right-sidebar">
                        <div class="charity-detail-container">
                            @if($pageFeaturedImage)
                            <figure class="charity-image">
                                <img src="{{$image}}" alt="{{$post->title}}">
                            </figure>
                            @endif
                            <h3>{{$post->title}}</h3>
                                {!!  \App\Plugins\PluginsService::register('Donation',$post) !!}
                            <div>
                                {!! $post->full_description !!}
                            </div>
                        </div>
                        @if($sliders->count())
                            <div class="single-gallery-slide">
                                <div class="gallery-slider">
                                    @foreach ($sliders as $slider)
                                        <div class="gallery-slide-item">
                                            <figure class="feature-image">
                                                <img src="{{\App\Classes\Helpers\Image::getImageAsSize($slider->image->filepath,'m')}}" alt="{{$post->title}}">
                                            </figure>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @include('frontend.components.lister', ['model' => $post])
                        <div class="sharethis-inline-share-buttons"></div><!-- ShareThis END -->


                    </div>
                    <div class="col-lg-4 secondary">
                        <div class="sidebar">
                            @if( \App\Plugins\PluginsService::hasSidebar('Donation',$post))
                                {!! \App\Plugins\PluginsService::getSidebar('Donation',$post) !!}
                            @else
                                {!! $user_theme->partials('post.sidebar',['post'=> $post]) !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
