@php
    $styleKey = 'background-image';
    $styleValue = 'url('.$componentValue['background-image'].')';
    if ($componentValue['layout_type'] == 'background_colour') {
        $styleKey = 'background';
        $styleValue = $componentValue['background_colour'];
    }
@endphp

<section class="service-section">
    <div class="heading-wrap secondary-bg" style="{{$styleKey}}: {{$styleValue}}">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="section-head white-section-head">
                        <div class="back-title">{{$componentValue['background-text']}}</div>
                        <h2 class="section-title">
                            @php
                                $title  = str($componentValue['title']);
                                if ($componentValue['underline_text'] && $title->contains($componentValue['underline_text'])) {

                                    $componentValue['title'] = $title->replace($componentValue['underline_text'],'<span class="primary-color">'. $componentValue['underline_text'].'                                 <svg class="title-shape" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">
                                    <path d="M9.3,127.3c49.3-3,150.7-7.6,199.7-7.4c121.9,0.4,189.9,0.4,282.3,7.2C380.1,129.6,181.2,130.6,70,139 c82.6-2.9,254.2-1,335.9,1.3c-56,1.4-137.2-0.3-197.1,9"></path>
                                 </svg></span>');
                                }
                            @endphp
                            {!! $componentValue['title'] !!}
                        </h2>
                        <div class="section-disc">
                            {!! $componentValue['description'] !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    @php
                        $videoID = explode('?v=',$componentValue['video_link'])
                    @endphp
                    <figure class="video-banner">
                        <img src="{{$componentValue['video_poster']}}" alt="">
                        <div class="video-button">
                            <a id="video-container" data-video-id="{{$videoID[1]}}">
                                <i class="fas fa-play"></i>
                            </a>
                        </div>
                    </figure>
                </div>
            </div>
        </div>
    </div>
    @if($componentValue['attach_component'])
        @php
            $components = \App\Models\WebComponents::with('getComponents')->find($componentValue['attach_component']);
        @endphp
        @foreach ($components?->getComponents ?? [] as $component)
            @php
                $componentService = new \App\Classes\Components\Component($component->component_type);
            @endphp
            {!! $componentService->previewBuilder(['_loadComponentBuilder' => $component,'attachable' => true]) !!}
        @endforeach
    @endif
</section>
