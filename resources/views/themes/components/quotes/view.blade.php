@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp

<style>

    .quote-card {
        background: #fff;
        color: #222222;
        padding: 20px;
        padding-left: 50px;
        box-sizing: border-box;
        box-shadow: 0 2px 4px rgba(34, 34, 34, 0.12);
        position: relative;
        overflow: hidden;
        min-height: 120px;
    }
    .quote-card p {
        font-size: 22px;
        line-height: 1.5;
        margin: 0;
        max-width: 80%;
    }
    .quote-card cite {
        font-size: 16px;
        margin-top: 10px;
        display: block;
        font-weight: 200;
        opacity: 0.8;
    }
    .quote-card:before {
        font-family: Georgia, serif;
        content: "“";
        position: absolute;
        top: 10px;
        left: 10px;
        font-size: 5em;
        color: rgba(238, 238, 238, 0.8);
        font-weight: normal;
    }
    .quote-card:after {
        font-family: Georgia, serif;
        content: "”";
        position: absolute;
        bottom: -110px;
        line-height: 100px;
        right: -32px;
        font-size: 25em;
        color: rgba(238, 238, 238, 0.8);
        font-weight: normal;
    }
    @media (max-width: 640px) {
        .quote-card:after {
            font-size: 22em;
            right: -25px;
        }
    }
    .quote-card.blue-card {
        background: #0078FF;
        color: #ffffff;
        box-shadow: 0 1px 2px rgba(34, 34, 34, 0.12), 0 2px 4px rgba(34, 34, 34, 0.24);
    }
    .quote-card.blue-card:before, .quote-card.blue-card:after {
        color: #5FAAFF;
    }
    .quote-card.green-card {
        background: #00970B;
        color: #ffffff;
        box-shadow: 0 1px 2px rgba(34, 34, 34, 0.12), 0 2px 4px rgba(34, 34, 34, 0.24);
    }
    .quote-card.green-card:before, .quote-card.green-card:after {
        color:#59E063 ;
    }

    .quote-card.red-card {
        background: #F61E32;
        color: #ffffff;
        box-shadow: 0 1px 2px rgba(34, 34, 34, 0.12), 0 2px 4px rgba(34, 34, 34, 0.24);
    }
    .quote-card.red-card:before, .quote-card.red-card:after {
        color:#F65665 ;
    }

    .quote-card.yellow-card {
        background: #F9A825;
        color: #222222;
        box-shadow: 0 1px 2px rgba(34, 34, 34, 0.12), 0 2px 4px rgba(34, 34, 34, 0.24);
    }
    .quote-card.yellow-card:before, .quote-card.yellow-card:after {
        color: #FBC02D;
    }
</style>
<div class="container">
        <blockquote class="blockquote  quote-card red-card">
            <p class="text-white">{{$componentValue['quote']}}</p>
        </blockquote>
        {{--    <figcaption class="blockquote-footer">--}}
        {{--        Someone famous in <cite title="Source Title">Source Title</cite>--}}
        {{--    </figcaption>--}}
</div>
