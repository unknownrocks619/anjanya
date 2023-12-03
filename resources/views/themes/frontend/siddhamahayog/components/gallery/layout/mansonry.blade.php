
@php
    /** @var array $componentValue = [] */
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */

    $galleryAlbums = \App\Models\GalleryAlbums::with(['items'])
                                    ->whereIn('id',$componentValue['albums'])
                                    ->where('active',true)
                                    ->get();
    $rowLoop = 0;
    $colLoop = false;
    $countImage = 1;
@endphp
<div class="container-fluid eduvibe-animated-shape  edu-section-gap ">
    <div class="row g-5 align-items-center mb--30">
        <div class="col-lg-8 offset-lg-2">
            <div class="section-title text-start sal-animate" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                <span class="pre-title sal-animate">{{$componentValue['highlight']}}</span>
                <h3 class="title">{!! $componentValue['title'] !!}</h3>
            </div>
            @if($componentValue['description'])
                <div class="section-description">
                    {!! $componentValue['description'] !!}
                </div>
            @endif
        </div>
    </div>

    <div class="gallery-inner">
        <div class="gallery-container grid">
            @foreach ($galleryAlbums as $album)
                @foreach ($album->items ?? [] as $item)
                    <div class="single-gallery grid-item">
                        <figure class="gallery-img">
                            <a href="{{\App\Classes\Helpers\Image::getImageAsSize($item->getImage()->first()->image->filepath,'xl')}}" data-fancybox="gallery">
                                <img src="{{\App\Classes\Helpers\Image::getImageAsSize($item->getImage()->first()->image->filepath,'m')}}" alt="{{$item->heading_one}}">
                            </a>
                        </figure>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
</div>
