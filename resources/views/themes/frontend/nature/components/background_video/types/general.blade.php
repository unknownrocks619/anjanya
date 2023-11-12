@php
    $styleKey = 'background-image';
    $styleValue = 'url('.$componentValue['background-image'].')';
    if ($componentValue['background_type'] == 'background_colour') {
        $styleKey = 'background';
        $styleValue = $componentValue['background_colour'];
    }
@endphp
<section class="contact-section" style="{{$styleKey}}: {{$styleValue}}">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="section-head white-section-head">
                    <div class="back-title">{{$componentValue['background-text']}}</div>
                    <h2 class="section-title">
                        @php
                            $title  = str($componentValue['title']);
                            if ($componentValue['underline_text'] && $title->contains($componentValue['underline_text'])) {

                                $componentValue['title'] = $title->replace($componentValue['underline_text'],'<span class="primary-color">'. $componentValue['underline_text'].'                                 <svg class="title-shape" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">
                                <path d="M9.3,127.3c49.3-3,150.7-7.6,199.7-7.4c121.9,0.4,189.9,0.4,282.3,7.2C380.1,129.6,181.2,130.6,70,139 c82.6-2.9,254.2-1,335.9,1.3c-56,1.4-137.2-0.3-197.1,9"></path>
                             </svg></span>');
                            }
                        @endphp
                        {!! $componentValue['title'] !!}
                    </h2>
                    <div class="section-disc">
                        {!! $componentValue['description'] !!}
                    </div>
                </div>
                <div class="video-button">
                    @php
                        $videoID = explode("?v=",$componentValue['video_link'])
                    @endphp
                    <a id="video-container-two" data-video-id="{{$videoID[1]}}">
                        <i class="fas fa-play"></i>
                    </a>
                    <span>
                        @php
                            $string= 'PLAY SHORT VIDEO';
                            if ($componentValue['button_one']['label']) {
                                $string = $componentValue['button_one']['label'];
                            }
                        @endphp
                        {{$string}}
                    </span>
                </div>
            </div>
            @if($componentValue['enquiry_form'])
                <div class="col-lg-6">
                    {!! $user_theme->widget('enquiry-form') !!}
                </div>
            @endif
        </div>
    </div>
    <div class="overlay"></div>
</section>
