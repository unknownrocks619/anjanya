@php
    if ($type == 'slider_album') {
        $sliderItems = App\Models\SliderItem::whereIn('slider_album_id', $value)->get();
    }
@endphp
<style>
    .splide__optional-button-container {
        margin-bottom: 1rem;
        margin-top: 1rem;
        text-align: center;
    }

    .splide__slide {
        max-height: 450px;
        text-align: center;
    }

    .splide__slide>img {
        width: 100%
    }
</style>
<section id="splideComponent___{{ uniqid() }}" class="splide my-2" data-config="{}">

    <div class="splide__track">
        <ul class="splide__list">
            @foreach ($sliderItems as $slider)
                <li class="splide__slide">
                    <img
                        src='{{ \App\Classes\Helpers\Image::getImageAsSize($slider->getImage?->first()->image->filepath, 'l') }}' />
                </li>
            @endforeach
        </ul>
    </div>
</section>
