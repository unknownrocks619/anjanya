<div class="row align-items-center">
    <div class="col-lg-6 col-md-6 mt-4 pt-2 mt-sm-0 opt-sm-0">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-6">
                <input type="hidden" name="_component_name" value="slider" class="component_field  d-none">
                <input type="hidden" name="_action" value="store" class="component_field d-none">
                <!--end row-->
                <div class="form-group">
                    <label>
                        Slider Type
                    </label>
                    <select name="slider_type" class="form-control component_field">
                        <option value="slider_album">Slider Album</option>
                        <option value="post">Post</option>
                        <option value="category">Category</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>
                        Slider Layout
                    </label>
                    <select name="layout" class="form-control component_field">
                        <option value="carousel">Full Page</option>
                        <option value="slider">Slider</option>
                    </select>
                </div>
            </div>
            <!--end col-->
        </div>
    </div>
    <div class="col-md-12 mt-2">
        <div class="row slider_type slider_album">
            <div class="col-md-6">
                <div class="form-group">
                    <label>
                        Select Album
                    </label>
                    <select name="slider_album" id="" class="form-group component_field">
                        @foreach (\App\Models\SliderAlbum::get() as $slider)
                            <option value="{{$slider->getKey()}}">{{$slider->album_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row slider_type post d-none">
            <div class="col-md-2">
                <div class="form-group">
                    <label>Display No. of Post</label>
                    <input type="number" name="no_of_display_post" class="form-control component_field" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Select Post</label>
                    <select name="posts[]" class="form-control ajax-select-2 component_field" multiple data-action="{{route('admin.ajax-select2.posts')}}"></select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <div class="form-group d-flex align-items-center mt-1">
                        <div class="m-t-15 m-checkbox-inline">
                            <div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                                <input class="form-check-input component_field" name="latest_posts" id="latest_posts" type="checkbox"
                                       data-bs-original-title="" title="latest_posts">
                                <label class="form-check-label" for="latest_posts">
                                    Latest Posts
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row slider_type category d-none">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Category</label>
                    <select name="categories[]" multiple data-action="{{ route('admin.ajax-select2.categories') }}"
                            class="form-control ajax-select-2 component_field">
                    </select>
                </div>
            </div>
        </div>
    </div>
    <!--end col-->
</div>
<script type="text/javascript">
    $('select[name="slider_type"]').on('change', function (event) {
        $('.slider_type').addClass('d-none')
        let _selectedEle = $(this).find(':selected').val();
        $('.slider_type.'+_selectedEle).removeClass('d-none');
    })

    $.each($('.ajax-select-2'),function(index,item){
        window.ajaxReinitalize(item);
    });
</script>
