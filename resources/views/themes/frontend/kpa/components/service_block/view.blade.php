
@php
$values = $_loadComponentBuilder->values;
$title = $values['title'];
$subtitle = $values['subtitle'];
$description = $values['description'];
$serviceBlocks = $values['blocks'];
$type = $values['service_type'];
$row = $values['row'];
$column = $values['column'];
@endphp

<div id="commonComponentBuilder">
    <!-- rts service post area  Start-->
    <div class="rts-service-area rts-section-gap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="rts-title-area service text-center">
                        <p class="pre-title">
                            {{{$subtitle}}}
                        </p>
                        <h2 class="title">{{$title}}</h2>
                    </div>
                </div>
                <div class="col-12 text-center">
                    <div class="description">
                        {!! $description !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid service-main plr--120-service mt--50 plr_md--0 pl_sm--0 pr_sm--0">
            <div class="background-service row">
                @php $loopCount = 0; @endphp
                @for($i = 1; $i <= $row ; $i++)
                    <div class='row mb-2'>
                        @for ($j= 1 ; $j <= (12/$column); $j++)
                            @php
                                $title = $serviceBlocks[$loopCount]['title'];
                                $description = $serviceBlocks[$loopCount]['description'];
                                $icon = $serviceBlocks[$loopCount]['icon'];
                                $image = $serviceBlocks[$loopCount]['image'] ? $serviceBlocks[$loopCount]['image'] : null ;
                                $loopCount++;
                            @endphp

                            <div class='col-xl-{{$column}} col-md-{{$column}} col-sm-12 col-12'>
                                <div class="service-one-inner one">

                                    <div class="thumbnail">
                                        @if($type == 'image')
                                            <img src="{{ $image }}" alt="finbiz_service" style="max-width:65px; max-height:65px;">
                                        @else
                                            <i class="{{$icon}}"></i>
                                        @endif    
                                    </div>
                                    <div class="service-details">
                                        <a href="service-details.html">
                                            <h5 class="title">{{$title}}</h5>
                                        </a>
                                        <div class="disc">
                                            {!! $description !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                @endfor
            </div>
        </div>
    </div>
</div>
