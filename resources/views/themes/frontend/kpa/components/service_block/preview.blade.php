
@php
$title = isset($title) ? $title  : 'High Quality Services';
$subtitle = isset($subtitle) ? $subtitle : 'Our Services';
$description = isset($description)  ? $description : '';
$serviceBlocks = isset($serviceBlocks) ? $serviceBlocks : [];
$type = isset($type) ? $type : 'image'
@endphp

@extends('themes.frontend.kpa.layout.preview-layout')
@section('main')
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
                @if(count($serviceBlocks))

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

                @else
                <!-- start single Service -->
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="service-one-inner one">
                        <div class="thumbnail">
                            <img src="{{ asset('frontend/kpa/assets/images/service/icon/01.svg')}}" alt="finbiz_service">
                        </div>
                        <div class="service-details">
                            <a href="#">
                                <h5 class="title">Business Planning</h5>
                            </a>
                            <p class="disc">
                                Sagitis himos pulvinar morb socis laoreet posuere enim non auctor etiam pretium libero
                            </p>
                        </div>
                    </div>
                </div>

                <!-- end single Services -->
                <!-- start single Service -->
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="service-one-inner two">
                        <div class="thumbnail">
                            <img src="{{ asset('frontend/kpa/assets/images/service/icon/02.svg')}}" alt="finbiz_service">
                        </div>
                        <div class="service-details">
                            <a href="#">
                                <h5 class="title">Develop Process</h5>
                            </a>
                            <p class="disc">
                                Sagitis himos pulvinar morb socis laoreet posuere enim non auctor etiam pretium libero
                            </p>
                        </div>
                    </div>
                </div>
                <!-- end single Services -->
                <!-- start single Service -->
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="service-one-inner three">
                        <div class="thumbnail">
                            <img src="{{ asset('frontend/kpa/assets/images/service/icon/03.svg')}}" alt="finbiz_service">
                        </div>
                        <div class="service-details">
                            <a href="#">
                                <h5 class="title">Strategy & Planning</h5>
                            </a>
                            <p class="disc">
                                Sagitis himos pulvinar morb socis laoreet posuere enim non auctor etiam pretium libero
                            </p>
                        </div>
                    </div>
                </div>
                <!-- end single Services -->
                <!-- start single Service -->
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="service-one-inner four">
                        <div class="thumbnail">
                            <img src="{{ asset('frontend/kpa/assets/images/service/icon/04.svg')}}" alt="finbiz_service">
                        </div>
                        <div class="service-details">
                            <a href="#">
                                <h5 class="title">Business Support</h5>
                            </a>
                            <p class="disc">
                                Sagitis himos pulvinar morb socis laoreet posuere enim non auctor etiam pretium libero
                            </p>
                          
                        </div>
                    </div>
                </div>
                <!-- end single Services -->
                <!-- start single Service -->
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="service-one-inner five">
                        <div class="thumbnail">
                            <img src="{{ asset('frontend/kpa/assets/images/service/icon/05.svg')}}" alt="finbiz_service">
                        </div>
                        <div class="service-details">
                            <a href="#">
                                <h5 class="title">Audit & Evaluation</h5>
                            </a>
                            <p class="disc">
                                Sagitis himos pulvinar morb socis laoreet posuere enim non auctor etiam pretium libero
                            </p>
                        </div>
                    </div>
                </div>
                <!-- end single Services -->
                <!-- start single Service -->
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="service-one-inner six">
                        <div class="thumbnail">
                            <img src="{{ asset('frontend/kpa/assets/images/service/icon/06.svg')}}" alt="finbiz_service">
                        </div>
                        <div class="service-details">
                            <a href="#">
                                <h5 class="title">Consultancy & Advice</h5>
                            </a>
                            <p class="disc">
                                Sagitis himos pulvinar morb socis laoreet posuere enim non auctor etiam pretium libero
                            </p>
                        </div>
                    </div>
                </div>
                <!-- end single Services -->
                @endif
            </div>
        </div>
    </div>
</div>
<!-- rts service post area ENd -->
@endsection
