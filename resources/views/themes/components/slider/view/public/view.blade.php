@php
    $card_content = $_loadComponentBuilder->values;
    $sliderAlbum = \App\Models\SliderAlbum::with(['sliders'])->find($card_content['slider']);
    
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

.splide__slide > img {
    width: 100%
}
</style>
@if( $sliderAlbum && $sliderAlbum->sliders->count())
<section id="splideComponent__{{$sliderAlbum->getKey()}}_{{uniqid()}}"
    class="splide my-2"  @if($card_content['type'] == 'single') data-config="{}" @else data-config="{{json_encode(['perPage' => 3,'rewind'=>true])}}" @endif>

    <div class="splide__track">
            <ul class="splide__list">
                @foreach ($sliderAlbum->sliders as $slider)
                <li class="splide__slide @if($card_content['type'] != 'single') mx-2 @endif" >
                    <img src='{{App\Classes\Helpers\Image::getImageAsSize($slider->getImage()->first()->image->filepath,'m')}}' />
                </li>
                @endforeach
            </ul>
    </div>
</section>
@endif