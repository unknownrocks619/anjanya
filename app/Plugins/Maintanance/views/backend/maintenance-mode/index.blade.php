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
                                    <th>
                                        Total Page
                                    </th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($modes as $mode)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>
                                                {{$mode->mode_name}}
                                            </td>
                                            <td>
                                                {!! \App\Classes\Helpers\Status::active_label($mode->active) !!}
                                            </td>
                                            <td>
                                                {{$mode->buttons()->count()}}
                                            </td>
                                            <td>
                                                <ul class="action">
                                                    <li class="edit">
                                                        <a href="{{route('admin.maintenance.edit',['mode' => $mode])}}">
                                                            <i class="icon-pencil-alt"></i>
                                                        </a>
                                                    </li>
                                                    <li class="delete">
                                                        <a href="#" data-confirm="Are you sure?" class="data-confirm" data-method="post" data-action="{{route('admin.maintenance.delete',['mode' => $mode->getKey()])}}"><i class="icon-trash"></i></a>
                                                    </li>
                                                </ul>
                                            </td>

                                        </tr>
                                    @endforeach
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
