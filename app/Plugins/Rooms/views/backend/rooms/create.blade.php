@extends('themes.admin.master')

@push('page_title')
    - Rooms
@endpush

@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card action-bar align-content-end mt-3 rounded-3" style="background: #e0e0e0">
                <div class="card-body py-0 ps-2">
                    <a href="{{route('admin.room.list')}}" class="btn btn-danger">
                        <i class="fa fa-arrow-left"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="card rounded-3">
        <form action="{{route('admin.room.store')}}" method="post" class="ajax-form">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="room_name">Room Name
                                <sup class="text-danger">*</sup>
                            </label>
                            <input type="text" name="room_name" id="room_name" class="form-control"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="room_slug">Slug Name</label>
                            <input type="text" name="room_slug" id="room_slug" class="form-control"
                                   placeholder="[Auto Generated]"/>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="room_intro">Room Intro Text</label>
                            <textarea name="room_intro" id="room_intro" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="short_description">
                                Short Description
                                <sup class="text-danger">*</sup>
                            </label>
                            <textarea name="short_description" id="short_description"
                                      class="form-control tiny-mce"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="full_description">
                                Full Description
                                <sup class="text-danger">*</sup>
                            </label>
                            <textarea name="full_description" id="full_description"
                                      class="form-control tiny-mce"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="price">
                                Price Per Night
                            </label>
                            <input type="text" name="price" id="price" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <label for="currency">
                                Currency
                            </label>
                            <select name="currency" id="currency" class="form-control">
                                <option value="USD" selected>USD</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-12 text-end">
                        <button type="submit" class="btn btn-primary">
                            Save Room
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
