<?php
$images = $component->getImage;
$componentValues = json_decode($component->values);
$background = '#242254';

if (isset($componentValues->background_color) && !empty($componentValues->background_color)) {
    $background = $componentValues->background_color;
}
?>
<style type="text/css">
    .enterpenuer-section {
        background: {{ $background }};
        padding: 120px 0;
    }

    .enterpenuer-section h1 {
        font-size: 47px;
        color: #fff;
        font-weight: 700;
        line-height: 1.3em;
    }

    .enterpenuer-section p {
        font-size: 20px;
        font-weight: 400;
        color: #fff;
        line-height: 1.8em;
        font-size: 18px;
    }

    .enterpenuer-img {
        margin-top: -165px;
    }

    .educators-section {
        background: #F4F4F4;
        padding: 100px 0;
    }

    .educators-section h1 {
        font-size: 50px;
        color: #242254;
        font-weight: 700;
        text-align: center;
    }

    .profile-img {
        width: 150px;
        height: 150px;
        margin: 0 auto;
    }

    .profile-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 100%;
    }

    .educator-content,
    .educator-des {
        color: #242254;
        text-align: center;
        max-width: 75%;
        margin: 0 auto;
        font-size: 16px;
        font-weight: 400;
        font-style: normal;
        line-height: 2em;
    }

    .educator-name {
        color: #242254;
        text-align: center;
        font-size: 25px;
        font-weight: 900;
        text-transform: uppercase;

    }

    .educator-des {
        font-size: 18px;
        color: #242254;
        font-weight: 600;
        text-align: center;
        text-transform: uppercase;

    }
</style>
@if (
    $component->active ||
        auth()->guard('admin')->check())
    @if ($values->display_position == 'left')
        <div class="free-section">
            <div class="container">
                <div class="row">
                    @if ($images->count())
                        <div class=" col-lg-5">
                            <div class="free-img">
                                <?php
                                $image = $component
                                    ->getImage()
                                    ->latest()
                                    ->first();
                                
                                $image = $image->image->filepath;
                                ?>
                                <img src="{{ \App\Classes\Helpers\Image::getImageAsSize($image, 'm') }}"
                                    class="img-fluid w-100" />
                            </div>
                        </div>
                    @endif
                    <div class="@if ($images->count()) col-lg-7 @else col-lg-12 @endif">
                        <div class="mt-5">
                            <h1 class="mb-4">
                                {!! htmlspecialchars_decode($values->title) !!}
                            </h1>
                            <div>
                                {!! htmlspecialchars_decode($values->description) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($values->display_position == 'right')
        <div class="enterpenuer-section">
            <div class="container">
                <div class="row">
                    <div class="@if ($images->count()) col-lg-6 @else col-lg-12 @endif">
                        <div>
                            <h1 class="mb-3">
                                {!! $values->title !!}
                            </h1>
                            <div class="mb-4">
                                {!! htmlspecialchars_decode($values->description) !!}
                            </div>
                        </div>
                    </div>
                    @if ($images->count())
                        <div class="col-lg-6">
                            <div class="enterpenuer-img">
                                <?php
                                $image = $component
                                    ->getImage()
                                    ->latest()
                                    ->first();
                                
                                $image = $image->image->filepath;
                                ?>
                                <img src="{{ \App\Classes\Helpers\Image::getImageAsSize($image, 'm') }}" class="w-100"
                                    alt="">
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
@endif
