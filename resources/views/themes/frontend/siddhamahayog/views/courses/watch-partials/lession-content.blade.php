<?php
$leftComponents = $lession
    ->getComponents()
    ->where('display_location', 'left')
    ->get();
$topComponents = $lession
    ->getComponents()
    ->where('display_location', 'top')
    ->get();
$rightComponents = $lession
    ->getComponents()
    ->where('display_location', 'right')
    ->get();
$bottomComponents = $lession
    ->getComponents()
    ->where('display_location', 'bottom')
    ->get();
?>
<!-- Component View: -->
<div class="row py-5 my-lg-5">
    @if ($leftComponents && $leftComponents->count())
        <div class="col-md-6 mb-md-0 mb-4">
            @foreach ($leftComponents as $component)
                @include('themes.components.' . $component->component_type . '.view.public.view', [
                    'component' => $component,
                ])
            @endforeach
        </div>
    @endif
    <div class="@if ($leftComponents && $leftComponents->count()) col-md-6 @else col-md-12 @endif">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            @if ($lession->enable_youtube && $lession->youtube)
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                        type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                        <span class="iconify" data-icon="mdi:youtube"></span> Youtube</button>
                </li>
            @endif
            @if ($lession->enable_vimeo && $lession->vimeo)
                <li class="nav-item" role="presentation">
                    <button class="nav-link @if (!$lession->enable_youtube || !$lession->youtube) active @endif" id="pills-profile-tab"
                        data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab"
                        aria-controls="pills-profile"
                        aria-selected=" @if (!$lession->enable_youtube || !$lession->youtube) true @else false @endif">
                        <span class="iconify" data-icon="cib:vimeo"></span> Vimeo</button>
                </li>
            @endif

        </ul>
        <div class="tab-content px-md-3" id="pills-tabContent">
            @if ($lession->enable_youtube && $lession->youtube)
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
                    tabindex="0">
                    <iframe width="100%" height="300px"
                        src="https://www.youtube.com/embed/{{ $lession->youtube->id }}" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                </div>
            @endif
            @if ($lession->enable_vimeo && $lession->vimeo)
                <div class="tab-pane fade  @if (!$lession->enable_youtube || !$lession->youtube) active show @endif" id="pills-profile"
                    role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                    <iframe
                        src="https://player.vimeo.com/video/{{ $lession->vimeo->id }}?h=dcaa89d3e0&title=0&byline=0&portrait=0"
                        width="100%" height="300px" frameborder="0" allow="autoplay; fullscreen; picture-in-picture"
                        allowfullscreen></iframe>

                </div>
            @endif
        </div>
    </div>
</div>
<!-- Component View: -->

@if ($bottomComponents && $bottomComponents->count())
    @foreach ($bottomComponents as $component)
        @include('themes.components.' . $component->component_type . '.view.public.view', [
            'component' => $component,
        ])
    @endforeach
@endif
