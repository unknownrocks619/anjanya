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

@section("page_title")
    {{ $page->title ?? $menu->menu_name }}
@endsection

@section('main')
    {!! $user_theme->partials('page-header',['bannerImage' => $banner_image,'title' => $page->title ?? $menu->menu_name,'glitter_background' => null]) !!}
    @include('frontend.components.lister', ['model' => $page])

@endsection
