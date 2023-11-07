
@php
    /** @var array $componentValue = */
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */

    $galleryAlbums = \App\Models\GalleryAlbums::with(['items'])
                                    ->whereIn('id',$componentValue['albums'])
                                    ->where('active',true)
                                    ->get();
    $rowLoop = 0;
    $colLoop = false;
    $countImage = 1;
@endphp
<section class="gallery-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="section-head text-center">
                    <div class="back-title">{{$componentValue['highlight']}}</div>
                    <h2 class="section-title">
                        @php
                            $title = $componentValue['title'];
                            $explode_title = explode(' ', $title);
                            $last_string = $explode_title[count($explode_title)-1];
                            $final_concat = '<span class="primary-color">' . $last_string .'
                                            <svg class="title-shape" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">
                                            <path d="M9.3,127.3c49.3-3,150.7-7.6,199.7-7.4c121.9,0.4,189.9,0.4,282.3,7.2C380.1,129.6,181.2,130.6,70,139 c82.6-2.9,254.2-1,335.9,1.3c-56,1.4-137.2-0.3-197.1,9"></path>
                                            </svg>
                                        </span>
                                        ';
                            $final_title = str_replace($last_string,$final_concat,$title);
                        @endphp
                        {!! $final_title !!}
                    </h2>
                    <div class="section-disc">
                        {!! $componentValue['description'] !!}
                    </div>
                </div>
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
</section>
