@extends('themes.admin.master')

@push('page_title')
    - Events
@endpush

@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card action-bar align-content-end mt-3 rounded-3" style="background: #e0e0e0">
                <div class="card-body py-0 ps-2">
                    <a href="{{route('admin.events.create')}}" class="btn btn-danger">
                        <i class="fa fa-plus"></i>
                        Create new Events
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
                                    <th>Event Name</th>
                                    <th>Status</th>
                                    <th>Start Date</th>
                                    <th>End date</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($events as $event)
                                    <tr>
                                        <td>
                                        </td>
                                        <td>
                                            {{$event->event_title}}
                                        </td>
                                        <td>
                                            {!!  \App\Classes\Helpers\Status::active_label($event->active) !!}
                                        </td>
                                        <td>

                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                            <ul class="action">
                                                <li class="edit">
                                                    <a href="{{route('admin.events.edit',['event' => $event->getKey()])}}">
                                                        <i class="icon-pencil-alt"></i>
                                                    </a>
                                                </li>
                                                <li class="delete">
                                                    <a href="#"
                                                       data-confirm="Are you sure?"
                                                       class="data-confirm"
                                                       data-method="post"
                                                       data-action="{{route('admin.events.delete',['event' => $event->getKey()])}}">
                                                        <i class="icon-trash"></i>
                                                    </a>
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
