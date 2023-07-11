<div class="bg-light px-2 py-2">
    <div class="component-container">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label class="text-dark">Title</label>
                    <input type="text" name="title" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="text-dark">Subtitle</label>
                    <input type="text" name="subtitle" class="form-control">
                </div>
            </div>

            <div class="col-md-12 mt-2">
                <div class="form-group">
                    <label for='full_text' class="text-dark">
                        Full Text
                    </label>
                    <textarea name="full_text" class="form-control tiny-mce"></textarea>
                </div>
            </div>
        </div>

        <div>
            <div class="row mt-2 clone_element">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="media" class="text-dark">
                            Media Source
                        </label>
                        <select name="media_source[]" class="form-control">
                            <option value="youtube">Youtube</option>
                            <option value="vimeo">Vimeo</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="media" class="text-dark">
                            Media URL
                        </label>
                        <input type="url" name="media_link[]" class='form-control'>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="text-dark">
                            Display Position
                        </label>
                        <select name="display_position[]" class="form-control">
                            <option value="top">Above Content</option>
                            <option value="bottom">Below Content</option>
                        </select>
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
        <div class="col-md-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">
                Save Component
            </button>
        </div>
    </div>
</div>
