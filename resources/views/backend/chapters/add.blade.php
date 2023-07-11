@extends('themes.admin.master')

@push('page_title')
    @if (isset($course) && !is_null($course))
        - {{ $course->course_name }}
    @endif - New Chapter
@endpush


<?php

$backButton = route('admin.chapters.list');
$formAction = route('admin.chapters.create');
if (isset($course) && !is_null($course)) {
    $backButton = route('admin.courses.edit', ['course' => $course, 'current_tab' => 'chapters']);
    $formAction = route('admin.chapters.create', ['current_tab' => 'chapters', 'course' => $course]);
}

?>


@section('main-content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>
                        New Chapter @if (isset($course))
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
                                        <label for="chapter_name">Chapter name</label>
                                        <input class="form-control" id="chapter_name" name="chapter_name" type="text"
                                            required="" placeholder="Chapter name" autocomplete="off" value="">
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
                                @if (!isset($course))
                                    <div class="col-md-6">
                                        <div class="form-group mt-1">
                                            <label for="">
                                                Select Course
                                            </label>
                                            <select name="course" class="form-control">
                                                @foreach (\App\Models\Course::where('active', true)->get() as $course)
                                                    <option value="{{ $course->getKey() }}">
                                                        {{ $course->course_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif
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
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Zero Configuration  Ends-->
            </div>
            <div class="row my-2">
                <div class="col-md-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        Create new Chapter
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
