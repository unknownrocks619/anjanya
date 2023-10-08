<!-- Icon Block -->
@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp
<section class="video-wrapper video section-padding bg-img bg-fixed" data-overlay-dark="3" data-background="{{$componentValue['background_image']}}">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2 text-center">
                <span><i class="star-rating"></i><i class="star-rating"></i><i class="star-rating"></i><i class="star-rating"></i><i class="star-rating"></i></span>
                <div class="section-subtitle"><span>{{ $componentValue['subtitle'] }}</span></div>
                <div class="section-title"><span>{{$componentValue['heading']}}</span></div>
                @if($componentValue['description'])
                    <div class="description">
                        {!! $componentValue['description'] !!}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="text-center col-md-12">
                <a class="vid" href="{{$componentValue['promo_video']}}">
                    <div class="vid-butn">
                            <span class="icon">
                                <i class="ti-control-play"></i>
                            </span>
                    </div>
                </a>
            </div>

        </div>
    </div>
</section>
