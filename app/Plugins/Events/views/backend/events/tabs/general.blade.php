<form action="{{route('admin.events.edit',['event' => $event])}}" method="post" class="ajax-form">
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
                                    <input type="text" name="event_name" id="event_name" value="{{$event->event_title}}"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="event_slug">
                                        Event Slug
                                        <sup class="text danger">*</sup>
                                    </label>
                                    <input type="text" name="event_value" id="event_slug" class="form-control" value="{{$event->event_slug}}" requried>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group d-flex align-items-center mt-1">
                                    <div class="m-t-15 m-checkbox-inline">
                                        <div
                                            class="form-check form-check-inline checkbox checkbox-dark mb-0">
                                            <input @if($event->active) checked=""  @endif class="form-check-input" name="active"
                                                   id="active" type="checkbox" data-bs-original-title=""
                                                   title="Active">
                                            <label class="form-check-label" for="active">
                                                Active
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="event_contact_person">
                                        Event Contact Person
                                    </label>
                                    <input type="text" name="event_contact_person" value="{{$event->event_contact_person}}" id="event_contact_person" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="event_contact_number">
                                        Event Contact Number
                                    </label>
                                    <input type="text" name="event_contact_number" id="event_contact_number" value="{{$event->event_contact_number}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="event_contact_number">
                                        Event Contact Email
                                    </label>
                                    <input type="text" name="event_contact_email" value="{{$event->event_contact_email}}" id="event_contact_email" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="event_start_date">Event Start</label>
                                    <input value="{{$event->event_start_date}}" type="datetime-local" name="event_start" id="event_start"
                                           class="form-control"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="event_end_date">Event End</label>
                                    <input value="{{$event->event_end_date}}" type="datetime-local" name="event_end" id="event_end"
                                           class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="event_location">Event Location</label>
                                    <input type="text" name="event_location" id="event_location" value="{{$event->event_location}}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="event_map">Event map</label>
                                    <textarea name="event_map" id="event_map"
                                              class="form-control">{{$event->event_location_iframe}}</textarea>
                                    <span class="help-block text-danger">
                                        Please Paste your map iframe code here.
                                    </span>
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
                                      class="form-control">{{$event->intro_description}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="short_description">Short Description</label>
                            <textarea name="short_description" id="short_description"
                                      class="form-control tiny-mce">{{$event->short_description}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="full_description">Full Description</label>
                            <textarea name="full_description" id="full_description"
                                      class="form-control tiny-mce">{{$event->full_description}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">
                    Update Event Detail
                </button>
            </div>
        </div>
    </div>
</form>
