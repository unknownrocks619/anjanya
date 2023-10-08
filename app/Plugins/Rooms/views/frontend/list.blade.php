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

    <section class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @foreach ($rooms as $room)
                        <div class="rooms2 mb-90 {{$loop->odd ? '' : 'left'}} animate-box fadeInUp animated" data-animate-effect="fadeInUp">
                            @php
                                $image = null;
                                $image = $room->getImage()->where('type','featured')->first() ??  $room->getImage()->where('type','featured')->first();
                            @endphp
                            @if($image)
                                <figure>
                                    <img src="{{\App\Classes\Helpers\Image::getImageAsSize($image->image->filepath,'m')}}" alt="{{$room->room_name}}" class="img-fluid">
                                </figure>
                            @endif
                        <div class="caption">
                            <h3>{{$room->price}}{{$room->currency}} <span>/ Night</span></h3>
                            <h4><a href="room-details.html">{{$room->room_name}}</a></h4>
                            <div>
                                {!! $room->short_description !!}
                            </div>
                            <div class="row room-facilities">
                                @foreach ($room->amenities as $amenities)
                                    <div class="col-md-4">
                                        <ul>
                                            <li><i class="flaticon-group"></i> {{$amenities->amenities}}</li>
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                            <hr class="border-2">
                            <div class="info-wrapper">
                                <div class="more"><a href="{{route('room.detail',['slug' => $room->slug])}}" class="link-btn" tabindex="0">Details <i class="ti-arrow-right"></i></a></div>
                                <div class="butn-dark"> <a href="{{route('room.detail',['slug' => $room->slug])}}" data-scroll-nav="1"><span>Book Now</span></a> </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
