@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
    $sliders = \App\Models\SliderAlbum::with(['sliders' => function($query) {
        $query->with(['getImage' => function($query) {
            $query->with('image');
        }]);
    }])->whereIn('id',$componentValue)->get();
@endphp
<header class="header slider-fade">
    <div class="owl-carousel owl-theme">
        <!-- The opacity on the image is made with "data-overlay-dark="number". You can change it using the numbers 0-9. -->
        @foreach ($sliders as $sliderAlbum)
            @foreach ($sliderAlbum->sliders as $sliderItem)
                @php
                    $images = App\Classes\Helpers\Image::getImageAsSize($sliderItem->getImage[0]->image->filepath,'l');
                @endphp
                <div class="text-center item bg-img" data-overlay-dark="2" data-background="{{$images}}" style="background-position:center">
                    <div class="v-middle caption">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-10 offset-md-1">
                                    <h4>{{$sliderItem->subtitle}}</h4>
                                    <h1 style="font-size:28px;">{{$sliderItem->heading_one}}</h1>
                                    <div class="butn-light mt-30 mb-30"> <a href="/room" data-scroll-nav="1"><span>Rooms & Suites</span></a> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach

    </div>
    <!-- slider reservation -->
    <div class="reservation">
        <a href="tel:8551004444">
            <div class="icon d-flex justify-content-center align-items-center">
                <i class="flaticon-call"></i>
            </div>
            <div class="call"><span>{{ \App\Classes\Helpers\SystemSetting::primary_contact_info('primary_contact_number') }}</span> <br>Reservation</div>
        </a>
    </div>
</header>
