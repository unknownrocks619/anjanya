<?php
$backButton = route('admin.chapters.list');
$formAction = route('admin.chapters.edit', ['chapter' => $chapter, 'current_tab' => 'general']);
$title = ' - Edit';

if (isset($course) && !is_null($course)) {
    $title .= ' - ' . $course->course_name;
    $backButton = route('admin.courses.edit', ['current_tab' => 'chapters', 'course' => $course]);
    $formAction = route('admin.chapters.edit', ['chapter' => $chapter, 'current_tab' => 'general', 'course' => $course]);
}

$title .= ' - ' . $chapter->chapter_name;
?>
@extends('themes.admin.master')

@push('page_title')
    {{ $title }}
@endpush

@section('main-content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>
                        Edit
                        @if (isset($chapter) && !is_null($course))
                            - {{ $course->course_name }}
                        @endif
                        - {{ $chapter->chapter_name }}
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 d-flex justify-content-end">
                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ $backButton }}" class="btn btn-warning">
                                    Back
                                </a>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-pills nav-danger bg-light p-3" id="pills-danger-tab" role="tablist">
                            @foreach ($tabs as $key => $value)
                                <li class="nav-item mx-3">
                                    <a class="nav-link {{ $key == $current_tab ? 'active' : '' }}"
                                        id="pills-danger-{{ $key }}-tab" data-bs-toggle="pill"
                                        href="#pills-danger-{{ $key }}" role="tab"
                                        aria-controls="pills-danger-home" aria-selected="true">

                                        {{ __('admin/chapters/edit.' . $key) }}

                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        <div class="tab-content" id="pills-danger-tabContent">
                            @foreach ($tabs as $key => $content)
                                <div class="mt-4 tab-pane fade {{ $key == $current_tab ? 'active show' : '' }}"
                                    id="pills-danger-{{ $key }}" role="tabpanel"
                                    aria-labelledby="pills-danger-{{ $key }}-tab">
                                    @include('backend.chapters.tabs.' . $key, [
                                        'content' => $content,
                                        'chapter' => $chapter,
                                        'model' => $chapter,
                                        'backButton' => $backButton,
                                        'formAction' => $formAction,
                                        'course' => $course,
                                    ])
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- Zero Configuration  Ends-->
        </div>
    </div>
@endsection
