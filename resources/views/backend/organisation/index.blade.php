@extends('themes.admin.master')

@push('page_title')
    - Organisation
@endpush


@section('main-content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Organisation List</h3>
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
                        <button class="btn btn-primary" data-bs-target='#new-organisation' data-bs-toggle='modal'>
                            {{ __('admin/organisation/label.add_organisation') }}
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover display datatable-lister" id='user-list-table'>
                                <thead>
                                    <tr>
                                        <th>Organisation</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($organisations as $org)
                                        <tr>
                                            <td>{{ $org->organisation_name }}</td>
                                            <td>{{ $org::ORG_TYPES[$org->type] }}</td>
                                            <td>
                                                <span
                                                    class='{{ $org->active ? 'badge rounded-pill badge-success px-1' : 'badge rounded-pill badge-danger px-1' }}'>
                                                    {{ $org->active ? ' Active ' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td>
                                                <ul class="action">
                                                    <li class="edit">
                                                        <a href="{{ route('admin.org.edit', ['org' => $org]) }}"><i
                                                                class="icon-pencil-alt"></i></a>
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
    <x-modal id='new-organisation'>
        @include('backend.organisation.modal.quick-form')
    </x-modal>
@endsection
