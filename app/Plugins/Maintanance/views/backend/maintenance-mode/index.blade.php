@extends('themes.admin.master')

@push('page_title')
    - Rooms
@endpush

@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card action-bar align-content-end mt-3 rounded-3" style="background: #e0e0e0">
                <div class="card-body py-0 ps-2">
                    <button type="button" data-bs-target="#maintenanceModel" data-bs-toggle="modal" class="btn btn-danger">
                        <i class="fa fa-plus"></i>
                        New Maintenance Setting
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card rounded-3">
                    <div class="card-body">
                        <p class="alert alert-info">
                            Only Last Active settings will be visible on frontend.
                        </p>
                        <div class="table-responsive">
                            <table class="table table-hover display datatable-lister" id='user-list-table'>
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Setting Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Zero Configuration  Ends-->
        </div>
    </div>
    <x-modal id='maintenanceModel'>
        @include('Maintanance::backend.modal.maintenance-modal')
    </x-modal>
@endsection
