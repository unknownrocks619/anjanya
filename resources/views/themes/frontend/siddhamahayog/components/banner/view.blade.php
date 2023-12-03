@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;

    $styleKey = 'background-image';
    $styleValue = 'url('.$componentValue['background_image'].')';

    if ($componentValue['background_type'] == 'colour') {
        $styleKey = 'background';
        $styleValue = $componentValue['background_colour'];
    }
@endphp

<!-- Start Newsletter Area  -->
<div class="edu-newsletter-area newsletter-overlay-to-another">
    <div class="container newsletter-style-5 bg-color-primary" style="{{$styleKey}} : {{$styleValue}} !important">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <div class="inner">
                    <div class="section-title text-start text-white" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                        <span class="pre-title">{{$componentValue['subtitle']}}</span>
                        <h3 class="title">{{$componentValue['heading']}}</h3>
                    </div>
                    <div class="description sal-animate" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                        {!! $componentValue['description'] !!}
                    </div>
                </div>
            </div>
            @if($componentValue['button_label'])
            <div class="col-lg-5">
                <div class="cta-btn text-start text-lg-end">
                    <a class="edu-btn btn-white" href="{{$componentValue['button_link']}}">
                    {{$componentValue['button_label']}}
                    <i class="icon-arrow-right-line-right"></i></a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<!-- End Newsletter Area  -->
