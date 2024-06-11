@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp
<div class="row">
    <div class="col-lg-10 offset-lg-1">
        <div class="video-gallery-wrapper edu-section-gapTop video-section-overlayto-another">
            <div class="video-gallery-1">
                <div class="thumbnail video-popup-wrapper">
                    <img class="radius-small w-100" src="{{$componentValue['video_poster']}}" alt="Video Images">
                    <a href="{{$componentValue['video_link']}}" class="video-play-btn with-animation position-to-top video-popup-activation btn-secondary-color size-80">
                        <span class="play-icon"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
