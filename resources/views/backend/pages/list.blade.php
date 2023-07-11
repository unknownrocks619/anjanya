@extends('themes.admin.master')

@push('page_title')
    - Pages
@endpush

@section('main-content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Pages</h3>
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
                            Create New Page
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover display datatable-lister" id='user-list-table'>
                                <thead>
                                    <tr>
                                        <th>Page title</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pages as $page)
                                        <tr>
                                            <td>{{ $page->title }}</td>
                                            <td>{!! \App\Classes\Helpers\Status::active_label($page->active) !!}</td>
                                            <td>{{ $page->created_at }}</td>
                                            <td>
                                                <ul class="action">
                                                    <li class="edit"> <a
                                                            href="{{ route('admin.pages.edit', ['page' => $page]) }}"><i
                                                                class="icon-pencil-alt"></i></a>
                                                    </li>
                                                    <li class="delete">
                                                        <a href="#" class="data-confirm"
                                                            data-confirm="Are you Sure ? " data-method="post"
                                                            data-action="{{ route('admin.pages.delete', ['page' => $page]) }}">
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
    <x-modal id='new-user'>
        @include('backend.pages.modals.new')
    </x-modal>
@endsection
