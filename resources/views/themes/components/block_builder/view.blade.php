@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp
<div class="container">
    <div class="row align-items-center d-flex justify-content-between">
        <div class="col-lg-6 col-md-6 order-2 order-md-1 mt-4 pt-2 mt-sm-0 opt-sm-0">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-6">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 mt-4 pt-2">
                            <div class="card work-desk rounded border-0 shadow-lg overflow-hidden">
                                <img src="{{$componentValue['first_image']}}" style="height:362px; width:241px;"
                                     class="img-fluid w-100" alt="Image"/>
                                <div class="img-overlay bg-dark"></div>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>
                <!--end col-->

                <div class="col-lg-6 col-md-6 col-6">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card work-desk rounded border-0 shadow-lg overflow-hidden">
                                <img src="{{$componentValue['second_image']}}" style="width:450px; height:337px"
                                     class="img-fluid w-100" alt="Image"/>

                                <div class="img-overlay bg-dark"></div>
                            </div>
                        </div>
                        <!--end col-->

                        <div class="col-lg-12 col-md-12 mt-4 pt-2">
                            <div class="card work-desk rounded border-0 shadow-lg overflow-hidden">
                                <img src="{{$componentValue['third_image']}}" style="width:600px;height:250px;"
                                     class="img-fluid w-100" alt="Image"/>
                                <div class="img-overlay bg-dark"></div>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end col-->

        <div class="col-lg-5 col-md-5 col-12 order-1 order-md-2">
            <div class="section-header ml-lg-5">
                <h5 class="font-weight-normal mb-0">{!! $componentValue['subtitle'] !!}</h5>
                <img src="images/wave.svg" class="wave" alt="wave">
                <h4 class="title mb-4">{!! $componentValue['heading'] !!}
                </h4>
                <div class="mb-0 mt-3 py-3">{!! $componentValue['description'] !!}</div>
            </div>
        </div>
        <!--end col-->
    </div>
</div>
