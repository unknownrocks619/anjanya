@extends('themes.frontend.users.auth', ['bodyAttribute' => ['class' => 'bg-white open', 'id' => 'home']])

@push('title')
    :: Course :: {{ $course->course_name }}
@endpush

@section('main_content')
    <div class="lms-wrapper">

        @include('frontend.courses.watch-partials.lession-sidebar', [
            'course' => $course,
            'chapters' => $course->chapters,
            'lession' => $lession,
        ])

        <div class="right-aside1">
            @include('frontend.courses.watch-partials.action-bar', ['course' => $course])

            <div class="scroll px-2">
                <div class="container lession_container">

                    @include('frontend.courses.watch-partials.lession-content', [
                        'lession' => $lession,
                        'course' => $course,
                    ])

                </div>
            </div>

        </div>
    </div>
@endsection
