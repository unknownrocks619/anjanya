<form action="{{ route('admin.pages.update', ['page' => $page]) }}" class="ajax-form" method="post">
    <div class="row">
        <!-- Zero Configuration  Starts-->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row g-2">
                        <div class="mb-3 col-md-8 mt-0">
                            <div class="form-group">
                                <label for="page_title">Title</label>
                                <input class="form-control" id="page_title" name="page_title" type="text"
                                    required="" placeholder="Page Title" autocomplete="off"
                                    value="{{ $page->title }}">
                            </div>
                        </div>
                        <div class="mb-3 col-md-4 mt-0">
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input class="form-control" id="slug" name="slug" type="text" required=""
                                    placeholder="Page Slug" autocomplete="off" value="{{ $page->slug }}">
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="mb-3 col-md-12 mt-0">
                            <div class="form-group">
                                <label for="page_title">Intro Text</label>
                                <textarea name="intro_text" class="form-control">{!! $page->intro_text !!}</textarea>
                            </div>
                        </div>
                        <div class="mb-3 col-md-12 mt-0">
                            <div class="form-group">
                                <label for="page_title">Short Description</label>
                                <textarea name="short_description" class="form-control tiny-mce">{!! $page->short_description !!}</textarea>
                            </div>
                        </div>
                        <div class="mb-3 col-md-12 mt-0">
                            <div class="form-group">
                                <label for="page_title">Full Description</label>
                                <textarea name="full_description" class="form-control tiny-mce">{!! $page->full_description !!}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-3">
                            <div class="form-group d-flex align-items-center mt-1">
                                <div class="m-t-15 m-checkbox-inline">
                                    <div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                                        <input {{ $page->active ? 'checked' : '' }} class="form-check-input"
                                            name="active" id="active" type="checkbox" data-bs-original-title=""
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
            </div>
        </div>
        <!-- Zero Configuration  Ends-->
    </div>
    <div class="row my-2">
        <div class="col-md-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">
                Update Page
            </button>
        </div>
    </div>
</form>
