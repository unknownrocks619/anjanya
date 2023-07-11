<?php
$goBack = route('admin.lessions.list');
$formAction = '';
$title = ' Edit - ' . $lession->lession_name;

if (isset($chapter) && !is_null($chapter)) {
    $goBack = route('admin.chapters.edit', ['chapter' => $chapter, 'current_tab' => 'lessions']);
    $formAction = route('admin.lessions.edit', ['lession' => $lession, 'current_tab' => 'general', 'chapter' => $chapter]);
    $title .= ' - ' . $chapter->chapter_name;
}
if (isset($course) && !is_null($course)) {
    $goBack = route('admin.chapters.edit', ['chapter' => $chapter, 'course' => $course, 'current_tab' => 'lessions']);
    $formAction = route('admin.lessions.edit', ['lession' => $lession, 'current_tab' => 'general', 'chapter' => $chapter, 'course' => $course]);
    $title .= ' - ' . $course->course_name;
}

?>
@extends('themes.admin.master')

@push('page_title')
    - {{ $title }}
@endpush

@section('main-content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>
                        {{ __('admin/lessions/edit.edit') }} - {{ $lession->lession_name }}
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
                                <a href="{{ $goBack }}" class="btn btn-warning">
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

                                        {{ __('admin/lessions/edit.' . $key) }}

                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        <div class="tab-content" id="pills-danger-tabContent">
                            @foreach ($tabs as $key => $content)
                                <div class="mt-4 tab-pane fade {{ $key == $current_tab ? 'active show' : '' }}"
                                    id="pills-danger-{{ $key }}" role="tabpanel"
                                    aria-labelledby="pills-danger-{{ $key }}-tab">
                                    @include('backend.lessions.tabs.' . $key, [
                                        'content' => $content,
                                        'course' => $course,
                                        'chapter' => $chapter,
                                        'model' => $lession,
                                        'formAction' => $formAction,
                                        'goBack' => $goBack,
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
