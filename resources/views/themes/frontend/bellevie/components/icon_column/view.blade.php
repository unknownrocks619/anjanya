<!-- Icon Block -->
@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp
<section class="facilties section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-subtitle">{{$componentValue['subtitle']}}</div>
                <div class="section-title">{{$componentValue['heading']}}</div>
            </div>
        </div>
        @foreach ($componentValue['data'] as $rowKey => $rowValue)
        <div class="row">
            @foreach ($rowValue as $column)
            <div class="col-md-{{$componentValue['column']}}">
                <div class="single-facility animate-box" data-animate-effect="fadeInUp">
                    <span class="{{$column['icon']}}"></span>
                    <h5>{{$column['title']}}</h5>
                    <div>{!! $column['description'] !!}</div>
                    <div class="facility-shape"> <span class="{{$column['icon']}}"></span> </div>
                </div>
            </div>
            @endforeach
        </div>
        @endforeach
    </div>
</section>
