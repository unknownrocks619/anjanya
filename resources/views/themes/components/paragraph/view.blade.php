@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp
<div class="container-fluid">
    <div class="row align-items-center">
        <div class="col-lg-12 col-md-6 order-2 order-md-1 mt-4 pt-2 mt-sm-0 opt-sm-0">
            <div>
                <div class="description">
                    {!! $componentValue['description'] !!}
                </div>
            </div>
            <!--end row-->
        </div>
        <!--end col-->
    </div>
</div>
