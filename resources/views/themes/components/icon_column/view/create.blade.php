<div class="bg-light px-2 py-2">
    <div class="component-container">
        <div class="row mt-2">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="media" class="text-dark">
                        Layout
                    </label>
                    <select name="layout" id="layout" class="form-control no-select-2">
                        <option value="home_theme">Home Theme</option>
                        <option value="course_theme">Course Theme</option>
                    </select>
                </div>
            </div>
        </div>
        <div>
            <div class="row first_accordian">
                <div class="col-md-11">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-dark">Column Title</label>
                                <input type="text" name="column_title[]" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="text-dark">Icon Name</label>
                                <input type="text" name="icon[]" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="text-dark">Icon Background</label>
                                <input type="color" name="color[]" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="text-dark">Content</label>
                                <textarea name="content[]" class="form-control tiny-mce"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-1 d-flex justify-content-center align-items-center">
                    <a class="btn btn-info clone_accordian_component">
                        <i class="fa fa-copy"></i>
                    </a>
                    <a class="btn btn-danger d-none remove_accordian_component">
                        <i class="fa fa-trash"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">
                Save Component
            </button>
        </div>
    </div>
</div>
