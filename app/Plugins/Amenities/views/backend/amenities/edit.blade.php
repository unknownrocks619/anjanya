@extends('themes.admin.master')

@push('page_title')
    - Amenities - {{$amenity->amenities}}
@endpush

@section('main-content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Amenity :: {{$amenity->amenities}}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <form action="{{route('admin.amenities.update',['amenity' => $amenity])}}" class="ajax-form" method="post">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <a class="btn btn-warning" href="{{route('admin.amenities.list')}}">
                                Go Back
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row g-2">
                                <div class="mb-3 col-md-4 mt-0">
                                    <div class="form-group">
                                        <label for="con-name">Amenity Name</label>
                                        <input type="text" name="amenities_name" id="amenities_name"
                                               class="form-control" value="{{$amenity->amenities}}"/>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-4 mt-0">
                                    <div class="form-group">
                                        <label for="con-name">Amenity Type</label>
                                        <input type="text" name="amenity_type" id="amenity_type"
                                               value="{{$amenity->amenities_type}}" class="form-control" readonly/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Icon</label>
                                        <input type="text" name="amenity_icon" value="{{$amenity->icon_name}}"
                                               id="amenity_icon" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group d-flex align-items-center mt-1">
                                        <div class="m-t-15 m-checkbox-inline">
                                            <div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                                                <input {{ $amenity->active ? 'checked' : '' }} class="form-check-input"
                                                       name="active" id="active" value="1" type="checkbox" data-bs-original-title=""
                                                       title="Active">
                                                <label class="form-check-label" for="active">
                                                    Active
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-12 text-end">
                                    <button type="submit" class="btn btn-primary">
                                        Update Amenity
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Zero Configuration  Ends-->
        </div>
    </div>
@endsection
