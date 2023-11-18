@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
    $glittersBackground = null;
    $featuredBackgroundGlitter = null;
    $imageButtonSide = null;
    $frontImage = $componentValue['front_image'];
    if ( $componentValue['glitter_background'] ) {
        $glittersBackground = \App\Models\GalleryAlbums::where('id',$componentValue['glitter_background'])
                                                        ->where('active',true)
                                                        ->with(['items' => function($query) {
                                                            $query->with(['getImage' => function($query) {
                                                                $query->with('image');
                                                            }])
                                                            ->limit('3');
                                                        }])
                                                        ->first();
        $featuredBackgroundGlitter = $glittersBackground?->items()->where('featured_background',true)->first();
        $imageButtonSide = $glittersBackground?->items()->where('featured_button',true)->first();
    }

    $styleKey = 'background-image';
    $styleValue = 'url('.$componentValue['background-image'].')';

    if ($componentValue['layout_type'] == 'background_colour') {
        $styleKey = 'background';
        $styleValue = $componentValue['background_colour'];
    }
@endphp
<!-- Start Sldier Area  -->
<div class="slider-area banner-style-2 bg-image d-flex align-items-center"  style="{{$styleKey}} : {{$styleValue}} !important">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 col-md-12">
                <div class="inner">
                    <div class="content">
                        <span class="pre-title" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">Better Learning Future With Us</span>
                        <h1 class="title" data-sal-delay="200" data-sal="slide-up" data-sal-duration="800">
                            {{$componentValue['title']}}</h1>
                        <div class="description" data-sal-delay="250" data-sal="slide-up" data-sal-duration="800">
                            {!! $componentValue['description'] !!}
                        </div>
                        @if($componentValue['button_one']['label'])
                            <div class="read-more-btn" data-sal-delay="300" data-sal="slide-up" data-sal-duration="800">
                                <a class="edu-btn" href="{{$componentValue['button_one']['link']}}">{{$componentValue['button_one']['label']}}
                                    <i class="icon-arrow-right-line-right"></i></a>
                            </div>
                        @endif
                        @if($imageButtonSide)
                            <div class="arrow-sign d-lg-block d-none">
                                <img src="{{\App\Classes\Helpers\Image::getImageAsSize($imageButtonSide->getImage()->first()->image->filepath,'m')}}" alt="Banner Images" data-sal-delay="150" data-sal="fade" data-sal-duration="800">
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                @if($frontImage)
                    <div class="banner-thumbnail">
                        <img class="girl-thumb" src="{{$frontImage}}" alt="{{$componentValue['title']}}" data-sal-delay="150" data-sal="fade" data-sal-duration="800" />
                    </div>
                    @if($featuredBackgroundGlitter)
                        @php
                            $imageBackground = App\Classes\Helpers\Image::getImageAsSize($featuredBackgroundGlitter->getImage()->first()->image->filepath,'m');
                        @endphp
                        <div class="banner-bg d-lg-block d-none">
                            <img class="girl-bg" src="{{$imageBackground}}" alt="Girl Background" data-sal-delay="150" data-sal="fade" data-sal-duration="800" />
                        </div>
                    @endif
                @endif
            </div>
        </div>

        <div class="shape-dot-wrapper shape-wrapper d-xl-block d-none">
            @if($glittersBackground)
                @php($count=1);
                @foreach ($glittersBackground->items ?? [] as $items)
                    @continue($items->featured_background)
                    @continue($items->featured_button)

                    @if($count >= 4)
                        @php ($count = 1)
                    @endif
                    <div class="shape-image shape-image-{{$count}}">
                        <img src="{{\App\Classes\Helpers\Image::getImageAsSize($items->getImage()->first()?->image->filepath,'s')}}" alt="Shape Thumb" />
                    </div>
                    @php($count++)
                @endforeach
            @endif
        </div>
    </div>
</div>
<!-- End Sldier Area  -->
