@extends('themes.frontend.users.auth', ['bodyAttribute' => ['class' => 'bg-white landing-page'], 'isLanding' => true, 'isFooter' => true])

@push('title')
    | All Courses
@endpush

@section('main_content')
    <div class="explore-banner">
        <div class="container">
            <h1>Explore Upschool's Courses</h1>
            <div class="text-center text-white"><span>10-Week Courses</span> <span class="px-3">|</span> <span>Short
                    Courses</span></div>
        </div>
    </div>

    <div class="container py-5">
        <?php
        /**
         * @info To Be replace by actual Category
         */
        ?>
        <h3 class="ex-title">All Course</h3>


        <div class="row pb-4">
            @foreach ($courses as $course)
                @include('frontend.courses.tabs.lister-items', ['course' => $course])
            @endforeach
        </div>
    </div>
@endsection
