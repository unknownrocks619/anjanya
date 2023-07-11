<div class="row">
    <div class="col-md-12 text-dark">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="" class="text-dark">
                        Block Size
                    </label>
                    <select name="card_size" class="form-control">
                        <option value="12">12/12</option>
                        <option value="6">6/12</option>
                        <option value="3">3/12</option>
                        <option value="4">4/12</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">
                        Display Type
                    </label>
                    <select name="display_type" class="form-control">
                        <option value="container">Compact</option>
                        <option value="container-fluid">Fluid</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="" class="text-dark">
                        Block Type
                    </label>
                    <select name="slider_layout" class="form-control" placeholder="Click to select block type">
                        <option value=""></option>
                        <option value="categories">Categories</option>
                        <option value="posts">Posts</option>
                        <option value="pages">Pages</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row slider_row border-bottom categories  d-none">
            <div class="col-md-12">
                <div class="form-group">
                    <label>
                        Please Select Category To Display
                    </label>
                    <select name="categories[]" multiple data-action="{{ route('admin.ajax-select2.categories') }}"
                        class="form-control ajax-select-2">
                    </select>
                </div>
            </div>
        </div>

        <div class="row slider_row border-bottom posts  d-none">
            <div class="col-md-8">
                <div class="form-group">
                    <label>
                        Please select Post to Display
                    </label>
                    <select name="posts[]" class="form-control ajax-select2"></select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group d-flex align-items-center mt-1">
                    <div class="m-t-15 m-checkbox-inline">
                        <div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                            <input class="form-check-input" name="latest_posts" id="latest_post_for_block_create"
                                type="checkbox" data-bs-original-title="" title="latest_post_for_block_create">
                            <label class="form-check-label" for="latest_post_for_block_create">
                                Display Latest Posts
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="">
                        Limit post
                    </label>
                    <input type="number" name="post_limit" id="post_limit" class="form-control" />
                </div>
            </div>
        </div>

        <div class="row slider_row border-bottom pages d-none">
            <div class="col-md-12">
                <div class="form-group">
                    <label>
                        Pages to display
                    </label>
                    <select class="form-control"></select>
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
