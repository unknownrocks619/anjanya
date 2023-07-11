<div class="bg-light px-2 py-2">
    <div class="component-container">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label class="text-dark">Overlay Title</label>
                    <input type="text" name="title" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="text-dark">Tagline</label>
                    <input type="text" name="tagline" class="form-control">
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="description" class="text-dark">Overlay Description</label>
                    <textarea name="overlay_description" class="form-control tiny-mce"></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="overlay_color" class="text-dark">
                        Overlay Color
                    </label>
                    <input type="color" name="color" id="color" class="form-control">
                </div>
            </div>
            <div class="col-md-6 parent_link_button">
                <div class="row clone_element">
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="button_label" class="text-dark">Button Label</label>
                                    <input type="text" name="button_label[]" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="buttons" class="text-dark">Button Link</label>
                                    <input type="text" name="button_link[]" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                        <a class="btn btn-info clone-component">
                            <i class="fa fa-copy"></i>
                        </a>
                        <a class="btn btn-danger d-none remove-clone-component">
                            <i class="fa fa-trash"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="video_type" class="text-dark">Video Source Type</label>
                    <select name="video_source" id="video_source" class="form-control">
                        <option value="vimeo">Vimeo</option>
                        <option value="youtube">Youtube</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="video_url" class="text-dark">Video URL</label>
                    <input type="url" name="video_url" id="video_url" class="form-control" />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="position" class="text-dark">Position</label>
                    <select name="position" id="position" class="form-control">
                        <option value="background">Background</option>
                        <option value="visible">Visible</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">


            <div class="col-md-6 text_dark">
                <div class="form-group">
                    <label for="display_image">
                        Display Image
                    </label>
                    <input type="file" name="display_image" class="form-control">
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
