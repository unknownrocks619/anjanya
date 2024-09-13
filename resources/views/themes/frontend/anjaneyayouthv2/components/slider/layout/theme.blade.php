    @php
        $sliderItems = [];
        $model = null;

        if ($type == 'slider_album') {
            $sliderItems = App\Models\SliderItem::whereIn('slider_album_id', $value)->get();
        }
    @endphp
    <div class="banner__slider banner-style3 overflow-hidden component_view">
        <div class="swiper-wrapper">
            @foreach ($sliderItems as $sliderItem)
                <div class="swiper-slide">
                    <div class="banner"
                        style="background-image: url({{ \App\Classes\Helpers\Image::getImageAsSize($sliderItem->getImage?->first()->image->filepath, 'l') }});">
                        <div class="container">
                            <div class="banner__content ms-lg-auto">
                                @if ($sliderItem->heading_one)
                                    <h2 class="text-white">A Powerful Religon Theme</h2>
                                @endif
                                @if ($sliderItem->description)
                                    <div class="text-white my-3">
                                        {!! $sliderItem->description !!}
                                    </div>
                                @endif
                                @foreach ($buttons ?? [] as $button)
                                    <a href="{{ $button['link'] }}"
                                        class="default-btn move-right"><span>{{ $button['label'] }}</span></a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
