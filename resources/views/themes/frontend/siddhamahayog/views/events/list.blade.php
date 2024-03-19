@php
    /** @var  \App\Models\Menu $menu */

    $bannerImage = null;

    $banner_image = $menu?->getImage()->where('type','banner_image')->first();

    if ( ! $banner_image ) {
        $banner_image = $menu?->getImage()->where('type','featured_image')->first();
    }

    if ($banner_image) {
        $bannerImage = \App\Classes\Helpers\Image::getImageAsSize($banner_image->image->filepath,'l');
    }


    $glittersBackground = \App\Models\GalleryAlbums::where('id',$menu->glitter_background)
                                                    ->where('active',true)
                                                    ->with(['items' => function($query) {
                                                        $query->with(['getImage' => function($query) {
                                                            $query->with('image');
                                                        }])
                                                        ->limit('3');
                                                    }])
                                                    ->first();
@endphp

@extends($user_theme->frontend_layout($extends))

@section("page_title")
    {{ $menu->menu_name }}
@endsection

@section('main')
    {!! $user_theme->partials('page-header',['title' => $menu->menu_name,'bannerImage' => $bannerImage,'glittersBackground' => $glittersBackground]) !!}

    <div class="edu-event-grid-area edu-section-gap bg-color-white">
        <div class="container">
            <div class="row g-5">

                @foreach ($events as $event)
                    {!! $user_theme->partials('events.event-lister',['event' => $event]) !!}
                @endforeach
            </div>
            <div class="row">
                <div class="col-lg-12 mt--60">
                    <nav>
                        {{$events->links()}}
                    </nav>
                </div>
            </div>
        </div>
    </div>

@endsection
