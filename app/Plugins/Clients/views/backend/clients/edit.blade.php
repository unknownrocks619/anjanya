@extends('themes.admin.master')

@push('page_title')
    - {{$client->client_name}} - Update
@endpush

@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card action-bar align-content-end mt-3 rounded-3" style="background: #e0e0e0">
                <div class="card-body py-0 ps-2">
                    <a href="{{route('admin.clients.list')}}" class="btn btn-danger">
                        <i class="fa fa-arrow-left"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <form enctype="multipart/form-data" action="{{route('admin.clients.update',['client' => $client])}}" method="post">
                    @csrf
                    <div class="card rounded-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="client_name">
                                            Client name
                                            <sup class="text-danger">*</sup>
                                        </label>
                                        <input type="text" name="client_name" id="client_name" class="form-control" value="{{$client->client_name}}"/>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="client_image">Client Image</label>
                                        <input type="file" name="image" id="client_image" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-12 text-end">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Zero Configuration  Ends-->
        </div>
    </div>
@endsection

