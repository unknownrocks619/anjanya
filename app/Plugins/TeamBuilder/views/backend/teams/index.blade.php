@extends('themes.admin.master')
@push('page_title')- Team Member Album @endpush

@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card action-bar align-content-end mt-3 rounded-3" style="background: #e0e0e0">
                <div class="card-body py-0 ps-2">
                    <a href="" data-bs-target='#teamGroup' data-bs-toggle='modal' class="btn btn-danger">
                        <i class="fa fa-plus"></i>
                        New Team Group
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
                                    <th>Member Group</th>
                                    <th>Total Member</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($teams as $team)
                                        <tr>
                                            <td>
                                                {{$team->name}}
                                            </td>
                                            <td>
                                                {{ $team->members->count()}}
                                            </td>
                                            <td>
                                                {!! $team->description !!}
                                            </td>
                                            <td>
                                                <ul class="action">
                                                    <li class="edit">
                                                        <a href="{{route('admin.teams.edit',['team' => $team,'tab'=>'general'])}}">
                                                            <i class="icon-pencil-alt"></i>
                                                        </a>
                                                    </li>
                                                    <li class="delete">
                                                        <a href="#" data-confirm="You are about to delete team group. Do you wish to continue ?" class="data-confirm" data-method="post" data-action="{{route('admin.teams.delete.team',['team' => $team])}}"><i class="icon-trash"></i></a>
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

    <x-modal id="teamGroup">
        @include('TeamBuilder::backend.teams.modals.new-group')
    </x-modal>
@endsection
