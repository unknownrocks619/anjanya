@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
    $testimonials = \App\Plugins\Testimonials\Http\Models\Testimonial::get();
@endphp
<section class="testimonials">
    <div class="background bg-img bg-fixed section-padding pb-0" data-background="{{$componentValue['background']}}" data-overlay-dark="3">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="testimonials-box">
                        <div class="head-box">
                            <h6>{{$componentValue['subtitle']}}</h6>
                            <h4>{{$componentValue['title']}}</h4>
                            <div class="line"></div>
                        </div>
                        <div class="owl-carousel owl-theme">
                            @foreach ($testimonials as $testimonial)
                            <div class="item">
                                <span class="quote"><img src="{{asset('frontend/bellevie/img/quot.png')}}" alt=""></span>
                                <p>{{$testimonial->comment}}</p>
                                <div class="info">
                                    <div class="author-img">
                                        @if($testimonial->images)
                                            <img src="{{\App\Classes\Helpers\Image::getImageAsSize($testimonial->images,'xs')}}" alt="{{$testimonial->full_name}}" />
                                        @else
                                            <img src="{{\App\Classes\Helpers\SystemSetting::logo()}}"  alt="{{$testimonial->full_name}}" style="width:70px; height:70px">
                                        @endif
                                    </div>
                                    <div class="cont"> <span>
                                            @for($i=0 ; $i <= $testimonial->rating; $i++)
                                                <i class="star-rating"></i>
                                            @endfor
                                        </span>
                                        <h6>{{$testimonial->full_name}}</h6> <span>Guest review</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
