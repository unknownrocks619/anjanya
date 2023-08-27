@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp
<div class="container">
    <div class="alternation-container-wrapper">
        @foreach ($componentValue as $component)
            @if($loop->odd)
                <div class="row g-0 right alteration-row">
                    <div
                        data-reset-background="https://images.unsplash.com/photo-1558985590-e84f133009b2?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=1352&amp;q=80"
                        lc-helper="background" class="col-lg-6 order-lg-2 "
                        style="min-height: 45vh; background-size: cover; background-position: center; background-image: @if($component['image']) url({{$component['image']}})@else url('https://images.unsplash.com/photo-1558985590-e84f133009b2?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=1352&amp;q=80');@endif">
                    </div>
                    <div class="col-lg-6 order-lg-1 my-auto px-5 py-5">
                        <div class="lc-block">
                            <div>
                                <h1>{!! $component['heading'] !!}</h1>
                                <div class="lead">
                                    {!! $component['description'] !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row g-0 left alteration-row">
                    <div lc-helper="background" class="col-lg-6"
                         data-reset-background="https://images.unsplash.com/photo-1491926626787-62db157af940?ixlib=rb-1.2.1&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;h=768&amp;fit=crop&amp;ixid=eyJhcHBfaWQiOjM3ODR9"
                         style="min-height: 45vh; background-size: cover;background-position: center; background-image: @if($component['image']) url({{$component['image']}}); @else url('https://images.unsplash.com/photo-1491926626787-62db157af940?ixlib=rb-1.2.1&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;h=768&amp;fit=crop&amp;ixid=eyJhcHBfaWQiOjM3ODR9') @endif">
                    </div>
                    <div class="col-lg-6 my-auto px-5 py-5">
                        <div class="lc-block">
                            <div>
                                <h1>{!! $component['heading'] !!}</h1>
                                <div>{!! $component['description'] !!}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
