@extends($user_theme->frontend_layout($extends))

@section('page_title')
    {{ $menu->menu_name }}
@endsection

@php
    $bannerImage = null;
    // get Banner Image from $page.
        $banner_image = $menu?->getImage()->where('type','banner_image')->first();
    if ( ! $banner_image ) {
        $banner_image = $menu?->getImage()->where('type','featured_image')->first();
    }

    if ($banner_image) {
        $bannerImage = \App\Classes\Helpers\Image::getImageAsSize($banner_image->image->filepath,'l');
    }
    // if Banner image is not available from page, try from menu.
@endphp
@section('main')
    {!! $user_theme->partials('page-header',['title' => $menu?->menu_name,'bannerImage' => $bannerImage]) !!}
    <!-- section main content -->
    <section class="gallery-page-section gallery-section">
        <div class="container">
            <div class="gallery-inner">
                <div class="gallery-container grid">
                    @foreach ($galleryAlbums as $album)
                        @foreach ($album->items as $galleyItem)
                            <div class="single-gallery grid-item">
                                <figure class="gallery-img">
                                    <a href="{{ \App\Classes\Helpers\Image::getImageAsSize($galleyItem->getImage()->first()?->image->filepath,'xl')  }}" data-fancybox="gallery">
                                        <img src="{{\App\Classes\Helpers\Image::getImageAsSize($galleyItem->getImage()->first()?->image->filepath,'m')}}" alt="{{$galleyItem->heading_one}}" >
                                    </a>
                                </figure>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
            <div class="row gy-4 mt-2">
                <div class="@if (\App\Classes\Helpers\SystemSetting::PageConfiguration('sidebar', true)) col-md-8 sidebar-content @else col-md-12 @endif">
                    <div class="page-content bordered rounded-padding-30">
                        @include('frontend.components.lister', ['model' => $menu])
                    </div>
                </div>
                @if (\App\Classes\Helpers\SystemSetting::PageConfiguration('sidebar', true))
                    <div class="col-md-4">
                        <div class="sidebar">
                            @foreach (\App\Classes\Helpers\SystemSetting::PageConfiguration('sidebar', true, 'additonal_text') as $widget)
                                {!! $user_theme->widget($widget) !!}
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
