<div class="row">
    <div class="col-md-12 text-dark">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="" class="text-dark">
                        Slider Layout
                    </label>
                    <select name="layout" class="form-control">
                        <option value="card_slider">Card Slider</option>
                    </select>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <label for="" class="text-dark">
                        Slider Type
                    </label>
                    <select name="slider_layout" class="form-control">
                        <option value="categories">Categories</option>
                        <option value="posts">Posts</option>
                        <option value="pages">Pages</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="" class="text-dark">
                        Limit Number of Slider
                    </label>
                    <input type='number' class='form-control' name='number_of_slider' min='1' max='30' />
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
            <div class="col-md-4">
                <div class="form-group d-flex align-items-center mt-1">
                    <div class="m-t-15 m-checkbox-inline">
                        <div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                            <input class="form-check-input" name="latest_posts" id="latest_posts" type="checkbox"
                                data-bs-original-title="" title="latest_posts">
                            <label class="form-check-label" for="latest_posts">
                                Display Latest Posts
                            </label>
                        </div>
                    </div>
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
</div>

<div class="col-md-12 d-flex justify-content-end">
    <button type="submit" class="btn btn-primary">
        Save Component
    </button>
</div>
</div>
