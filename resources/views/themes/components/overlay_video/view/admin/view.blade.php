<div class="card">
    <div class="card-header bg-primary" id="{{ $component->component_type }}_{{ $component->getKey() }}">
        <h3 class="mb-0">
            <button class="btn btn-link ps-0 text-white" data-bs-toggle="collapse"
                data-bs-target="#{{ $component->component_type }}_{{ $component->getKey() }}"
                aria-expanded="true"
                aria-controls="{{ $component->component_type }}_{{ $component->getKey() }}"
                data-bs-original-title="" title=""><i class="icofont icofont-briefcase-alt-2"></i>
                {{ __('components.' . $component->component_type) }}
            </button>
        </h3>
    </div>
    <div class="collapse" id="{{ $component->component_type }}_{{ $component->getKey() }}"
        aria-labelledby="headingOne" data-bs-parent="#accordionicon">
        <div class="card-body">
            <?php
            $values = json_decode($component->values);
            $style = '';
            if ($values->overlay_color):
                $style = "background-color: {$values->overlay_color}";
            endif;
            $parseURL = parse_url($values->video_url);

            if ($values->video_source == 'vimeo') {
                $videoParse = explode('/', 'https://vimeo.com/1265ADFer3');
                $videoID = $videoParse[count($videoParse) - 1];
            } else {
                $parse = parse_url('https://www.youtube.com/watch?v=LW79iTiUIF4');
                parse_str($parse['query'], $output);
                $videoID = $output['v'];
            }
            ?>
            <div class="row mb-4">
                @if ($values->position == 'background')
                    <div class="col-md-12"
                        style="{{ $style }};min-height: 250px; min-width:100%;right:0;bottom:0">
                        @if ($values->video_source == 'vimeo')
                            <iframe id="home_banner_iframe"
                                data-src="https://player.vimeo.com/video/{{ $videoID }}?h=90402a2b5b&amp;muted=1&amp;autoplay=1&amp;loop=1&amp;transparent=0&amp;background=1&amp;app_id=122963"
                                width="100" height="260" frameborder="0"
                                allow="autoplay; fullscreen; picture-in-picture" allowfullscreen=""
                                title="{{$values->title}}" data-ready="true"
                                class="elementor-background-video-embed background-video-embed"
                                style="width: 100%; height: 545px;opacity:0.6"></iframe>
                        @else
                            <iframe width="560" height="315"
                                src="https://www.youtube.com/embed/{{ $videoID }}?&autoplay=1&playsinline=1&mute=1&controls=0"
                                title="{{ $values->title }}" frameborder="0"
                                class="elementor-background-video-embed background-video-embed"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                style="width: 100%; height: 545px;opacity:0.6;left:0px !important"></iframe>
                        @endif

                    </div>
                @endif
                <div class="col-md-12"
                    style="position:absolute;top:20%; display:grid;grid-auto-flow:dense;justify-content:center">
                    @if ($values->title)
                        <h1 class="fs-1 text-white d-flex justify-content-center">{{ $values->title }}</h1>
                        <div class="description d-flex justify-content-center text-white">
                            {!! $values->description !!}
                        </div>
                    @endif
                </div>
                @if ($values->buttons)
                    <div class="col-md-12"
                        style="position:absolute;top:30%;display:flex;justify-content:center">
                        @foreach ($values->buttons as $button)
                            <a href="{{ $button->link }}" class='btn btn-primary ms-2'>
                                {{ $button->label }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            @include('themes.components.overlay_video.view.admin.edit', [
                'component' => $component,
            ])
        </div>

    </div>
</div>
