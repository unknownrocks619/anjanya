@php
    /**  @var \App\Plugins\Rooms\Http\Models\Rooms $room */
    $bannerImages = $room->getImage()->where('type','banner')->get();
@endphp
<!-- Room Page Slider -->
<header class="header slider">
    <div class="owl-carousel owl-theme">
        @foreach ($bannerImages as $room_image)
            <div class="text-center item bg-img" data-overlay-dark="3" data-background="{{\App\Classes\Helpers\Image::getImageAsSize($room_image->image->filepath,'l')}}"></div>
        @endforeach
    </div>
    <!-- arrow down -->
    <div class="arrow bounce text-center">
        <a href="#" data-scroll-nav="1" class=""> <i class="ti-arrow-down"></i> </a>
    </div>
</header>


