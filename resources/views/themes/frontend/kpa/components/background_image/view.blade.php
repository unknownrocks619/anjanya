@php
    $imageOne = asset('frontend/kpa/assets/images/banner/banner-14.png');
    $imageTwo = asset('frontend/kpa/assets/images/banner/sm-1.png');
    $imageThree = asset('frontend/kpa/assets/images/banner/sm-2.png');
        /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
    $imageOne = $componentValue['images']['image_one'] ?? $imageOne;
    $imageTwo = $componentValue['images']['image_two'] ?? $imageTwo;
    $imageThree = $componentValue['images']['image_three'] ?? $imageThree;

    $description = $componentValue['description'];
    $subtitle = $componentValue['subtitle'];
    $title = $componentValue['title'];
    $button = $componentValue['button_one'];
@endphp
<!-- banner ten area start -->
<div class="banner-tena-area banner-bg-10 bg_image rts-section-gap">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-6 order-lg-1 order-md-2 order-sm-2 order-2">
                <!-- banner inner-content ten area -->
                <div class="banner-ten-inner-content">
                    <span class="pre-title">{{$subtitle}}</span>
                    <h1 class="title">{{ $title }}
                    </h1>

                    <div class="disc mb-5">
                        {!! $description !!}
                    </div>
                    @if($button['link'] && $button['label'])
                        <a href="{{$button['link']}}" class="mt-5 rts-btn btn-primary-2">{{$button['label']}}</a>
                    @endif
                </div>
                <!-- banner inner-content ten area end -->
            </div>
            <div class="col-lg-6 order-lg-2 order-md-1 order-sm-1 order-1">
                <div class="thumbnail-img-10 pt--100">
                    <img src="{{$imageOne}}" alt="banner" style="max-width: 520px; max-height:500px;">
                    <img class="small-img" src="{{$imageTwo}}" alt="small-image" style="max-width:270px; max-height:260px;">
                    <img class="small-img-2" src="{{$imageThree}}" alt="small-image" style='max-width:276px;max-height:160px;'>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- banner ten area end -->