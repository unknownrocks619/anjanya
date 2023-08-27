@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp
<div class="row align-items-center">
    <div class="col-md-12">
        <div class="lc-block text-center">
            <div >
                <h2 class="fw-boldtext-dark">{!! $componentValue['title'] !!}</h2>
            </div>
        </div>
        <div class="lc-block text-center">
            <div class="">
                {!! $componentValue['intro'] !!}
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="row mt-4">
        <div class="col-md-6 left-wrapper">
            @foreach ($componentValue['left'] as $leftFaq)
                <div class="lc-block mb-5">
                    <div>
                        <h4 class="h4">{!! $leftFaq['title'] !!} </h4>
                        <div class=""> {!! $leftFaq['description'] !!}</div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-6 right-wrapper">
            @foreach($componentValue['right'] as $rightFaq)
                <div class="lc-block mb-5">
                    <div>
                        <h4 class="h4">{!! $rightFaq['title'] !!}</h4>
                        <div class="">
                            {!! $rightFaq['description'] !!}
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
