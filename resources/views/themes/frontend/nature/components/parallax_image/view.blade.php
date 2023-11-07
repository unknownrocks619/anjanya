@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp
<!-- home callback section html start -->
<section class="callback-section" style="background-image: url({{$componentValue['background_image']}});">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-8">
                <div class="callback-content">
                    <div class="section-head">
                        <div class="back-title">
                            {{ $componentValue['subtitle'] }}
                        </div>
                        <h2 class="section-title">
                            @php
                                $title = strip_tags($componentValue['heading']);
                                $explode_title = explode(' ', $title);
                                $last_string = $explode_title[count($explode_title)-1];
                                $final_concat = '<span class="primary-color">' . $last_string .'
                                                <svg class="title-shape" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">
                                                <path d="M9.3,127.3c49.3-3,150.7-7.6,199.7-7.4c121.9,0.4,189.9,0.4,282.3,7.2C380.1,129.6,181.2,130.6,70,139 c82.6-2.9,254.2-1,335.9,1.3c-56,1.4-137.2-0.3-197.1,9"></path>
                                                </svg>
                                            </span>
                                            ';
                                $final_title = str_replace($last_string,$final_concat,$title);
                            @endphp
                            {!! $final_title !!}
                        </h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                @if(isset($componentValue['button_label']) && isset($componentValue['button_link']))
                <div class="button-right">
                    <a href="{{$componentValue['button_link']}}" class="button-round-primary">{{$componentValue['button_label']}}</a>
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="overlay"></div>
</section>
<!-- home callback section html end -->
