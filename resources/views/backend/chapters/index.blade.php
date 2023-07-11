@extends('themes.admin.master')

@push('page_title')
    - Chapters
@endpush

@section('main-content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>All Chapters</h3>
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
                        <a href="{{ route('admin.chapters.create') }}" class="btn btn-primary">
                            Add New Chapter
                        </a>
                    </div>
                    @include('backend.chapters.list', ['chapters' => $chapters])
                </div>
            </div>
            <!-- Zero Configuration  Ends-->
        </div>
    </div>
@endsection
