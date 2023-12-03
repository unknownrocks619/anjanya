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
@push('page_setting')
    <style>
        .about-image-gallery:after {
            left : 20px !important;
        }
    </style>
@endpush
    <!-- Start About Area  -->
<div class="eduvibe-home-five-about edu-about-area about-style-6 edu-section-gap bg-color-white" style="{{$styleKey}} : {{$styleValue}} !important;background-size:cover">
    <div class="container eduvibe-animated-shape">
        <div class="row g-5 align-items-center">
            <div class="col-xl-5 col-lg-6">
                <div class="about-image-gallery">
                    <img class="image-1 w-100" src="{{$componentValue['image']}}" alt="About Images">
{{--                    <div class="badge-icon">--}}
{{--                        <div class="badge-inner">--}}
{{--                            <img @if( ! $featuredBackgroundGlitter) src="{{asset('assets/images/about/about-08/badge.png')}}"@else src="{{App\Classes\Helpers\Image::getImageAsSize($featuredBackgroundGlitter->getImage()->first()->image->filepath,'m')}}" @endif alt="Icon Images">--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 offset-xl-1">
                <div class="inner mt_md--40 mt_sm--20">
                    <div class="section-title" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                        <span class="pre-title">{!! $componentValue['subtitle'] !!}</span>
                        <h3 class="title">{!! $componentValue['heading'] !!}</h3>
                    </div>
                    <div class="description line-before mt--40 mb--40" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                        {!! $componentValue['description'] !!}
                    </div>
                    <div class="feature-list-wrapper" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                        @foreach ($componentValue['bullets'] as $bullet_key => $bulletPoint)
                            <div class="feature-list d-block">
                                <div class="d-flex">
                                    <i class="icon-checkbox-circle-fill"></i>
                                    {!! $bulletPoint !!}
                                </div>
{{--                                @if(isset($componentValue['bullets_description'][$bullet_key]))--}}
{{--                                    <div class="feature-description d-block w-100">--}}
{{--                                        {!! $componentValue['bullets_description'][$bullet_key] !!}--}}
{{--                                    </div>--}}
{{--                                @endif--}}
                            </div>
                        @endforeach
                    </div>
                    <div class="read-more-btn mt--75 mt_lg--30 mt_md--40 mt_sm--40" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                        @if(isset($componentValue['button_label']))
                            <a class="edu-btn" href="{{$componentValue['button_link']}}">{{$componentValue['button_label']}}<i class="icon-arrow-right-line-right"></i></a>
                            <a class="info-btn" href="tel:{{\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_contact_number')}}"><i class="icon-call"></i>{{\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_contact_number')}}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="shape-dot-wrapper shape-wrapper d-xl-block d-none">
            @if($glittersBackground)
                @php($count=1);
                @foreach ($glittersBackground->items ?? [] as $items)
                    @continue($items->featured_background)
                    @continue($items->featured_button)

                    @if($count >= 6)
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
<!-- End About Area  -->

