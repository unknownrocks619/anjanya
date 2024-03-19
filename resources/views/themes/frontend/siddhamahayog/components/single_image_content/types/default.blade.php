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

    if ($componentValue['background_type'] == 'colour') {
        $styleKey = 'background';
        $styleValue = $componentValue['colour'];
    }
@endphp
    <!-- Start About Area  -->
<div id="about-us" class="edu-about-area about-style-1 edu-section-gap bg-color-white" style="{{$styleKey}} : {{$styleValue}} !important;background-size: cover">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6">
                <div class="about-image-gallery">
                    <img class="image-1" src="{{$componentValue['image']}}" alt="About Main Thumb" />
                    @if($featuredBackgroundGlitter)
                        <div class="shape-image shape-image-1">
                            <img src="{{App\Classes\Helpers\Image::getImageAsSize($featuredBackgroundGlitter->getImage()->first()->image->filepath,'m')}}" alt="Shape Thumb" />
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                <div class="inner">
                    <div class="section-title" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                        <span class="pre-title">{!! $componentValue['subtitle'] !!}</span>
                        <h3 class="title">{!! $componentValue['heading'] !!}</h3>
                    </div>
                    <div class="description" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                        {!! $componentValue['description'] !!}
                    </div>
                    <div class="about-feature-list">

                        @foreach ($componentValue['bullets'] as $bullet_key => $bulletPoint)
                            <!-- Start Single Feature  -->
                            <div class="our-feature mt-0" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                                <div class="icon">
                                    <i class="icon-arrow-right-line-right"></i>
                                </div>
                                <div class="feature-content">
                                    <h6 class="feature-title">{{strip_tags($bulletPoint)}}</h6>
                                    @if(isset($componentValue['bullets_description'][$bullet_key]))
                                        <div class="feature-description">
                                            {!! $componentValue['bullets_description'][$bullet_key] !!}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <!-- End Single Feature  -->
                        @endforeach
                    </div>
                    @if(isset($componentValue['button_label']))
                    <div class="read-more-btn" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                        <a class="edu-btn" href="{{$componentValue['button_link']}}">{{$componentValue['button_label']}}<i class="icon-arrow-right-line-right"></i></a>
                    </div>
                    @endif
                    <div class="shape-dot-wrapper shape-wrapper d-xl-block d-none">
                        @if($glittersBackground)
                            @php($count=1)
                            @foreach ($glittersBackground->items ?? [] as $items)
                                @continue($items->featured_background)
                                @continue($items->featured_button)

                                @if($count >= 4)
                                    @php ($count = 1)
                                @endif
                                <div class="shape-image shape-image-{{$count}} about-parallax-2">
                                    <img src="{{\App\Classes\Helpers\Image::getImageAsSize($items->getImage()->first()?->image->filepath,'s')}}" alt="Shape Thumb" />
                                </div>
                                @php($count++)
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


