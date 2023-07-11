<div class="row">
    <div class="col-md-12 text-dark">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Video Position</label>
                    <select name="video_position" class="form-control">
                        <option value="left">Left</option>
                        <option value="right">Right</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for=""> Video Source</label>
                    <select name="video_type" class="form-control component_video_checklist_source">
                        <option value="vimeo">Vimeo</option>
                        <option value="youtube">Youtube</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 component_video_checklist_source_vimeo">
                <div class="form-group">
                    <label for="">
                        Video Source
                    </label>
                    <input type="url" name="video_url" class="form-control component_video_checklist_source_vimeo">

                </div>
            </div>
        </div>


    </div>

    <div class="col-md-12 text-dark mt-1">
        <div class="row clone_element">
            <div class="col-md-11">
                <div class="form-group">
                    <label for="">
                        Checklist Item
                    </label>
                    <input type="text" name="checklist[]" class="form-control">
                </div>
            </div>
            <div class="col-md-1 d-flex align-item-center justify-content-center">
                <a class="btn btn-info clone-component">
                    <i class="fa fa-copy"></i>
                </a>
                <a class="btn btn-danger d-none remove-clone-component">
                    <i class="fa fa-trash"></i>
                </a>
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
