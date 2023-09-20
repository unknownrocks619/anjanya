@extends('themes.admin.master')

@push('page_title')
    - Rooms
@endpush

@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card action-bar align-content-end mt-3 rounded-3" style="background: #e0e0e0">
                <div class="card-body py-0 ps-2">
                    <a href="{{route('admin.room.create')}}" class="btn btn-danger">
                        <i class="fa fa-plus"></i>
                        Add Room
                    </a>
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
                        <div class="table-responsive">
                            <table class="table table-hover display datatable-lister" id='user-list-table'>
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Room Name</th>
                                    <th>Status</th>
                                    <th>Price / Night</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rooms as $room)
                                        <tr>
                                            <td>
                                            </td>
                                            <td>
                                                {{$room->room_name}}
                                            </td>
                                            <td>
                                                {!!  \App\Classes\Helpers\Status::status_label($room->status) !!}
                                            </td>
                                            <td>
                                                $ {{$room->price}}
                                            </td>
                                            <td>
                                                <ul class="action">
                                                    <li class="edit">
                                                        <a href="{{route('admin.room.edit',['room' => $room->getKey()])}}">
                                                            <i class="icon-pencil-alt"></i>
                                                        </a>
                                                    </li>
                                                    <li class="delete">
                                                        <a href="#" data-confirm="Are you sure?" class="data-confirm" data-method="post" data-action="{{route('admin.room.delete',['room' => $room->getKey()]}}"><i class="icon-trash"></i></a>
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
@endsection
