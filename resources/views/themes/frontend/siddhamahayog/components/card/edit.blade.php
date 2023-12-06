@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp
<div class="bg-light px-2 py-2 text-dark">
    <div class="component-container">
        <input type="hidden" name="_component_name" value="card" class="component_field  d-none">
        <input type="hidden" name="_componentID" value="{{$_loadComponentBuilder->getKey()}}" class="component_field d-none">
        <input type="hidden" name="_action" value="store" class="component_field d-none">

        <div class="row mt-2">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="media" class="text-dark">
                        Row
                    </label>
                    <input type="number" value="{{$componentValue['row']}}" name="row" min="1" class="form-control component_field" value="0" />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="media" class="text-dark">
                        Column
                    </label>
                    <select name="column" class="form-control component_field">
                        <option value="12" @if($componentValue['column'] == '12') selected @endif>One</option>
                        <option value="6"  @if($componentValue['column'] == '6') selected @endif>Two</option>
                        <option value="4"  @if($componentValue['column'] == '4') selected @endif>Three</option>
                        <option value="3" @if($componentValue['column'] == '3') selected @endif>Four</option>
                        <option value="2" @if($componentValue['column'] == '2') selected @endif>Six</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="media" class="text-dark">
                        Subtitle
                    </label>
                    <input type="text" name="subtitle" value="{{$componentValue['subtitle']}}" class="form-control component_field" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="media" class="text-dark">
                        Heading
                    </label>
                    <input type="text" name="heading" value="{{$componentValue['heading']}}" class="form-control component_field" />
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="layout">Card  Layout</label>
                    <select name="card_layout" id="layout" class="form-control component_field">
                        <option value="default" @if($componentValue['card_layout'] == 'default') selected @endif>Default</option>
                        <option value="progress" @if($componentValue['card_layout'] == 'progress') selected @endif>Progress</option>
                        <option value="flip" @if($componentValue['card_layout'] == 'flip') selected @endif>Flip</option>
                        <option value="highlight" @if($componentValue['card_layout'] == 'highlight') selected @endif>Highlight</option>
                        <option value="title" @if($componentValue['card_layout'] == 'title') selected @endif>Title</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4 card_layout @if($componentValue['card_layout'] != 'progress') d-none @endif">
                <div class="form-group">
                    <label>Progress Arrow Type</label>
                    <select name="card_layout_progress"  class="form-control component_field">
                        <option value="alternate" @if(! $componentValue['card_layout_progress'] || $componentValue['card_layout_progress'] =='alternate') selected @endif>Alternate</option>
                        <option value="up" @if($componentValue['card_layout_progress'] == 'up') selected @endif>Up Arrow</option>
                        <option value="down" @if($componentValue['card_layout_progress'] == 'down') selected @endif>Down Arrow</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row my-2">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="">Background Type</label>
                    <select name="background_type" class="form-control component_field">
                        <option value="colour" @if($componentValue['background_type'] == 'colour') selected @endif>Background Colour</option>
                        <option value="image" @if($componentValue['background_type'] == 'image') selected @endif>Background Image</option>
                    </select>
                </div>
            </div>

            <div class="col-md-4 background_type  colour @if($componentValue['background_type'] != 'colour') d-none @endif">
                <div class="form-group">
                    <label for="">Background Color</label>
                    <input type="color" name="background_colour" value="{{$componentValue['background_colour']}}" class="form-control component_field">
                </div>
            </div>

            <div class="col-md-4 background_type image @if($componentValue['background_type'] != 'image') d-none @endif">
                <label for="">Background Image</label>
                <input type="file" name="background_image_upload" class="form-control background_image_upload">
                <input type="hidden" name="background_image" class="component_field" value="{{$componentValue['background_image']}}" />
            </div>
            <div class="col-md-4">
                <img src="{{$componentValue['background_image']}}" class="background-image-preview" style="max-height: 250px; overflow: hidden">
            </div>

        </div>

        <div class="row my-2">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Select Glitter</label>
                    <select name="glitter_background"  class="form-control component_field">
                        <option value="" selected>--</option>
                        @foreach (\App\Models\GalleryAlbums::where('album_type','glitters')->get() as $glitterAlbum)
                            <option value="{{$glitterAlbum->getKey()}}" @if($componentValue['glitter_background'] == $glitterAlbum->getKey()) selected @endif>{{$glitterAlbum->album_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>


        <div class="row mt-2 field_generator bg-white">
            @php
                $data = $componentValue['data'];
            @endphp
            <div class="col-md-12">
                @foreach ($data as $rowKey => $row)
                    <div class="row mt-2">
                        @foreach ($row as $column_key => $column_value)
                            <div class="col-md-{{$componentValue['column']}} border my-1">
                                <div class="row">
                                    <div class="col-md-12 pt-2">
                                        <div class="card shadow mx-auto">
                                            <div class="card-body">
                                                <button class="btn btn-sm btn-primary upload-image-button">
                                                    <i class="fa fa-upload"></i>
                                                    Upload Gallery
                                                </button>
                                                <input type="file" class="upload_image_trigger d-none">
                                                <input type="hidden" value="{{$column_value['image']}}" name="image[{{$rowKey}}][{{$column_key}}]" class="component_field image_holder">
                                                <img  class=" img-fluid" src="{{$column_value['image'] ?? 'https://images.unsplash.com/photo-1617886903355-9354bb57b5d4?crop=entropy&amp;cs=tinysrgb&amp;fit=crop&amp;fm=jpg&amp;ixid=M3wzNzg0fDB8MXxzZWFyY2h8NHx8ZnVybml0dXJlJTIwcmVkfGVufDB8Mnx8fDE2OTE0ODcxMjF8MA&amp;ixlib=rb-4.0.3&amp;q=80&amp;w=1080&amp;h=1080" srcset="https://images.unsplash.com/photo-1617886903355-9354bb57b5d4?crop=entropy&amp;cs=tinysrgb&amp;fit=crop&amp;fm=jpg&amp;ixid=M3wzNzg0fDB8MXxzZWFyY2h8NHx8ZnVybml0dXJlJTIwcmVkfGVufDB8Mnx8fDE2OTE0ODcxMjF8MA&amp;ixlib=rb-4.0.3&amp;q=80&amp;w=1080&amp;h=1080 1080w, https://images.unsplash.com/photo-1617886903355-9354bb57b5d4??crop=entropy&amp;cs=tinysrgb&amp;fit=crop&amp;fm=jpg&amp;ixid=M3wzNzg0fDB8MXxzZWFyY2h8NHx8ZnVybml0dXJlJTIwcmVkfGVufDB8Mnx8fDE2OTE0ODcxMjF8MA&amp;ixlib=rb-4.0.3&amp;q=80&amp;w=150 150w, https://images.unsplash.com/photo-1617886903355-9354bb57b5d4??crop=entropy&amp;cs=tinysrgb&amp;fit=crop&amp;fm=jpg&amp;ixid=M3wzNzg0fDB8MXxzZWFyY2h8NHx8ZnVybml0dXJlJTIwcmVkfGVufDB8Mnx8fDE2OTE0ODcxMjF8MA&amp;ixlib=rb-4.0.3&amp;q=80&amp;w=300 300w, https://images.unsplash.com/photo-1617886903355-9354bb57b5d4??crop=entropy&amp;cs=tinysrgb&amp;fit=crop&amp;fm=jpg&amp;ixid=M3wzNzg0fDB8MXxzZWFyY2h8NHx8ZnVybml0dXJlJTIwcmVkfGVufDB8Mnx8fDE2OTE0ODcxMjF8MA&amp;ixlib=rb-4.0.3&amp;q=80&amp;w=768 768w, https://images.unsplash.com/photo-1617886903355-9354bb57b5d4??crop=entropy&amp;cs=tinysrgb&amp;fit=crop&amp;fm=jpg&amp;ixid=M3wzNzg0fDB8MXxzZWFyY2h8NHx8ZnVybml0dXJlJTIwcmVkfGVufDB8Mnx8fDE2OTE0ODcxMjF8MA&amp;ixlib=rb-4.0.3&amp;q=80&amp;w=1024 1024w'}}" sizes="(max-width: 1080px) 100vw, 1080px" width="1080" height="1080" alt="Photo by Jon Tyson" loading="lazy">
                                            </div>
                                            <div class="card-body">
                                                <div class="lc-block mb-3">
                                                    <div>
                                                        <input class="h5 component_field  form-control" value="{{$column_value['title']}}" name="title[{{$rowKey}}][{{$column_key}}]" placeholder="Title"  />
                                                        <textarea class="component_field tiny-mce form-control" name="description[{{$rowKey}}][{{$column_key}}]">{{$column_value['description']}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="lc-block">
                                                    <input value="{{$column_value['button']}}" type="text" name="button[{{$rowKey}}][{{$column_key}}]" class="component_field" placeholder="button_link">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    $(document).on('click','.upload-image-button', function(event) {
        event.preventDefault();
        $(this).closest('div.card-body').find('input.upload_image_trigger').trigger('click');
    });

    $(document).on('change','.upload_image_trigger', function(event) {
        let _this = this;
        const fileInput = event.target;
        const file = fileInput.files[0];

        if ( file ) {
            const formData = new FormData();
            formData.append('image',file);
            formData.append('name',$(this).attr('name'))
            formData.append('component','icon_column')
            formData.append('_action','uploadMedia')
            axios.post('/admin/components/common/upload-image/card',formData,{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(function(response){
                let _response = response.data;
                console.log('params: ', _response.params.image);
                $(_this).closest('div').find('.component_field').val(_response.params.image);
                $(_this).closest('div').find('img').attr('src',_response.params.image).attr('srcset',_response.params.image);
            })
        }
    })

    $(document).on('change','.background_image_upload', function(event) {
        let _this = this;
        const fileInput = event.target;
        const file = fileInput.files[0];

        if ( file ) {
            const formData = new FormData();
            formData.append('image',file);
            formData.append('name',$(this).attr('name'))
            formData.append('component','icon_column')
            formData.append('_action','uploadMedia')
            axios.post('/admin/components/common/upload-image/card',formData,{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(function(response){
                let _response = response.data;
                console.log('params: ', _response.params.image);
                $(_this).closest('div').find('.component_field').val(_response.params.image);
                $('.background-image-preview').attr('src',_response.params.image).attr('srcset',_response.params.image);
            })
        }
    })

    $(document).on('change','select[name="background_type"]', function(event){
        $('.background_type').addClass('d-none');
        $('.'+$(this).find(':selected').val()).removeClass('d-none');
    })

    $(document).on('change','select[name="card_layout"]',function() {
        console.log($(this).find(':selected').val());
        if ($(this).find(':selected').val() == 'progress') {
            $('.card_layout').removeClass('d-none')
        } else {
            $('.card_layout').addClass('d-none')

        }
    })
    window.setupTinyMceAll()

</script>
