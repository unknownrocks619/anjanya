<div class="bg-light px-2 py-2">
    <div class="component-container">
        <div class="row mt-2 clone_element">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="media" class="text-dark">
                        Button Label
                    </label>
                    <input type="text" name="label[]" id="" class="form-control" />
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="media" class="text-dark">
                        Button Link
                    </label>
                    <input type="text" name="link[]" class='form-control'>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="text-dark">
                        Size
                    </label>
                    <select name="display_size[]" class="form-control no-select-2">
                        <option value="4">4/12</option>
                        <option value="6">6/12</option>
                        <option value="8">8/12</option>
                        <option value="12">12/12</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="themes" class="text-dark">Select Theme Color</label>
                    <input type="color" name="theme[]" value="" class="form-control">
                </div>
            </div>
            <div class="col-md-1 d-flex justify-content-center align-items-center">
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
