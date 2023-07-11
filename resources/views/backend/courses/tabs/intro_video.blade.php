<form action="{{ route('admin.courses.intro-video', ['course' => $model]) }}" enctype="multipart/form-data" method="post"
    class="ajax-component-form ">
    <div class="row">
        <div class="col-md-12 alert alert-warning">
            <p>Previously uploaded Video will be overridden by current video.</p>
        </div>
    </div>
    <div class="row mt-2 bg-light p-2">
        <div class="col-md-6">
            <div class="form-group">
                <label for="source" class="text-dark">Intro Video Source</label>
                <select name="intro_video" id="intro_video" class="form-control">
                    <option value="">Select Video Source</option>
                    @foreach (\App\Models\Course::VIDEO_SOURCES as $key => $intro_course_type)
                        <option value="{{ $key }}">
                            {{ $intro_course_type }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6 intro_video_type d-none">
            <div class="form-group vimeo d-none video_type">
                <label for="vimeo" class="text-dark">Vimeo Url</label>
                <input type="url" name="vimeo" id="vimeo" class="form-control" />
            </div>
            <div class="form-group youtube d-none video_type">
                <label for="youtube" class="text-dark">Youtube Url</label>
                <input type="url" name="youtube" id="youtube" class="form-control" />
            </div>
            <div class="form-group file d-none video_type">
                <label for="file" class="text-dark">Select File</label>
                <input type="file" name="file" id="file" class="form-control" />
            </div>
            <div class="form-group lessions d-none video_type">
                <label for="lessions" class="text-dark">Lession</label>
                <select name="lessions" id="lessions" class="form-control" data-action="" data-method="get">
                    @foreach ($course->lessions as $lession)
                        <option value="{{ $lession->getKey() }}">
                            {{ $lession->lession_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-12 text-end">
            <button type="submit" class="btn btn-info">
                Save Intro Video
            </button>
        </div>
    </div>
</form>

@if ($course->enable_intro_video && $course->intro_video)

    <div class="row mt-6">
        <div class="col-md-4">
            @if ($course->intro_video->video_type == 'file')
                <?php
                $courseVideo = \App\Models\Image::find($course->intro_video->video[0]);
                ?>
                <video width="320" height="240" controls>
                    <source src="{{ asset('uploads/videos/' . $courseVideo->filepath) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            @endif
            @if ($course->intro_video->video_type == 'vimeo')
                <iframe src="https://player.vimeo.com/video/{{ $course->intro_video->video->id }}" width="640"
                    height="360" frameborder="0" allow="autoplay; fullscreen; picture-in-picture"
                    allowfullscreen></iframe>
            @endif
            @if ($course->intro_video->video_type == 'youtube')
                <iframe width="560" height="315"
                    src="https://www.youtube.com/embed/{{ $course->intro_video->video->id }}"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen>
                </iframe>
            @endif
            @if ($course->intro_video->video_type == 'lession')
            @endif
        </div>
        @if ($course->intro_video->video_type == ' lession')
            <div class="col-md-5 d-flex align-item-center justify-content-center">
                <h3>
                    {{ $course->lessions->lession_name }}
                </h3>
            </div>
        @endif
        <div class="col-md-3 text-end d-flex align-items-center justify-content-end">
            <button data-confirm='Are you sure ?' class="btn btn-danger data-confirm"
                data-action="{{ route('admin.courses.remove-video', ['course' => $course]) }}" data-method="post">
                Delete
            </button>
        </div>
    </div>
@endif
