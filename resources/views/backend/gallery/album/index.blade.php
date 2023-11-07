@extends('themes.admin.master')

@push('page_title')
    - Gallery Albums
@endpush

@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card action-bar align-content-end mt-3 rounded-3" style="background: #e0e0e0">
                <div class="card-body py-0 ps-2">
                    <a href="#" data-bs-target="#new-album" data-bs-toggle="modal" class="btn btn-danger">
                        <i class="fa fa-plus"></i>
                        Add New Album
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
                                    <th>Album Name</th>
                                    <th>No. of Images</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($albums as $album)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$album->album_name}}</td>
                                        <td>{{$album->items_count}}</td>
                                        <td>{!!   \App\Classes\Helpers\Status::active_label($album->active)  !!}</td>
                                        <td>
                                            <a href="{{route('admin.gallery-items.list',['album' => $album])}}" title="Add Images"> Add Images</a> | Edit | Delete
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
    <x-modal id="new-album">
        @include('backend.gallery.modal.new-album')
    </x-modal>
@endsection
