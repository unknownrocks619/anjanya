@extends('themes.admin.master')

@push('page_title')
    - Customer Lists
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
            <div class="card">
                <div class="card-body">
                    <div class="col-md-12 my-3">
                        <form class="ajax-component-form ajax-append" enctype="multipart/form-data"
                            action="{{ route('admin.users.customers.upload-file', ['customer' => auth()->guard('admin')->user()]) }}"
                            method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="excel_file">Bulk Upload (Excel / CSV) File</label>
                                        <input type="file" name="file" id="file" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 text-end">
                                    <button type="submit" class="btn btn-danger">Upload File</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <button class="btn btn-primary" data-bs-target='#new-user' data-bs-toggle='modal'>
                            Add New User
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover display datatable-lister" id='user-list-table'>
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Role</th>
                                        <th>Country</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>
                                                {{ $user->getFullName() }}
                                                <br />
                                                <small class="text-muted">
                                                    {{ '@' . $user->username }}
                                                </small>
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                {!! $user->getUserStatus() !!}
                                            </td>
                                            <td>User</td>
                                            <td>{{ $user->getCountry?->name }}</td>
                                            <td>
                                                <ul class="action">
                                                    <li class="edit"> <a
                                                            href="{{ route('admin.users.customers.edit', ['customer' => $user]) }}"><i
                                                                class="icon-pencil-alt"></i></a>
                                                    </li>
                                                    <li class="edit"> <a target="_blank"
                                                            href="{{ route('admin.users.customers.login_as_user', ['user' => $user]) }}"><i
                                                                class="icofont icofont-open-eye text-warning"></i></a>
                                                    </li>
                                                    <li class="delete"><a href="#"><i class="icon-trash"></i></a></li>
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
        @include('backend.users.modals.new-form')
    </x-modal>
@endsection
