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
<div class="eduvibe-home-four-video edu-video-area edu-section-gap video-style-2" style="{{$styleKey}} : {{$styleValue}} !important; background-size: contain;background-repeat: repeat-y">
    <div class="container eduvibe-animated-shape">
        <div class="row">
            <div class="col-lg-8">
                <div class="pr--75 pr_lg--30 pr_md--0 pr_sm--0">
                    <div class="thumbnail video-popup-wrapper">
                        <img class="radius-small" src="{{$componentValue['video_poster']}}" alt="{{$componentValue['heading']}}">
                        <a href="{{$componentValue['video_link']}}" class="video-play-btn with-animation position-to-top video-popup-activation color-secondary size-80">
                            <span class="play-icon"></span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="content mt_md--40 mt_sm--40">
                    <div class="section-title text-start" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                        <span class="pre-title">{{$componentValue['subtitle']}}</span>
                        <h3 class="title">{{$componentValue['heading']}}</h3>
                    </div>

                    <div class="description mt--40 mb--40 mt_md--20 mt_sm--20" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                        {!! $componentValue['description'] !!}
                    </div>

                    @if($componentValue['button_label'])
                        <div class="read-more-btn text-start" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                            <a class="edu-btn" href="{{$componentValue['button_link']}}">{{$componentValue['button_label']}}<i class="icon-arrow-right-line-right"></i></a>
                        </div>
                    @endif
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

    <div class="side-shape-image d-lg-block d-none">
        <img src="{{asset ('images/shape-bg/video-infinite-rotate.png')}}" alt="Shape Images" />
    </div>

</div>
<!-- End Video Area  -->
