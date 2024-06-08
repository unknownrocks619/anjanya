<form action="{{ route('admin.courses.edit', ['course' => $course]) }}" class="ajax-form" method="post">
    <div class="row">
        <div class="col-sm-8">
            <div class="form-group">
                <label for="course_name">Course Name</label>
                <input type="text" name="course_name" id="course_name" class="form-control" placeholder="Course Name"
                    value="{{ $course->course_name }}" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="course_slug">Course Slug</label>
                <input type="text" name="slug" id="slug" class="form-control" value="{{ $course->slug }}" />
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="tag_line">TagLine</label>
                <input type="text" name="tag_line" id="tag_line" value="{{ $course->tagline }}"
                    class="form-control">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="theme_color">
                    Theme Color
                </label>
                <input type="color" name="theme_color" id="theme_color" value="{{ $course->theme_color }}"
                    class="form-control ">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="intro_text">Intro Text</label>
                <textarea name="intro_text" id="intro_text" class="form-control">{{ $course->course_intro_text }}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="short_description">Short Description</label>
                <textarea name="short_description" id="short_description" class="form-control  tiny-mce">{{ $course->course_short_description }}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="full_description">Full Description</label>
                <textarea name="full_description" id="full_description" class="form-control tiny-mce">{{ $course->course_full_description }}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group d-flex align-items-center mt-1">
                <div class="m-t-15 m-checkbox-inline">
                    <div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                        <input {{ $course->active ? 'checked' : '' }} class="form-check-input" name="active"
                            id="active" type="checkbox" data-bs-original-title="" title="Active">
                        <label class="form-check-label" for="active">
                            Active
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group d-flex align-items-center mt-1">
                <div class="m-t-15 m-checkbox-inline">
                    <div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                        <input {{ $course->enable_intro_video ? 'checked' : '' }} class="form-check-input"
                            name="intro_video" id="intro_video" type="checkbox" data-bs-original-title="Intro Video"
                            title="Intro Video">
                        <label class="form-check-label" for="intro_video">
                            Enable Intro Video
                        </label>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="course_type">Course Delivery Medium</label>
                <input type="text" name="course_type" id="course_type" value="{{$course->course_type}}" class="form-control">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="total_lectures">Total Lectures</label>
                <input type="text" name="lectures" value="{{$course->total_lecture}}" id="total_lectures" class="form-control">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="language">Language</label>
                <input type="text" name="language" value="{{$course->language}}" id="language" class="form-control">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="certification">Certification</label>
                <input type="text" name="certification" value="{{$course->certification}}" id="total_lectures" class="form-control">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="duration">Duration</label>
                <input type="text" name="duration" value="{{$course->duration}}" id="duration" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-end">
            <button type="submit" class="btn btn-info">
                Update Course Detail
            </button>
        </div>
    </div>
</form>
