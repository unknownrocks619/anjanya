@extends('themes.admin.master')

@push('page_title')
    @if (isset($course) && !is_null($course))
        - {{ $course->course_name }}
    @endif
    @if (isset($chapter) && !is_null($chapter))
        - {{ $chapter->chapter_name }}
    @endif
    - New Lession
@endpush


<?php

$backButton = route('admin.lessions.list');
$formAction = route('admin.lessions.create');
if (isset($chapter) && !is_null($chapter)) {
    $backButton = route('admin.chapters.edit', ['chapter' => $chapter, 'current_tab' => 'lessions']);
    $formAction = route('admin.lessions.create', ['current_tab' => 'chapters', 'chapter' => $chapter]);
}

if (isset($course) && !is_null($course)) {
    $backButton = route('admin.chapters.edit', ['chapter' => $chapter, 'course' => $course, 'current_tab' => 'lessions']);
    $formAction = route('admin.lessions.create', ['chapter' => $chapter, 'course' => $course, 'current_tab' => 'general']);
}

?>

@section('main-content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>
                        New Lession

                        @if (isset($chapter) && !is_null($chapter))
                            - {{ $chapter->chapter_name }}
                        @endif

                        @if (isset($course) && !is_null($course))
                            - {{ $course->course_name }}
                        @endif
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <form action="{{ $formAction }}" class="ajax-form" method="post">
            <div class="row">
                <!-- Zero Configuration  Starts-->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0 d-flex justify-content-end">

                            <a class="btn btn-warning" href='{{ $backButton }}'>
                                Go Back
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row g-2">
                                <div class="mb-3 col-md-12 mt-0">
                                    <div class="form-group">
                                        <label for="lession_name">Lession Title</label>
                                        <input class="form-control" id="lession_name" name="lession_name" type="text"
                                            required="" placeholder="Lession Title" autocomplete="off" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="mb-3 col-md-12 mt-0">
                                    <div class="form-group">
                                        <label for="intro_text">Intro Text</label>
                                        <textarea name="intro_text" id="intro_text" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>

                            @if (!isset($course))
                                <div class="row my-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="course">
                                                Select Course
                                            </label>
                                            <select name="course" data-action="{{ route('admin.ajax-select2.chapters') }}"
                                                class="form-control lession-course-selection">
                                                <option value="" class="remove-after-click">Click to Select course
                                                </option>
                                                @foreach (\App\Models\Course::where('active', true)->get() as $course)
                                                    <option value="{{ $course->getKey() }}">
                                                        {{ $course->course_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group chapter-group">
                                            <label for="chapters">
                                                Chapters
                                            </label>
                                            <select name="chapters" id="chapters" class="form-control chapter_selections">
                                                <option value="">Please select course first</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <div class="form-g">
                                        <label for="short_description">Short Description</label>
                                        <textarea name="short_description" id="short_description" class="form-control tiny-mce"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <div class="form-g">
                                        <label for="full_description">Full Description</label>
                                        <textarea name="full_description" id="full_description" class="form-control tiny-mce"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group d-flex align-items-center mt-1">
                                                <div class="m-t-15 m-checkbox-inline">
                                                    <div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                                                        <input class="form-check-input" name="active" id="active"
                                                            type="checkbox" data-bs-original-title="Active" title="Active">
                                                        <label class="form-check-label" for="active">
                                                            Active
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group d-flex align-items-center mt-1">
                                                <div class="m-t-15 m-checkbox-inline">
                                                    <div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                                                        <input checked class="form-check-input lession_video_type"
                                                            name="enable_youtube_video" id="enable_youtube_video"
                                                            type="checkbox" data-bs-original-title="Enable Youtube Video"
                                                            title="Enable Youtube Video">
                                                        <label class="form-check-label" for="enable_youtube_video">
                                                            Enable Youtube Video
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group d-flex align-items-center mt-1">
                                                <div class="m-t-15 m-checkbox-inline">
                                                    <div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                                                        <input checked class="form-check-input lession_video_type"
                                                            name="enable_vimeo_video" id="enable_vimeo_video"
                                                            type="checkbox" data-bs-original-title="Enable Vimeo Video"
                                                            title="Enable Vimeo Video">
                                                        <label class="form-check-label" for="enable_vimeo_video">
                                                            Enable Vimeo Video
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group d-flex align-items-center mt-1">
                                                <div class="m-t-15 m-checkbox-inline">
                                                    <div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                                                        <input checked class="form-check-input lession_video_type"
                                                            name="enable_preview" id="enabe_intro_video" type="checkbox"
                                                            data-bs-original-title="Enable Intro Video"
                                                            title="Enable Intro Video">
                                                        <label class="form-check-label" for="enabe_intro_video">
                                                            Enable Intro Video
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-12 lession_youtube_link">
                                            <div class="form-group">
                                                <label for="youtube_link">Youtube Video Url</label>
                                                <input type="url" value="" name='youtube_url'
                                                    class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-12 lession_vimeo_link">
                                            <div class="form-group">
                                                <label for="youtube_link">Vimeo Video Url</label>
                                                <input type="url" value="" name="vimeo_url"
                                                    class="form-control" />
                                            </div>

                                        </div>
                                        <div class="col-md-12 preview_link">
                                            <div class="form-group">
                                                <label for="preview_link">Preview Link</label>
                                                <input type="url" value="" class="form-control"
                                                    name="preview_url" />
                                            </div>
                                            <span class="text-warning">
                                                Only Vimeo Link is Supported.
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Zero Configuration  Ends-->
            </div>
            <div class="row my-2">
                <div class="col-md-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        Create new Lession
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
