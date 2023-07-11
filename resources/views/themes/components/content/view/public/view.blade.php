<?php
$values = json_decode($component->values);

$topMedia = isset($values->media->top) ? $values->media->top : [];
$bottomMedia = isset($values->media->bottom) ? $values->media->bottom : [];
?>
<div class="row">
    <div class="col-md-12 text-center">
        <h4 class="my-1">
            @if ($values->subtitle)
                <themecolor>{{ $values->subtitle }}</themecolor>
            @endif
        </h4>
        <h1>
            {!! htmlspecialchars_decode($values->title) !!}
        </h1>
        @if ($topMedia && count($topMedia))
            @foreach ($topMedia as $top_media)
                @if ($top_media->query && isset($top_media->query->host) && $top_media->query->host == 'vimeo.com')
                    {!! \App\Classes\Helpers\Video::renderVimeo($top_media->id) !!}
                @else
                    {!! \App\Classes\Helpers\Video::renderYoutube(
                        $top_media->id,
                        strip_tags(htmlspecialchars_decode($values->title)),
                    ) !!}
                @endif
            @endforeach
        @endif

        <div class="fs-4 my-2">{!! htmlspecialchars_decode($values->description) !!}</div>

        @if ($bottomMedia && count($bottomMedia))
            @foreach ($bottomMedia as $bottom_media)
                @if ($bottom_media->query && isset($bottom_media->query->host) && $bottom_media->query->host == 'vimeo.com')
                    {!! \App\Classes\Helpers\Video::renderVimeo($bottom_media->id) !!}
                @else
                    {!! \App\Classes\Helpers\Video::renderYoutube(
                        $bottom_media->id,
                        strip_tags(htmlspecialchars_decode($values->title)),
                    ) !!}
                @endif
            @endforeach
        @endif

    </div>
</div>
