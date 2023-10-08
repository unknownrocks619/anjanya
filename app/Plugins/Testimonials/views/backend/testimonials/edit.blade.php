@extends('themes.admin.master')

@push('page_title')
    - Testimonials - Update
@endpush

@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card action-bar align-content-end mt-3 rounded-3" style="background: #e0e0e0">
                <div class="card-body py-0 ps-2">
                    <a href="{{route('admin.testimonials.list')}}" class="btn btn-danger">
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
                <form enctype="multipart/form-data" action="{{route('admin.testimonials.update',['testimonial' => $testimonial])}}" method="post">
                    @csrf
                    <div class="card rounded-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="full_name">
                                            Full Name
                                            <sup class="text-danger">*</sup>
                                        </label>
                                        <input type="text" name="full_name" id="full_name" class="form-control" value="{{$testimonial->full_name}}"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="">Select Gender</option>
                                            <option value="male" @if($testimonial->gender == 'male') selected @endif>Male</option>
                                            <option value="female" @if($testimonial->gender == 'female') selected @endif>Female</option>
                                            <option value="other" @if($testimonial->gender == 'other') selected @endif>Other</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="source">Source
                                            <sup class="text-danger">*</sup>
                                        </label>
                                        <select name="source" id="source" class="form-control">
                                            <option value="booking.com"  @if($testimonial->source == 'booking.com') selected @endif>Booking.com</option>
                                            <option value="tripadvisor.com"   @if($testimonial->source == 'tripadvisor.com') selected @endif>Trip Adivisor</option>
                                            <option value="agoda.com"  @if($testimonial->source == 'agoda.com') selected @endif>Agoda</option>
                                            <option value="hotels.com"  @if($testimonial->source == 'hotels.com') selected @endif>hotels</option>
                                            <option value="local-broker"  @if($testimonial->source == 'local-borker') selected @endif>Local Borkers</option>
                                            <option value="walk-in"   @if($testimonial->source == 'walk-in') selected @endif>WalkIn</option>
                                            <option value="other" @if($testimonial->source == 'other') selected @endif>Other</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="profession">Profession</label>
                                        <input type="text" name="profession" value="{{$testimonial->profession}}" id="profession" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="message">
                                            Comment
                                            <sup class="text-danger">*</sup>
                                        </label>
                                        <textarea name="testimonial" class="form-control">{{$testimonial->comment}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="rating">Rating
                                            <sup class="text-danger">*</sup>
                                        </label>
                                        <input type="text" class="form-control" value="{{$testimonial->rating}}" name="rating"/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="rating">Images</label>
                                        <input type="file" class="form-control" name="image"/>
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

