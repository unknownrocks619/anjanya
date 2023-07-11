<div class="bg-light px-2 py-2">
    <div class="component-container">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="resource_title" class="text-dark">Resource Title</label>
                    <input type="text" name="resource_title" id="resource_title" class="form-control" />
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="resource_description" class="text-dark">Resource Description</label>
                    <textarea name="resource_description" id="resource_description" class="form-control tiny-mce"></textarea>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-5 accordian_group">
                <div class="row first_accordian">
                    <div class="col-md-11">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="accordian_title" class="text-dark">Accordian Title</label>
                                    <input type="text" name="accordian_title[]" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="accordian_description" class="text-dark">Description</label>
                                    <textarea name="accordian_description[]" class="form-control tiny-mce"></textarea>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-1 d-flex align-items-center">
                        <a class="btn btn-info clone_accordian_component">
                            <i class="fa fa-copy"></i>
                        </a>
                        <a class="btn btn-danger d-none remove_accordian_component">
                            <i class="fa fa-trash"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-5">
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

        <div class="row clone_element">
            <div class="col-md-10">
                <div class="form-group">
                    <label class="text-dark">Image</label>
                    <input type="file" name="images[]" id="images" class="form-control">
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
    <div class="row mt-2">
        <div class="col-md-12 text-end">
            <button type="submit" class="btn btn-primary">
                Save Component
            </button>
        </div>
    </div>
</div>
