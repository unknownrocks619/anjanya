@extends('themes.admin.master')

@push('page_title')
    - Slider Album
@endpush

@section('main-content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Slider Album</h3>
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
                        <a class="btn btn-primary" data-bs-target='#newAlbum' data-bs-toggle='modal' href="#">
                            <i class="fa fa-plus"></i>
                            Add New Album
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover display datatable-lister" id='user-list-table'>
                                <thead>
                                    <tr>
                                        <th>Album Name</th>
                                        <th>Total Items</th>
                                        <th>Status</th>
                                        <td>

                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($albums as $album)
                                        <tr>
                                            <td>
                                                <a
                                                    class="text-underline"
                                                    href="{{ route('admin.slider.items.list', ['album' => $album]) }}">{{ $album->album_name }}</a>
                                            </td>
                                            <td>
                                                {{ $album->sliders_count }}
                                            </td>
                                            <td>
                                                {!! \App\Classes\Helpers\Status::active_label($album->status) !!}
                                            </td>
                                            <td>
                                                <ul class="action">
                                                    <li class="edit"> <a
                                                            href="{{ route('admin.slider.items.list', ['album' => $album]) }}"><i
                                                                class="icon-eye text-primary"></i></a>
                                                    </li>
                                                    <li class="edit"> <a
                                                            class="ajax-modal" data-bs-target="#edit_album"
                                                            data-bs-toggle="modal"
                                                            data-method="get"
                                                            data-action="{{ route('admin.slider.album.edit', ['album' => $album]) }}"
                                                            href=""><i
                                                                class="icon-pencil-alt"></i></a>
                                                    </li>
                                                    <li class="delete">
                                                        <a href="#" class="data-confirm"
                                                            data-confirm="This action cannot be undone. " data-method="post"
                                                            data-action="{{ route('admin.slider.album.delete', ['album' => $album]) }}">
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

    <x-modal id='newAlbum'>
        @include('backend.sliders.album.modal.new-album')
    </x-modal>
    <x-modal id="edit_album"></x-modal>
@endsection
