@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
    $description = $componentValue['description'];
    $subtitle = $componentValue['subtitle'];
    $title = $componentValue['title'];
    $categoriesPost = App\Models\Category::getPosts($componentValue['categories'],6);


@endphp
<input type="hidden" name="_component_name" value="block_blog" class="component_field  d-none">
<input type="hidden" name="_action" value="store" class="component_field d-none">
<input type="hidden" name="_componentID" value="{{$_loadComponentBuilder->getKey()}}" class="d-none component_field">

    <div class="row">
        <div class="col-md-12" id="componentPreview">
            <iframe id="background_image_add_iframe" sandbox="allow-scripts allow-same-origin" srcdoc="{{view('themes.frontend.kpa.components.block_blog.preview',[
                '_component_name' => 'block_blog',
                '_action'   => 'store',
                'title' => $title,
                'subtitle'  => $subtitle,
                'description'   => $description,
                'posts' => $categoriesPost
            ])->render()}}"
                    height="450px" width="100%" loading='lazy' name="Background Image Preview">
            </iframe>
        </div>
    </div>


    <div class="container-fluid mt-3 p-4">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <h5 for="" class="text-dark">Subtitle</h5>
                    <input type="text" name="subtitle" value="{{$subtitle}}" id="subtitle" class="form-control component_field" placeholder="Building Business From Scratch">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <h5 for="" class="text-dark">Heading</h5>
                    <input type="text" name="title" value="{{$title}}" id="" class=" tiny-mce text-dark component_field">
                </div>
            </div>
        </div>

        <div class="row my-4">
            <div class="col-md-12">
                <h5 for="description" class="text-dark">Description</h5>
                <textarea name="description" class="component_field form-control @if(env('APP_ENV') == 'production') tiny-mce @endif text-dark">{!! $description !!}</textarea>
            </div>
        </div>

        <div class="row my-4">
            <div class="col-md-12">
                <h5 for="category" class="text-dark">Category</h5>
                <select name="categories[]" multiple id="category" class="form-control select2 component_field" >
                    @foreach (App\Models\Category::where('category_type','blog')->where('active',true)->get() as $category)
                    <option @if(in_array($category->getKey(),$componentValue['categories'])) selected @endif value="{{$category->getKey()}}">{{$category->category_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

<script>
@if(env('APP_ENV') == 'production')
    window.setupTinyMce();
@endif

    $.each($('select'), function (index, element) {
        if (!$(element).hasClass('no-select-2')) {
            window.ajaxReinitalize(element);
        }
    });
    $(document).on('change','input.uploadImage', function(event) {
            const fileInput = event.target;
            const file = fileInput.files[0];
            let _this = this;

            console.log('hell workd');
            if ( ! file ) {
                return;
            }
            if ( file ) {
                $(this).closest('div').find('.component-loader-wrapper').css('display','block');

                const formData = new FormData();
                formData.append('image',file);
                formData.append('name',$(this).attr('name'))
                formData.append('component','background_image')
                formData.append('_action','uploadMedia')
                axios.post('/admin/components/common/upload-image/background_image',formData,{
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    }
                }).then(function(response){

                    let _response = response.data;
                    console.log('repse ', $('input[name="'+$(_this).attr('data-target')+'"]'));
                    $('input[name="'+$(_this).attr('data-target')+'"]').val(_response.params.image);

                    $(_this).closest('div').find('img').attr('src',_response.params.image);
                    $(_this).closest('div').find('.component-loader-wrapper').css('display','none');
                }) .catch((error)=>{
                    console.log('error: ', error);
                    $(_this).closest('div').find('.component-loader-wrapper').css('display','none');
                })
            }
        })


</script>