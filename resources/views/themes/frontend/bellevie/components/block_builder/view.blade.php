<!-- Block Builder  -->
@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp
<section class="about section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-30 animate-box" data-animate-effect="fadeInUp">
                <div class="section-subtitle">{{$componentValue['subtitle']}}</div>
                <div class="section-title">{!! $componentValue['heading'] !!}</div>
                <div class="description">
                    {!! $componentValue['description'] !!}
                </div>
                <!-- call -->
                <div class="reservations">
                    <div class="icon"><span class="flaticon-call"></span></div>
                    <div class="text">
                        <p>Reservation</p> <a href="tel:855-100-4444">{{\App\Classes\Helpers\SystemSetting::primary_contact_info('primary_contact_number')}}</a>
                    </div>
                </div>
            </div>
            <div class="col col-md-3 animate-box" data-animate-effect="fadeInUp">
                <img src="{{$componentValue['first_image']}}" alt="" class="mt-90 mb-30"  style="min-height:348px !important">
            </div>
            <div class="col col-md-3 animate-box" data-animate-effect="fadeInUp" >
                <img src="{{$componentValue['second_image']}}" alt="" style="min-height:348px !important">
            </div>
        </div>
    </div>
</section>
