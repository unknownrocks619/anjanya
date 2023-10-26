@extends('themes.admin.master')

@push('page_title')
    - Events - Create New
@endpush

@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card action-bar align-content-end mt-3 rounded-3" style="background: #e0e0e0">
                <div class="card-body py-0 ps-2">
                    <a href="{{route('admin.events.list')}}" class="btn btn-danger">
                        <i class="fa fa-arrow-left"></i>
                        Go Back
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <form action="{{route('admin.events.create')}}" method="post" class="ajax-form">
                <div class="col-sm-12">
                    <div class="card rounded-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="event_name">
                                                    Event Name
                                                    <sup class="text danger">*</sup>
                                                </label>
                                                <input type="text" name="event_name" id="event_name"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group d-flex align-items-center mt-1">
                                                <div class="m-t-15 m-checkbox-inline">
                                                    <div
                                                        class="form-check form-check-inline checkbox checkbox-dark mb-0">
                                                        <input checked="" class="form-check-input" name="active"
                                                               id="active" type="checkbox" data-bs-original-title=""
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
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="event_start_date">Event Start</label>
                                                <input type="datetime-local" name="event_start" id="event_start"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="event_end_date">Event End</label>
                                                <input type="datetime-local" name="event_end" id="event_end"
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="intro_description">
                                            Intro description
                                        </label>
                                        <textarea name="intro_description" id="intro_description"
                                                  class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="short_description">Short Description</label>
                                        <textarea name="short_description" id="short_description"
                                                  class="form-control tiny-mce"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="full_description">Full Description</label>
                                        <textarea name="full_description" id="full_description"
                                                  class="form-control tiny-mce"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary">
                                Save Event Detail
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Zero Configuration  Ends-->
        </div>
    </div>
@endsection
