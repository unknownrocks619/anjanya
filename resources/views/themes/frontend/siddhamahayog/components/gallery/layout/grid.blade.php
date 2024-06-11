@php
    /** @var array $componentValue = */
    $galleryAlbums = \App\Models\GalleryAlbums::with(['items'])
                                    ->whereIn('id',$componentValue['albums'])
                                    ->where('active',true)
                                    ->where('album_type','!=','glitters')
                                    ->get();
    $rowLoop = 0;
    $colLoop = false;
@endphp

<div class="edu-gallery-grid-area masonary-wrapper-activation edu-section-gap bg-image bg-image--25 overflow-hidden">
    <div class="wrapper">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <div class="section-title text-start">
                        <span class="pre-title">{{$componentValue['highlight']}}</span>
                        <h3 class="title">{{ $componentValue['title'] }}</h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="button-group isotop-filter filters-button-group d-flex justify-content-start justify-content-lg-end">
                        <button data-filter="*" class="is-checked"><span class="filter-text">All</span></button>
                        @foreach ($galleryAlbums as $album)
                            <button data-filter=".cat--{{$album->getKey()}}">
                                <span class="filter-text">
                                    {{$album->album_name}}
                                </span>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="row g-5 mt--5">
                <div class="col-12">
                    <div class="gallery-grid-wrapper grid-metro3 mesonry-list overflow-hidden" id="animated-thumbnials">
                        <div class="resizer"></div>

                        @foreach ($galleryAlbums as $album)
                            @foreach ($album->items as $images)
                                <!-- Start Gallery Grid  -->
                                <a href="{{\App\Classes\Helpers\Image::getImageAsSize($images->getImage->first()->image?->filepath,'xl')}}" class="edu-gallery-grid-item grid-metro-item cat--{{$album->getKey()}}">
                                    <div class="edu-gallery-grid">
                                        <div class="inner">
                                            <div class="thumbnail">
                                                <img class="w-100" src="{{\App\Classes\Helpers\Image::getImageAsSize($images->getImage->first()->image?->filepath,'m')}}" alt="{{$images->heading_one}}">
                                            </div>
                                        </div>

                                        <div class="zoom-icon">
                                            <i class="icon-zoom-in-line"></i>
                                        </div>
                                        <div class="hover-action">
                                            <div class="hover-content">
                                                <div class="hover-text">
                                                    <h6 class="title">{{$images->heading_one}}</h6>
                                                    @if($images->description)
                                                        <div class="description">
                                                            {!! $images->description !!}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <!-- End Gallery Grid  -->
                            @endforeach
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>