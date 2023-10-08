
@extends($user_theme->frontend_layout($extends))

@section('page_title')
    | {{ $menu->menu_name }}
@endsection
@php
    $pageFeaturedImage = $menu
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
    {!! $user_theme->partials('page.banner',['banner_image' => $image,'subtitle' => \App\Classes\Helpers\SystemSetting::basic_configuration('site_name'),'title' => $menu->menu_name]) !!}
    <div class="mt-4">
        @include('frontend.components.lister', ['model' => $menu])
    </div>

@endsection
