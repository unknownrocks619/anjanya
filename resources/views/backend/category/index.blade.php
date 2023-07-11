@extends('themes.admin.master')

@push('page_title')
    - Categories
@endpush

@section('main-content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>All Categories</h3>
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
                        <a href="" data-bs-toggle='modal' class="btn btn-primary" data-bs-target="#new_category">
                            Add New Category
                        </a>
                    </div>
                </div>
            </div>
            <!-- Zero Configuration  Ends-->
            @include('backend.category.list', ['categories' => $categories])
        </div>
    </div>
    <x-modal id="new_category">
        @include('backend.category.modal.new-category')
    </x-modal>
@endsection
