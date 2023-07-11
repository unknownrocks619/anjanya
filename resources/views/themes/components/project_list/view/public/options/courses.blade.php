<?php
$courses = \App\Models\Course::whereIn('id', $courses)
    ->where('active', true)
    ->with(['getImage'])
    ->orderBy('sort_by', 'asc')
    ->get();
?>

@if (count($courses))

    <div class="featured-section1 bg-white">
        <div class="container-fluid">
            <div class="row mt-2">
                @foreach ($courses as $course)
                    <div class="col-md-{{ $values->column }}">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="mb-3" style="color: #B81242 !important">Course name</h2>
                                <h4>
                                    {{ $course->course_name }}
                                </h4>
                                <a href="/course/{$course->slug}">
                                    Learn More →
                                </a>
                            </div>
                            <div class="col-md-12">
                                @if ($course->enable_intro_video && $course->intro_video)
                                    @if ($course->intro_video->video_type == 'vimeo')
                                        {!! \App\Classes\Helpers\Video::renderVimeo($course->intro_video->video->id) !!}
                                    @endif
                                    @if ($course->intro_video->video_type == 'youtube')
                                        {!! \App\Classes\Helpers\Video::renderYoutube($course->intro_video->video->id) !!}
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
