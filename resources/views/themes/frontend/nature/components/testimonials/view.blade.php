@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
    $testimonials = \App\Plugins\Testimonials\Http\Models\Testimonial::get();
@endphp
<section class="testimonial-section bg-light-grey">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="section-head text-center">
                    <div class="back-title">{{$componentValue['subtitle']}}</div>
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
            </div>
        </div>
        <div class="testimonial-inner">
            <div class="row">
                @foreach ($testimonials as $testimonial)
                <div class="col-md-6">
                    <div class="testimonial-item d-flex flex-wrap align-items-center">
                        <figure class="testimonial-img">
                            <img src="{{\App\Classes\Helpers\Image::getImageAsSize($testimonial->images)}}" alt="">
                        </figure>
                        <div class="testimonial-content">
                            {!! $testimonial->comment !!}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="pattern-overlay" style="background: url({{asset('/frontend/nature/assets/images/pattern1.png')}})"></div>
</section>
