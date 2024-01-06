@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp
<div class="row">
    <div class="col-md-12 text-center">
        @if( isset($componentValue['link']) )
            <a href="{{$componentValue['link']}}">
        @endif
            <img src="{{$componentValue['image']}}" alt="" class="img-fluid" />
        @if( isset($componentValue['link']) )
            </a>
        @endif
    </div>
</div>
