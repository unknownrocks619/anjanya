@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp
<div class="row align-items-center">
    <div class="col-lg-6 col-md-6 mt-4 pt-2 mt-sm-0 opt-sm-0">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-6">
                <input type="hidden" name="_component_name" value="slider" class="component_field  d-none">
                <input type="hidden" name="_componentID" value="{{$_loadComponentBuilder->getKey()}}" class="d-none component_field">
                <input type="hidden" name="_action" value="update" class="component_field d-none">
                <!--end row-->
                <div class="form-group">
                    <label>
                        Slider Type
                    </label>
                    <select name="slider_type" class="form-control component_field">
                        <option value="slider_album" @if($componentValue['type'] == 'slider_album') selected @endif >Slider Album</option>
                        <option value="post" @if($componentValue['type'] == 'post') selected @endif >Post</option>
                        <option value="category" @if($componentValue['type'] == 'category') selected @endif>Category</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>
                        Slider Layout
                    </label>
                    <select name="layout" class="form-control component_field">
                        <option value="carousel" @if($componentValue['layout'] == 'carousel') selected @endif>Full Page</option>
                        <option value="slider"  @if($componentValue['layout'] == 'slider') selected @endif>Slider</option>
                    </select>
                </div>
            </div>
            <!--end col-->
        </div>
    </div>
    <div class="col-md-12 mt-2">
        <div class="row slider_type slider_album @if($componentValue['type'] != 'slider_album') d-none @endif">
            <div class="col-md-6">
                <div class="form-group">
                    <label>
                        Select Album
                    </label>
                    <select name="slider_album" id="" class="form-group component_field">
                        @foreach (\App\Models\SliderAlbum::get() as $slider)
                            <option value="{{$slider->getKey()}}" @if ($componentValue['type'] =='slider_album' && $componentValue['data'] == $slider->getKey()) selected @endif >{{$slider->album_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row slider_type post @if($componentValue['type'] != 'post') d-none @endif">
            <div class="col-md-2">
                <div class="form-group">
                    <label>Display No. of Post</label>
                    <input type="number" @if($componentValue['type'] == 'post') value="{{$componentValue['no_of_posts']}}" @endif name="no_of_display_post" class="form-control component_field" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Select Post</label>
                    <select name="posts[]" class="form-control ajax-select-2 component_field" multiple data-action="{{route('admin.ajax-select2.posts')}}">
                        @if($componentValue['type'] == 'post' && is_array($componentValue['data']) && ! empty($componentValue['data']))
                            @foreach (\App\Models\Post::whereIn('id',$componentValue['data'])->get() as $post)
                                <option value="{{$post->getKey()}}" selected>{{$post->title}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <div class="form-group d-flex align-items-center mt-1">
                        <div class="m-t-15 m-checkbox-inline">
                            <div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                                <input @if($componentValue['type'] == 'post' && $componentValue['latest_post'] == true) checked @endif class="form-check-input component_field" name="latest_posts" id="latest_posts" type="checkbox"
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
        <div class="row slider_type category @if( $componentValue['type'] !='category' ) d-none @endif">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Category</label>
                    <select name="categories[]" multiple data-action="{{ route('admin.ajax-select2.categories') }}"
                            class="form-control ajax-select-2 component_field">

                        @if($componentValue['type'] == 'category' && is_array($componentValue['data']) && ! empty($componentValue['data']) )
                            @foreach (\App\Models\Category::whereIn('id',$componentValue['data'])->get() as $category)
                                <option value="{{$category->getKey()}}" selected>{{$category->category_name}}</option>
                            @endforeach
                        @endif
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
