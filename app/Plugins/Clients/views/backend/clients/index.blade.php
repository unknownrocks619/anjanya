@extends('themes.admin.master')

@push('page_title')
    - Clients
@endpush

@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card action-bar align-content-end mt-3 rounded-3" style="background: #e0e0e0">
                <div class="card-body py-0 ps-2">
                    <a href="" class="btn btn-danger" data-bs-target="#new_testimonial" data-bs-toggle="modal">
                        <i class="fa fa-plus"></i>
                        Add New Clients
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
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($clients as $client)
                                    <tr>
                                        <td>
                                            {{$client->client_name}}
                                        </td>
                                        <td>
                                            <img src="{{\App\Classes\Helpers\Image::getImageAsSize($client->image,'xs')}}" />
                                        </td>
                                        <td>
                                            <ul class="action">
                                                <li class="edit">
                                                    <a href="{{route('admin.clients.edit',['client' => $client])}}">
                                                        <i class="icon-pencil-alt"></i>
                                                    </a>
                                                </li>
                                                <li class="delete">
                                                    <a href="#" data-confirm="Are you sure?" class="data-confirm" data-method="post" data-action="{{route('admin.clients.delete',['client' => $client])}}"><i class="icon-trash"></i></a>
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
    <x-modal id='new_testimonial'>
        @include('Clients::backend.clients.modal.new')
    </x-modal>
@endsection
