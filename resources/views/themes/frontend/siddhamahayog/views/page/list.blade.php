@php
    /** @var  \App\Models\Page $page */
    $pageFeaturedImage = $page
        ->getImage()
        ->where('type', 'featured_image')
        ->first();
    $banner_image = $page->getImage()->where('type','banner_image')->first();

    if ($banner_image ) {
        $banner_image =\App\Classes\Helpers\Image::getImageAsSize($banner_image->image?->filepath, 'm');
    }

    $image = null;
    if ($pageFeaturedImage) {
        $image = \App\Classes\Helpers\Image::getImageAsSize($pageFeaturedImage->image?->filepath, 'm');
    }
@endphp
@extends($user_theme->frontend_layout($extends))
@section("page_title", ' | ' . $page->title ?? $menu->menu_name)

@section('main')
    {!! $user_theme->partials('page-header',['bannerImage' => $banner_image,'title' => $page->title ?? $menu->menu_name,'glitter_background' => null]) !!}

    <div class="edu-blog-details-area edu-section-gap bg-color-white">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-12 offset-lg-1">
                    <div class="blog-details-1 style-variation3">
                        <div class="content-blog-top">

                            <h4 class="title">
                                {{$page->title}}
                            </h4>

                            @if($pageFeaturedImage)
                                <div class="thumbnail block-alignwide">
                                    <img class="radius-small w-100 mb--30" src="{{ App\Classes\Helpers\Image::getImageAsSize($pageFeaturedImage->image->filepath,'xl')}}" alt="{{$page->title}}">
                                </div>
                            @endif
                        </div>

                        <div class="blog-main-content">
                            {!! $page->full_description !!}
                        </div>

                    </div>
                </div>
            </div>
            @include('frontend.components.lister', ['model' => $page])

        </div>
    </div>

@endsection
