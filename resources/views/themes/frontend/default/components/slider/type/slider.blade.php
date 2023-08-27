@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
    $sliders = \App\Models\SliderAlbum::with(['sliders'])->first();
@endphp
<div class="container-fluid px-0 mx-0 my-2">
    <div class="row d-flex justify-content-center">
        <div class="col-md-12">
            <div id="componentCarouselContainer" class="carousel component-carousel slide carousel-dark" data-bs-ride="carousel"  data-bs-touch="true">
                <div class="carousel-indicators">
                    @foreach($sliders->sliders as $slider)
                        <button type="button" data-bs-target="#componentCarouselContainer" data-bs-slide-to="{{$loop->index}}"
                            @if($loop->first)class="active" aria-current="true" @endif  aria-label="Slide {{$loop->iteration}}"></button>
                    @endforeach
                </div>

                <div class="carousel-inner">
                    @foreach($sliders->sliders as $slider)
                        <div class="carousel-item @if($loop->first) active @endif">
                            <img class="d-block w-100 img-fluid" style="max-height:90vh"
                                 src="{{\App\Classes\Helpers\Image::getImageAsSize($slider->getImage[0]->image->filepath,'m')}}"
                                 alt="First slide"/>
                            @if($slider->heading_one || $slider->description)
                                <div class="carousel-caption d-none d-md-block">
                                    @if($slider->heading_one)
                                        <h5>{{$slider->heading_one}}</h5>
                                    @endif
                                    @if($slider->description)
                                        <p>{!! $slider->description !!}</p>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#componentCarouselContainer" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#componentCarouselContainer" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</div>
