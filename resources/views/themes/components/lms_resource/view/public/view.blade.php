<?php
$component->load(['getImage']);
$values = json_decode($component->values);
?>

<div class="row border-bottom align-items-center">
    <div class="@if (
        ($component->display_location != 'left' || $component->display_location != 'right') &&
            $component->getImage->count()) col-md-6 @else col-md-12 @endif">

        <h2>{{ $values->resource_title }}</h2>
        @if ($values->accordians && count($values->accordians))
            <div class="border-bottom pb-2 mb-4">
                <div class="accordian-parent d-flex">
                    @foreach ($values->accordians as $accordian_key => $accordian_values)
                        <a class="t-note collapsed ms-4 learning-accordian" data-bs-toggle="collapse"
                            href="#collapseChildren{{ $accordian_key }}" role="button" aria-expanded="false"
                            aria-controls="collapseChildren{{ $accordian_key }}">
                            <span class="iconify" data-icon="material-symbols:arrow-right"></span>
                            <b>{{ $accordian_values->title }}</b>
                        </a>
                    @endforeach
                </div>
                @foreach ($values->accordians as $accordian_key => $accordian_values)
                    <div class="collapse" id="collapseChildren{{ $accordian_key }}">
                        {!! $accordian_values->description !!}
                    </div>
                @endforeach
            </div>
        @endif

        <div class="resource-description">
            {!! $values->resource_description !!}
        </div>

        @if ($values->buttons && count($values->buttons))
            <div class="mt-4">
                @foreach ($values->buttons as $button)
                    <a href="{{ $button->link }}" class="red-btn mb-3">
                        {{ $button->label }}
                        @if (\Illuminate\Support\Str::contains('download', $button->label))
                            <span class="iconify" data-icon="material-symbols:download"></span>
                        @else
                            <span class="iconify" data-icon="ci:external-link"></span>
                        @endif
                    </a>
                @endforeach
            </div>
        @endif

    </div>
    @if (
        ($component->display_location != 'left' || $component->display_location != 'right') &&
            $component->getImage()->count() == 1)

        <div class="col-md-5 offset-lg-1">
            <div class="g3">
                <a href="assets/images/img3.png">
                    <img src="{{ \App\Classes\Helpers\Image::getImageAsSize($component->getImage[0]->image->filepath, 'l') }}"
                        class="w-100" alt="{{ $values->resource_title }}">
                </a>
            </div>
        </div>
    @else
        <div class="col-md-5 offset-lg-1">
            <div class="g3">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper g5">
                        @foreach ($component->getImage as $image)
                            <div class="swiper-slide">
                                <a
                                    href="{{ \App\Classes\Helpers\Image::getImageAsSize($image->image->filepath, 'l') }}"><img
                                        src="{{ \App\Classes\Helpers\Image::getImageAsSize($image->image->filepath, 'm') }}"
                                        class="w-100" alt=""></a>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    @endif
</div>
