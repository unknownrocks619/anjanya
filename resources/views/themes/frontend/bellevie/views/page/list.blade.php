
@extends($user_theme->frontend_layout($extends))

@section('page_title')
    | {{ $page->title ?? $menu->menu_name }}
@endsection
@php
    $pageFeaturedImage = $page
        ->getImage()
        ->where('type', 'banner_image')
        ->latest()
        ->first();
    $image = null;
    if ($pageFeaturedImage) {
        $image = \App\Classes\Helpers\Image::getImageAsSize($pageFeaturedImage->image?->filepath, 'm');
    }

    if ( ! $image && $menu) {
        $menuFeaturedImage = $menu->getImage()->where('type','banner_image')->latest()->first();
        if ($menuFeaturedImage) {
            $image = \App\Classes\Helpers\Image::getImageAsSize($menuFeaturedImage->image?->filepath, 'm');
        }
    }
@endphp

@section('main')
    {!! $user_theme->partials('page.banner',['banner_image' => $image,'subtitle' => \App\Classes\Helpers\SystemSetting::basic_configuration('site_name'),'title' => $page->title ?? $menu->menu_name]) !!}
    <div class="mt-4">
        @include('frontend.components.lister', ['model' => $page])
    </div>

@endsection
