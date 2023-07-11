@extends('themes.admin.master')

@push('page_title')
    - User List
@endpush

@section('main-content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>User List</h3>
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
                        <button class="btn btn-primary" data-bs-target='#new-user' data-bs-toggle='modal'>
                            Add New User
                        </button>
                    </div>
                    @include('backend.users.user-list', ['users' => $users])
                </div>
            </div>
            <!-- Zero Configuration  Ends-->
        </div>
    </div>
    <x-modal id='new-user'>
        @include('backend.users.modals.new-form')
    </x-modal>
@endsection
