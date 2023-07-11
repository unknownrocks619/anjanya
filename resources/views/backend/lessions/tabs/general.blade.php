<form action="{{ $formAction }}" class="ajax-form" method="post">
    <div class="row">
        <!-- Zero Configuration  Starts-->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row g-2">
                        <div class="mb-3 col-md-12 mt-0">
                            <div class="form-group">
                                <label for="lession_name">Lession Title</label>
                                <input class="form-control" id="lession_name" name="lession_name" type="text"
                                    required="" placeholder="Lession Title" autocomplete="off"
                                    value="{{ $lession->lession_name }}">
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="mb-3 col-md-12 mt-0">
                            <div class="form-group">
                                <label for="intro_text">Intro Text</label>
                                <textarea name="intro_text" id="intro_text" class="form-control">{!! $lession->intro_text !!}</textarea>
                            </div>
                        </div>
                    </div>
                    @if (!isset($course))
                        <div class="row my-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="course">
                                        Select Course
                                    </label>
                                    <select name="course" data-chapter="{{ $lession->chapter_id }}"
                                        data-action="{{ route('admin.ajax-select2.chapters') }}"
                                        class="form-control lession-course-selection">

                                        @foreach (\App\Models\Course::where('active', true)->get() as $course)
                                            <option value="{{ $course->getKey() }}"
                                                @if ($lession->course_id == $course->getKey()) selected @endif>
                                                {{ $course->course_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group chapter-group">
                                    <label for="chapters">
                                        Chapters
                                    </label>
                                    <select name="chapter" id="chapter"
                                        class="form-control chapter_selections ajax-select-2"
                                        data-action="{{ route('admin.ajax-select2.chapters', [$lession->course_id, $lession->chapter_id]) }}">
                                        <option value="{{ $lession->chapter_id }}" selected>
                                            {{ $lession->getChapter->chapter_name }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <div class="form-g">
                                <label for="short_description">Short Description</label>
                                <textarea name="short_description" id="short_description" class="form-control tiny-mce">{!! $lession->short_description !!}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <div class="form-g">
                                <label for="full_description">Full Description</label>
                                <textarea name="full_description" id="full_description" class="form-control tiny-mce">{!! $lession->full_description !!}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group d-flex align-items-center mt-1">
                                        <div class="m-t-15 m-checkbox-inline">
                                            <div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                                                <input @if ($lession->active) checked @endif
                                                    class="form-check-input" name="active" id="active"
                                                    type="checkbox" data-bs-original-title="Active" title="Active">
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
                                                <input @if ($lession->enable_youtube) checked @endif
                                                    class="form-check-input lession_video_type"
                                                    name="enable_youtube_video" id="enable_youtube_video"
                                                    type="checkbox" data-bs-original-title="Enable Youtube Video"
                                                    title="Enable Youtube Video">
                                                <label class="form-check-label" for="enable_youtube_video">
                                                    Enable Youtube Video
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group d-flex align-items-center mt-1">
                                        <div class="m-t-15 m-checkbox-inline">
                                            <div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                                                <input @if ($lession->enable_vimeo) checked @endif
                                                    class="form-check-input lession_video_type"
                                                    name="enable_vimeo_video" id="enable_vimeo_video" type="checkbox"
                                                    data-bs-original-title="Enable Vimeo Video"
                                                    title="Enable Vimeo Video">
                                                <label class="form-check-label" for="enable_vimeo_video">
                                                    Enable Vimeo Video
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group d-flex align-items-center mt-1">
                                        <div class="m-t-15 m-checkbox-inline">
                                            <div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                                                <input @if ($lession->enable_preview) checked @endif
                                                    class="form-check-input lession_video_type" name="enable_preview"
                                                    id="enabe_intro_video" type="checkbox"
                                                    data-bs-original-title="Enable Intro Video"
                                                    title="Enable Intro Video">
                                                <label class="form-check-label" for="enabe_intro_video">
                                                    Enable Intro Video
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12 lession_youtube_link">
                                    <div class="form-group">
                                        <label for="youtube_link">Youtube Video Url</label>
                                        <input type="url" value="{{ $lession->youtube?->link }}"
                                            name='youtube_url' class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-12 lession_vimeo_link">
                                    <div class="form-group">
                                        <label for="youtube_link">Vimeo Video Url</label>
                                        <input type="url" value="{{ $lession->vimeo?->link }}" name="vimeo_url"
                                            class="form-control" />
                                    </div>

                                </div>
                                <div class="col-md-12 preview_link">
                                    <div class="form-group">
                                        <label for="preview_link">Preview Link</label>
                                        <input type="url" value="{{ $lession->intro_video?->link }}"
                                            class="form-control" name="preview_url" />
                                    </div>
                                    <span class="text-warning">
                                        Only Vimeo Link is Supported.
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Zero Configuration  Ends-->
    </div>
    <div class="row my-2">
        <div class="col-md-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">
                Update Lession
            </button>
        </div>
    </div>
</form>
