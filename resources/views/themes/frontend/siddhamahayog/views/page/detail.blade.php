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
        $image = \App\Classes\Helpers\Image::getImageAsSize($pageFeaturedImage->image?->filepath, 'xl');
    }
@endphp

@extends($user_theme->frontend_layout($extends))

@section("page_title")
    {{ $page->title ?? $menu->menu_name }}
@endsection

@section('main')
    {!! $user_theme->partials('page-header',['bannerImage' => $banner_image,'title' => $page->title ?? $menu->menu_name,'glitter_background' => null]) !!}
    @if($image)
        <div class="edu-blog-details-area bg-color-white">
            <div class="container">
                <div class="thumbnail block-alignwide">

                    <img @if($page->slug == 'vedanta-darshan') onclick="window.location.href='{{route('frontend.courses.enroll.enroll',['course_slug' => 'vedanta-darshan','course' => 1])}}'" style="cursor: pointer" @endif class="radius-small w-100 mb--30" src="{{$image}}" alt="{{$page->title ?? $menu->menu_name}}">
                </div>
            </div>
        </div>
    @endif
    @include('frontend.components.lister', ['model' => $page])

@endsection
