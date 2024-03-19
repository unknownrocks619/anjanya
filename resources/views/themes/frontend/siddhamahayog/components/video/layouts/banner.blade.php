@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
        $glittersBackground = null;
    $featuredBackgroundGlitter = null;
    $imageButtonSide = null;

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
    $styleValue = 'url('.$componentValue['background_image'].')';

    if ($componentValue['background_type'] == 'background_colour') {
        $styleKey = 'background';
        $styleValue = $componentValue['background_colour'];
    }

@endphp
<!-- Start Video Area  -->
<div class="edu-workshop-area eduvibe-home-three-video workshop-style-1 edu-section-gap bg-image bg-color-primary" style="{{$styleKey}} : {{$styleValue}} !important;background-position: center;background-size: contain">
    <div class="container eduvibe-animated-shape">
        <div class="row gy-lg-0 gy-5 row--60 align-items-center">
            <div class="col-lg-6 order-2 order-lg-1">
                <div class="workshop-inner">
                    <div class="section-title text-white" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                        <span class="pre-title">{{$componentValue['subtitle']}}</span>
                        <h3 class="title">{{$componentValue['heading']}}</h3>
                    </div>
                    <div class="description" data-sal-delay="250" data-sal="slide-up" data-sal-duration="800">
                        {!! $componentValue['description'] !!}
                    </div>
                    @if($componentValue['button_label'])
                        <div class="read-more-btn" data-sal-delay="350" data-sal="slide-up" data-sal-duration="800">
                            <a class="edu-btn btn-white" href="{{$componentValue['button_link']}}">
                                {{$componentValue['button_label']}}
                                <i class="icon-arrow-right-line-right"></i>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2">
                <div class="thumbnail video-popup-wrapper">
                    <img class="radius-small w-100" src="{{$componentValue['video_poster']}}" alt="About Image">
                    <a href="{{$componentValue['video_link']}}" class="video-play-btn with-animation position-to-top video-popup-activation color-secondary size-60">
                        <span class="play-icon"></span>
                    </a>
                </div>
            </div>
        </div>
        <div class="shape-dot-wrapper shape-wrapper d-xl-block d-none">
            @if($glittersBackground)
                @php($count=1)
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
<!-- End Video Area  -->
