@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp
<div class="container">
    <figure>
        <blockquote class="blockquote">
            <p style="border-left: 2px solid;padding:17px;" class="border-success">{{$componentValue['quote']}}</p>
        </blockquote>
        {{--    <figcaption class="blockquote-footer">--}}
        {{--        Someone famous in <cite title="Source Title">Source Title</cite>--}}
        {{--    </figcaption>--}}
    </figure>
</div>
