@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp

<section class="home-banner" style="background-image: url({{$componentValue['background-image']}});">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="banner-content text-center">
                    <div class="section-head">
                        <div class="back-title">{{strtoupper($componentValue['background-text'])}}</div>
                        <h2 class="section-title banner-title">
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
                    </div>
                    <div class="banner-text">
                        {!! $componentValue['description'] !!}
                    </div>
                    <div class="banner-button">
                        @if($componentValue['button_one'])
                            <a href="{{$componentValue['button_one']['link']}}" class="button-round-primary">{{$componentValue['button_one']['label']}}</a>
                        @endif
                        @if($componentValue['button_two'])
                            <a href="{{$componentValue['button_two']['link']}}" class="button-round-white">{{$componentValue['button_two']['label']}}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="overlay"></div>
</section>
