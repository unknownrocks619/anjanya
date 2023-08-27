@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp

<div class="container component-container" id="image_component_{{$_loadComponentBuilder->getKey()}}">
    <div class="row image-content-wrapper">
        @foreach ($componentValue as $key => $component)
            @if ($loop->odd)
                <div class="row mb-4 align-items-center">
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <div class="lc-block text-center">
                            <img class="img-fluid w-50"
                                 @if ( ! $component['image'])
                                     src="https://cdn.livecanvas.com/media/svg/isometric/app_development_SVG.svg"
                                 @else src="{{$component['image']}}" @endif
                                 srcset="" sizes="" width="" height="">
                        </div>
                    </div><!-- /col -->
                    <div class="col-lg-6 p-lg-6">
                        <div class="lc-block mb-5">
                            <div>
                                <h1 class="display-6 fw-bold text-dark">{!! $component['heading'] !!}</h1>
                                <div class="lead">
                                    {!! $component['description'] !!}
                                </div>
                            </div>
                        </div><!-- /lc-block -->
                        <!-- /lc-block -->
                        <div class="bullets-wrapper">
                            @foreach($component['bullets'] as $bullet)
                                <div class=" d-flex lc-block ">
                                    <div class=" d-inline-flex ">
                                        {!! $bullet !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div><!-- /col -->
                </div>
            @else
                <div class="right-image-content row mb-4 align-items-center">
                    <div class="col-lg-6 mb-4 mb-lg-0 order-lg-1">
                        <div class="lc-block text-center">
                            <img class="img-fluid w-50" @if( ! $component['image'])
                                src="https://cdn.livecanvas.com/media/svg/isometric/Startup_SVG.svg"
                                 @else
                                     src="{{$component['image']}}"
                                 @endif
                                 srcset="" sizes="" width="" height=""/>
                        </div><!-- /lc-block -->
                    </div><!-- /col -->
                    <div class="col-lg-6 p-lg-6">
                        <div class="lc-block mb-5">
                            <div >
                                <h2 class="display-6 fw-bold text-dark">{!! $component['heading'] !!}</h2>
                                <div class="lead">
                                    {!! $component['description'] !!}
                                </div>
                            </div>
                        </div><!-- /lc-block -->

                        <div class="bullets-wrapper">
                            @foreach ($component['bullets'] as $bullet)
                                <div class="lc-block d-flex">
                                    <div class="d-inline-flex">
                                        {!! $bullet !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div><!-- /col -->
                </div>
            @endif
        @endforeach
    </div>
</div>
