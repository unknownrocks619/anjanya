<form action="{{route('admin.maintenance.update',['mode' => $mode])}}" class="ajax-form" method="post">
    <div class="card rounded-3">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="mode_name">
                            Name
                        </label>
                        <input type="text" name="mode_name" id="mode_name" value="{{$mode->mode_name}}" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="slug">
                            Slug
                        </label>
                        <input type="text" name="slug" id="slug" value="{{$mode->slug}}" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="intro_text">Intro Text</label>
                        <textarea name="intro_text" id="intro_text"  class="form-control">{!! $mode->intro_text !!}</textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="short_description">Short Description</label>
                        <textarea name="short_description" id="short_description" class="form-control tiny-mce">{!! $mode->short_description !!}</textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="full_description">Full Description</label>
                        <textarea name="full_description" id="full_description" cols="30" rows="10"
                                                      class="form-control tiny-mce">{!! $mode->full_description !!}</textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group d-flex align-items-center mt-1">
                        <div class="m-t-15 m-checkbox-inline">
                            <div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                                <input @if($mode->active) checked @endif class="form-check-input" name="active" id="active" type="checkbox" data-bs-original-title="" title="Active">
                                <label class="form-check-label" for="active">
                                    Active
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="background_color">Background Color</label>
                        <input type="color" name="background_color" id="backgound_color" class="form-control" value="{{$mode->background_color}}" />
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-md-12 text-end">
                    <button type="submit" class="btn btn-primary">
                        Update Settings
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
