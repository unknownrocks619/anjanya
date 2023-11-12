@php
    $styleKey = 'background-image';
    $styleValue = 'url('.$componentValue['background-image'].')';
    if ($componentValue['layout_type'] == 'background_colour') {
        $styleKey = 'background';
        $styleValue = $componentValue['background_colour'];
    }
    $videoId = str($componentValue['video_link'])->after('watch?v=');
@endphp

<section class="about-page-section">
    <div class="container">
        <div class="about-video-wrap">
            <div class="about-video-content" style="{{$styleKey}} : {{$styleValue}}">
                <h3>{{$componentValue['title']}}</h3>
                <div>
                    {!! $componentValue['description'] !!}
                </div>
            </div>
            <div class="video-image" style="background-image: url({{$componentValue['video_poster']}});">
                <div class="video-button">
                    <a id="video-container" data-video-id="{{$videoId}}">
                        <i class="fas fa-play"></i>
                    </a>
                </div>
                <div class="overlay"></div>
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
    </div>
</section>
