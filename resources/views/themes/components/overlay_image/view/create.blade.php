<div class="bg-light px-2 py-2">
    <div class="component-container">
        <div class="row text-dark">
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
            <div class="col-md-6">
                <div class="form-group">
                    <label for="image" class="text-dark">Image</label>
                    <input type="file" name="image" id="image" class="form-control" />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <div class="form-group d-flex align-items-center mt-1">
                        <div class="m-t-15 m-checkbox-inline">
                            <div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                                <input class="form-check-input" name="active" id="overlay_image_active" type="checkbox"
                                    data-bs-original-title="" title="Active">
                                <label class="form-check-label text-dark" for="overlay_image_active">
                                    Enable Overlay Image
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="overlay_color" class="text-dark">
                                Overlay Color
                            </label>
                            <input type="color" name="color" id="color" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12 mt-2">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="overlay_color" class="text-dark">
                                        Min Width Container
                                    </label>
                                    <input type="text" name="width" id="width" class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="overlay_color" class="text-dark">
                                        Min Height Container
                                    </label>
                                    <input type="text" name="height" id="height" class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="overlay_color" class="text-dark">
                                        Unit
                                    </label>
                                    <select name="unit" id="unit" class="form-control">
                                        <option value="px">Pixel (PX)</option>
                                        <option value="%">Percentage (%)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
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
            <div class="col-col-md-6 text-dark">
                <div class="form-group">
                    <label for="overlay_video">
                        Display video
                    </label>
                    <input type="url" class="form-control" name="video_url" />
                </div>
            </div>

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
