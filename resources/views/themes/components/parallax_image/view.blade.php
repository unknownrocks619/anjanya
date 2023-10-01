<!-- Icon Block -->
@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp
<section id="parallax-static">
    <div class="{{$componentValue['container_class']}} d-flex align-items-center justify-content-center parallax video-wrapper video section-padding bg-img bg-fixed" data-overlay-dark="3" data-background="" style="background-image:url('{{$componentValue['background_image']}}');background-position:{{$componentValue['position']}};min-height:{{$componentValue['section_height']}}">
        <div class="row d-flex justify-content-center align-items-center" style="min-height:{{$componentValue['section_height']}}">
            <div class="col-md-9 text-center">
                <div class="section-subtitle text-white" style="
    font-size: 20px;
    font-size: clamp(17px,2vw,20px);
    font-weight: 300;
    letter-spacing: 1.1em;
    letter-spacing: clamp(1em,2vw,1.1em);
    margin-bottom: 20px;
    text-transform: uppercase;">
                    <span>{{ $componentValue['subtitle'] }}</span>
                </div>
                <h1 style="color: #f3f4f6"><span>{{$componentValue['heading']}}</span></h1>
                @if($componentValue['description'])
                    <div class="description text-white fs-4">
                        {!! $componentValue['description'] !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@push('page_script')
    <link href="https://cdn.jsdelivr.net/npm/jarallax@2/dist/jarallax.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jarallax@2/dist/jarallax.min.js"></script>
    <script>
        jarallax(document.querySelectorAll('.parallax'), {
            speed: 0.2,
            imgSrc: '{{$componentValue['background_image']}}'
        });
    </script>
@endpush
