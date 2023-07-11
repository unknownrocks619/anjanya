@php
    $componentImage = $component
        ->getImage()
        ->where('type', null)
        ->latest()
        ->first();
    $displayImage = $component
        ->getImage()
        ->where('type', 'display_image')
        ->latest()
        ->first();
@endphp
<div class="announcment-section"
    style="background:url({{ \App\Classes\Helpers\Image::getImageAsSize($componentImage->image->filepath, 'l') }});background-size:cover;background-position:center">
    <div class="container py-5">

        @if (isset($values->tagline))
            <h4>
                {{ $values->tagline }}
            </h4>
        @endif

        <h1 class="mb-4">
            {{ $values->title }}
        </h1>

        <div style="font-size:20px;color:#fff;text-align:center;margin-bottom: 10px;">
            {!! $values->description !!}
        </div>

        @if (isset($values->videos))
            <div class="announce-video hs-auto">
                @if ($values->videos->type == 'youtube')
                    <iframe src="https://www.youtube.com/embed/{{ $values->videos->content->id }}"
                        title="{{ $values->title }}" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                @endif
            </div>
        @endif
        @if (isset($values->buttons))
            @foreach ($values->buttons as $buttonContent)
                <div class="text-center mt-5">
                    <a href="{{ $buttonContent->link }}" class="register-link">
                        {{ $buttonContent->label }}
                    </a>
                </div>
            @endforeach
        @endif
        @if ($displayImage && $displayImage->count())
            <div class="man-img text-center">
                <img src="{{ \App\Classes\Helpers\Image::getImageAsSize($displayImage->image->filepath, 'l') }}"
                    class="hs-auto" alt="">
            </div>
        @endif

    </div>
</div>
