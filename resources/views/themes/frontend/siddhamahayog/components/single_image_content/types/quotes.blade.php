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
<!-- Start Testimonial Area  -->
<div class="eduvibe-testimonial-one edu-testimonial-area edu-section-gap bg-image" style="{{$styleKey}} : {{$styleValue}} !important;background-size: cover">
    <div class="container eduvibe-animated-shape">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-center" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                    <span class="pre-title">{{$componentValue['subtitle']}}</span>
                    <h3 class="title">{{$componentValue['heading']}}</h3>
                </div>
            </div>
        </div>
        <div class="row g-5 mt--25">
            <div class="col-lg-6 col-12">
                <div class="satisfied-learner">
                    <div class="thumbnail">
                        <img src="{{$componentValue['image']}}" alt="Education Images">
                    </div>
{{--                    <div class="trophy-content bounce-slide">--}}
{{--                        <div class="icon">--}}
{{--                            <img src="assets/images/testimonial-section/trophy.png" alt="Trophy Images">--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <div class="testimonial-activation testimonial-item-1 testimonial-style-1 edu-slick-button slick-button-left">

                    <!-- Start Single Testimonial  -->
                    <div class="single-testimonial">
                        <div class="inner">
                            <div class="quote-sign">
                                <img src="{{asset('images/testimonial/testimonial-01/quote.png')}}" alt="Quote Images">
                            </div>
                            <div class="description">
                                {!! $componentValue['description'] !!}
                            </div>
                            <div class="read-more-btn mt--75 mt_lg--30 mt_md--40 mt_sm--40" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                                @if(isset($componentValue['button_label']))
                                    <a class="edu-btn" href="{{$componentValue['button_link']}}">{{$componentValue['button_label']}}<i class="icon-arrow-right-line-right"></i></a>
                                    <a class="info-btn" href="tel:{{\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_contact_number')}}"><i class="icon-call"></i>{{\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_contact_number')}}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- End Single Testimonial  -->
                </div>
            </div>
        </div>
        <div class="shape-dot-wrapper shape-wrapper d-xl-block d-none">
            @if($glittersBackground)
                @php($count=1);
                @foreach ($glittersBackground->items ?? [] as $items)
                    @continue($items->featured_background)
                    @continue($items->featured_button)

                    @if($count >= 3)
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
<!-- End Testimonial Area  -->
