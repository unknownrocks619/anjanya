@extends('themes.admin.master')

@push('page_title')
    - Project List
@endpush

@section('main-content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>All Project List</h3>
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
                        <a href="{{route('admin.org.projects.add')}}" class="btn btn-primary">
                            Add New Project
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            @include('backend.organisation.projects.list', ['projects' => $projects])
                        </div>
                    </div>
                </div>
            </div>
            <!-- Zero Configuration  Ends-->
        </div>
    </div>
@endsection
