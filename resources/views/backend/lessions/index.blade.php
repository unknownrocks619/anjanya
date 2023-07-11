@extends('themes.admin.master')

@push('page_title')
    - Lessons
@endpush

@section('main-content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>All Lessons</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <a href="{{ route('admin.lessions.create') }}" class="btn btn-primary">
                            Add New Lesson
                        </a>
                    </div>
                    @include('backend.lessions.list', ['lessions' => $lessions])
                </div>
            </div>
            <!-- Zero Configuration  Ends-->
        </div>
    </div>
    <x-modal id='newCourseModal'>
        @include('backend.courses.modal.new')
    </x-modal>
@endsection
