<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <label for="">Title</label>
            <input type="text" name="title" class="form-control">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="">Display Type</label>
            <select name="display_type" id="display_type" class="form-control">
                <option value="container">Compact</option>
                <option value="container-fluid">Fluid</option>
            </select>
        </div>
    </div>
    <div class="col-md-12 mt-2">
        <div class="form-group">
            <label for="">Description</label>
            <textarea name="description" class="form-control tiny-mce"></textarea>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="">Display Position</label>
            <select name="display_position" class="form-control">
                <option value="left">Left</option>
                <option value="right">Right</option>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="">Background Color</label>
            <input type="color" name="background_color" value="#ffffff" class="form-control">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="">Select Image</label>
            <input type="file" name="image" class="form-control" required>
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
