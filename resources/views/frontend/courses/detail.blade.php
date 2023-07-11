@extends('themes.frontend.users.auth', ['bodyAttribute' => ['class' => 'bg-white'], 'isLanding' => true, 'isFooter' => true])

@push('title')
    | {{ $course->course_name }}
@endpush

@section('main_content')
    <?php
    // let's get banner image,
    $bannerImage = '';
    $courseThumbnail = '';
    $checkImage = $course->getImage;
    if ($checkImage) {
        $bannerImage = $course
            ->getImage()
            ->where('type', 'banner')
            ->latest()
            ->first();
        $bannerImage = $bannerImage?->image->filepath;

        $courseThumbnail = $course
            ->getImage()
            ->where('type', 'course_thumbnail')
            ->latest()
            ->first();
        $courseThumbnail = $courseThumbnail?->image->filepath;
    }
    ?>

    <div class="detail-bg" data-style-background="{{ \App\Classes\Helpers\Image::getImageAsSize($bannerImage, 'm') }}"
        data-theme-course="{{ $course->theme_color }}">
        <div class="container">
            <div class="row align-items-center justify-content-around">
                <div class="col-md-6">
                    <h3 class="">
                        {!! $course->tagline !!}
                    </h3>
                    <h1 class="elementor-heading-title elementor-size-default implement-theme-color">
                        {{ $course->course_name }}</h1>
                    <div class="text-white">
                        {!! htmlspecialchars_decode($course->course_short_description) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="en-card">
                        <div class="en-img">
                            <img src="{{ \App\Classes\Helpers\Image::getImageAsSize($courseThumbnail, 's') }}"
                                class="w-100" alt="{{ $course->course_name }}">
                        </div>
                        <div class="en-content">
                            <button data-method="post"
                                data-action="{{ route('frontend.courses.enroll.enroll', ['course' => $course]) }}"
                                class="en-btn ajax-button-confirm">
                                ENROLL NOW
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('frontend.components.lister', ['model' => $course])
@endsection
