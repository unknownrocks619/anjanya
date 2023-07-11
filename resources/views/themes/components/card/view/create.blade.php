<div class="row">
    <div class="col-md-12 text-dark">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="text-dark">
                        Card Display Size
                    </label>
                    <select name="card_size" class="form-control">
                        <option value="12">12/12</option>
                        <option value="6">6/12</option>
                        <option value="3">3/12</option>
                        <option value="4">4/12</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="" class="text-dark">
                        Display Type
                    </label>
                    <select name="display_type" class="form-control">
                        <option value="default">Default</option>
                        <option value="single">Featured</option>
                        <option value="thumbnail">Single and Thumb</option>
                        <option value="two_column">Two Column</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="" class="text-dark">
                        Content Type
                    </label>
                    <select name="slider_layout" class="form-control">
                        <option value="custom_content">Custom</option>
                        <option value="category_content">Category Content</option>
                        <option value="post_content">Post Content</option>
                        <option value="page_content">Page Content</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="custom_content slider_row">
            <div class="row first_accordian border-bottom">
                <div class="col-md-11">
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Card Title</label>
                                <input type="text" name="card_title[]" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Card Background Color</label>
                                <input type="color" name="background_color[]" class="form-control" value="#ffffff" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Card Title Color</label>
                                <input type="color" name="text_color[]" class="form-control" value="#181739" />
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="body-content">Body Content</label>
                                    <textarea name="card_body[]" class="form-control tiny-mce"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="button_label">Button Label</label>
                                    <input type="text" name="card_button_label[]" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="button_label">Button Link</label>
                                    <input type="text" name="card_button_link[]" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="button_label">Button Position</label>
                                    <select name="button_position[]" class="form-control no-select-2">
                                        <option value="start">Start</option>
                                        <option value="center">Center</option>
                                        <option value="end">End</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Select Media Type</label>
                                    <select name="media_type[]"
                                        class="form-control no-select-2 component_card_media_type">
                                        <option value="">None</option>
                                        <option value="image">Image</option>
                                        <option value="video">Video</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8 component_card_image_selector d-none">
                                <div class="form-group">
                                    <label for="">Select File</label>
                                    <input type="file" name="cardImage[]" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-8 component_card_video_selector d-none">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">
                                                Media Source
                                            </label>
                                            <select name="media_source[]" class="form-control no-select-2  ">
                                                <option value="vimeo">Vimeo</option>
                                                <option value="youtube">Youtube</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">
                                                Media Source(URL)
                                            </label>
                                            <input type="url" name="media_url[]" class="form-control">
                                        </div>
                                    </div>
                                </div>
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

        <div class="category_content d-none slider_row">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>
                            Please Select Category To Display
                        </label>
                        <select name="categories[]" multiple
                            data-action="{{ route('admin.ajax-select2.categories') }}"
                            class="form-control ajax-select-2">
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="post_content d-none slider_row">
            <div class="row border-bottom">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>
                            Please select Post to Display
                        </label>
                        <select name="posts[]" multiple='multiple' class="form-control ajax-select-2"
                            data-action="{{ route('admin.ajax-select2.posts') }}"></select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group d-flex align-items-center mt-1">
                        <div class="m-t-15 m-checkbox-inline">
                            <div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                                <input class="form-check-input" name="latest_posts" id="latest_posts"
                                    type="checkbox" data-bs-original-title="" title="latest_posts">
                                <label class="form-check-label" for="latest_posts">
                                    Display Latest Posts
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page_content d-none slider_row">
            <div class="row border-bottom">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>
                            Pages to display
                        </label>
                        <select name="pages[]" multiple='multiple' class="form-control ajax-select-2"
                            data-action="{{ route('admin.ajax-select2.pages') }}"></select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">
            Save Component
        </button>
    </div>
</div>
