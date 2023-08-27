@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp
<div class="container">
    <figure>
        <blockquote class="blockquote">
            <p>{{$componentValue['quote']}}</p>
        </blockquote>
        {{--    <figcaption class="blockquote-footer">--}}
        {{--        Someone famous in <cite title="Source Title">Source Title</cite>--}}
        {{--    </figcaption>--}}
    </figure>
</div>
