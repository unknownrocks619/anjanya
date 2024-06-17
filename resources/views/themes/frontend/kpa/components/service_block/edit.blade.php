@php
    $values = $_loadComponentBuilder->values;
@endphp
<input type="hidden" name="_component_name" value="service_block" class="component_field  d-none">
<input type="hidden" name="_action" value="store" class="component_field d-none">
<input type="hidden" name="_componentID" value="{{$_loadComponentBuilder->getKey()}}" class="d-none component_field">

    <div class="row">
        <div class="col-md-12" id="componentPreview">
            <iframe id="background_image_add_iframe" sandbox="allow-scripts allow-same-origin" srcdoc="{{view('themes.frontend.kpa.components.service_block.preview',[
                '_component_name' => 'service_block',
                '_action'   => 'store',
                'serviceBlocks' => $values['blocks'],
                'row'   => $values['row'],
                'column'    => $values['column'],
                'title'     => $values['title'],
                'description'   => $values['description'],
                'subtitle'      => $values['subtitle']
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
                    <input value="{{$values['subtitle']}}" type="text" name="subtitle" id="subtitle" class="form-control component_field" placeholder="Building Business From Scratch">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <h5 for="" class="text-dark">Heading</h5>
                    <input value="{{$values['title']}}" type="text" name="title" id="" class=" tiny-mce text-dark component_field">
                </div>
            </div>
        </div>

        <div class="row my-4">
            <div class="col-md-12">
                <h5 for="description" class="text-dark">Description</h5>
                <textarea name="description"  class="component_field form-control @if(env('APP_ENV') != 'local') tiny-mce @endif text-dark">{{$values['description']}}</textarea>
            </div>
        </div>

        <div class="row my-4">
            <div class="col-md-12">
                <h5 for="description" class="text-dark">Serice Icon Type</h5>
                <select name="service_icon_type" class="form-control component_field" onchange="updateImageSelector(this)">
                    <option value="icon" @if($values['service_type'] == 'icon') selected @endif>Icon</option>
                    <option value="image"  @if($values['service_type'] == 'image') selected @endif>Image</option>
                </select>
            </div>
        </div>

        <hr />
        <div class="row mt-2">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="media" class="text-dark">
                        Row
                    </label>
                    <input type="number" name="row" min="1" class="form-control component_field" value="{{$values['row']}}" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="media" class="text-dark">
                        Column
                    </label>
                    <select name="column" class="form-control component_field">
                        <option value="12" @if($values['column'] == '12') selected @endif>One</option>
                        <option value="6"  @if($values['column'] == '6') selected @endif>Two</option>
                        <option value="4" @if($values['column'] == '4') selected @endif>Three</option>
                        <option value="3" @if($values['column'] == '3') selected @endif>Four</option>
                        <option value="2" @if($values['column'] == '2') selected @endif>Six</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row mt-2 field_generator bg-white">
            <div class="col-md-12">
                @php
                    $loopCount = 0;
                @endphp
                @for($i = 1; $i <= $values['row'] ; $i++)
                    <div class='row mb-2'>
                        @for ($j= 1 ; $j <= (12/$values['column']); $j++)
                            @php
                                $title = $values['blocks'][$loopCount]['title'];
                                $description = $values['blocks'][$loopCount]['description'];
                                $icon = $values['blocks'][$loopCount]['icon'];
                                $image = $values['blocks'][$loopCount]['image'] ? $values['blocks'][$loopCount]['image'] : null ;
                            @endphp
                            <div class='col-md-{{$values['column']}}'>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="service-one-inner one">
                                            <div class="component-loader-wrapper" style=" display: none;/position: absolute;top:10%;left:30%;z-index: 999;">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" width="125" height="100" style="shape-rendering: auto; display: block;" xmlns:xlink="http://www.w3.org/1999/xlink"><g><circle fill="#e15b64" r="10" cy="50" cx="84" data-darkreader-inline-fill="" style="--darkreader-inline-fill: #e2616a;">
                                                    <animate begin="0s" keySplines="0 0.5 0.5 1" values="10;0" keyTimes="0;1" calcMode="spline" dur="0.25s" repeatCount="indefinite" attributeName="r"></animate>
                                                    <animate begin="0s" values="#e15b64;#abbd81;#f8b26a;#f47e60;#e15b64" keyTimes="0;0.25;0.5;0.75;1" calcMode="discrete" dur="1s" repeatCount="indefinite" attributeName="fill"></animate>
                                                </circle><circle fill="#e15b64" r="10" cy="50" cx="16" data-darkreader-inline-fill="" style="--darkreader-inline-fill: #e2616a;">
                                                  <animate begin="0s" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" values="0;0;10;10;10" keyTimes="0;0.25;0.5;0.75;1" calcMode="spline" dur="1s" repeatCount="indefinite" attributeName="r"></animate>
                                                  <animate begin="0s" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" values="16;16;16;50;84" keyTimes="0;0.25;0.5;0.75;1" calcMode="spline" dur="1s" repeatCount="indefinite" attributeName="cx"></animate>
                                                </circle><circle fill="#f47e60" r="10" cy="50" cx="50" data-darkreader-inline-fill="" style="--darkreader-inline-fill: #f47e60;">
                                                  <animate begin="-0.25s" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" values="0;0;10;10;10" keyTimes="0;0.25;0.5;0.75;1" calcMode="spline" dur="1s" repeatCount="indefinite" attributeName="r"></animate>
                                                  <animate begin="-0.25s" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" values="16;16;16;50;84" keyTimes="0;0.25;0.5;0.75;1" calcMode="spline" dur="1s" repeatCount="indefinite" attributeName="cx"></animate>
                                                </circle><circle fill="#f8b26a" r="10" cy="50" cx="84" data-darkreader-inline-fill="" style="--darkreader-inline-fill: #f8b066;">
                                                  <animate begin="-0.5s" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" values="0;0;10;10;10" keyTimes="0;0.25;0.5;0.75;1" calcMode="spline" dur="1s" repeatCount="indefinite" attributeName="r"></animate>
                                                  <animate begin="-0.5s" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" values="16;16;16;50;84" keyTimes="0;0.25;0.5;0.75;1" calcMode="spline" dur="1s" repeatCount="indefinite" attributeName="cx"></animate>
                                                </circle><circle fill="#abbd81" r="10" cy="50" cx="16" data-darkreader-inline-fill="" style="--darkreader-inline-fill: #aebf85;">
                                                  <animate begin="-0.75s" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" values="0;0;10;10;10" keyTimes="0;0.25;0.5;0.75;1" calcMode="spline" dur="1s" repeatCount="indefinite" attributeName="r"></animate>
                                                  <animate begin="-0.75s" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" values="16;16;16;50;84" keyTimes="0;0.25;0.5;0.75;1" calcMode="spline" dur="1s" repeatCount="indefinite" attributeName="cx"></animate>
                                                </circle><g></g></g><!-- [ldio] generated by https://loading.io --></svg>
                                            </div>
                                            <!-- Image -->
                                            <div class="thumbnail {{($values['service_type'] == 'icon') ? 'd-none' : ''}}">
                                                <img src="{{ $image ??  asset('frontend/kpa/assets/images/service/icon/01.svg')}}" alt="finbiz_service" style='max-width:65px; max-height: 65px;'>
                                                <button type='button' onclick='triggerUploadImage(this)' class='@if( $image ) d-none @endif btn btn-sm btn-primary upload-service-image'>Upload Image </button>
                                                <button type='button' onclick="resetImage(this)" class='@if(! $image) d-none @endif btn btn-sm btn-danger reset-button'>Reset Image</button>
                                                <input type='file' class='d-none file-trigger' onchange='uploadImage(this)' />
                                                <input type='hidden' value="{{$image ?? asset('frontend/kpa/assets/images/service/icon/01.svg')}}" class='form-control d-none service_image component_field' name='service_image[]' />
                                            </div>
                                            <!--  /Image -->
                                            <!-- Icon -->
                                            <div class="icon  {{($values['service_type'] != 'icon' )? 'd-none' : ''}}">
                                                <div class='row my-2'>
                                                    <div  class='col-md-12'>
                                                        <div class="form-control">
                                                            <label>Icon Web font Class</label>
                                                            <input type='text' placeholder='Icon Class Eg: fas fa-pencil' class='form-control component_field' name='icon[]' value={{$icon}} /> 
                                                            <span class='text-danger'>Reference to icon: https://fontawesome.com</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /Icon -->
                                            
                                            <!-- service Detail -->
                                            <div class="service-details">
                                                <div class='row my-2'>
                                                    <div class='col-md-12'>
                                                        <input type='text' name='service_title[]' placeholder='Heading' class='form-control component_field' value='{{$title}}' />
                                                    </div>
                                                </div>
                                                
                                                <div class='row mt-3'>
                                                    <div class='col-md-12'>
                                                        <textarea placeholder='description' class='form-control @if(env('APP_ENV') !='local') tiny-mce @endif component_field' name='service_description[]'>{!! $description !!}</textarea> 
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <!-- -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php
                                $loopCount++;
                            @endphp
                        @endfor
                    </div>
                @endfor
            </div>
        </div>
    </div>

<script>
@if(env('APP_ENV') != 'local')
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

        function loader(){
            return `<div class="component-loader-wrapper" style=" display: none;/position: absolute;top:10%;left:30%;z-index: 999;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" width="125" height="100" style="shape-rendering: auto; display: block;" xmlns:xlink="http://www.w3.org/1999/xlink"><g><circle fill="#e15b64" r="10" cy="50" cx="84" data-darkreader-inline-fill="" style="--darkreader-inline-fill: #e2616a;">
                        <animate begin="0s" keySplines="0 0.5 0.5 1" values="10;0" keyTimes="0;1" calcMode="spline" dur="0.25s" repeatCount="indefinite" attributeName="r"></animate>
                        <animate begin="0s" values="#e15b64;#abbd81;#f8b26a;#f47e60;#e15b64" keyTimes="0;0.25;0.5;0.75;1" calcMode="discrete" dur="1s" repeatCount="indefinite" attributeName="fill"></animate>
                    </circle><circle fill="#e15b64" r="10" cy="50" cx="16" data-darkreader-inline-fill="" style="--darkreader-inline-fill: #e2616a;">
                      <animate begin="0s" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" values="0;0;10;10;10" keyTimes="0;0.25;0.5;0.75;1" calcMode="spline" dur="1s" repeatCount="indefinite" attributeName="r"></animate>
                      <animate begin="0s" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" values="16;16;16;50;84" keyTimes="0;0.25;0.5;0.75;1" calcMode="spline" dur="1s" repeatCount="indefinite" attributeName="cx"></animate>
                    </circle><circle fill="#f47e60" r="10" cy="50" cx="50" data-darkreader-inline-fill="" style="--darkreader-inline-fill: #f47e60;">
                      <animate begin="-0.25s" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" values="0;0;10;10;10" keyTimes="0;0.25;0.5;0.75;1" calcMode="spline" dur="1s" repeatCount="indefinite" attributeName="r"></animate>
                      <animate begin="-0.25s" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" values="16;16;16;50;84" keyTimes="0;0.25;0.5;0.75;1" calcMode="spline" dur="1s" repeatCount="indefinite" attributeName="cx"></animate>
                    </circle><circle fill="#f8b26a" r="10" cy="50" cx="84" data-darkreader-inline-fill="" style="--darkreader-inline-fill: #f8b066;">
                      <animate begin="-0.5s" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" values="0;0;10;10;10" keyTimes="0;0.25;0.5;0.75;1" calcMode="spline" dur="1s" repeatCount="indefinite" attributeName="r"></animate>
                      <animate begin="-0.5s" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" values="16;16;16;50;84" keyTimes="0;0.25;0.5;0.75;1" calcMode="spline" dur="1s" repeatCount="indefinite" attributeName="cx"></animate>
                    </circle><circle fill="#abbd81" r="10" cy="50" cx="16" data-darkreader-inline-fill="" style="--darkreader-inline-fill: #aebf85;">
                      <animate begin="-0.75s" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" values="0;0;10;10;10" keyTimes="0;0.25;0.5;0.75;1" calcMode="spline" dur="1s" repeatCount="indefinite" attributeName="r"></animate>
                      <animate begin="-0.75s" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" values="16;16;16;50;84" keyTimes="0;0.25;0.5;0.75;1" calcMode="spline" dur="1s" repeatCount="indefinite" attributeName="cx"></animate>
                    </circle><g></g></g><!-- [ldio] generated by https://loading.io --></svg>
                </div>`
        }

        function generateField() {
        let _no_row = $('input[name=row]').val();
        let _no_column = $('select[name=column]').val();
        let _defaultSelection = $('select[name=service_icon_type]').find(':selected').val()
        let _column = ``;
        for (let i = 1; i <= _no_row; i++) {
             _column += `<div class='row mb-2'>`;
            for ( let j= 1 ; j <= (12/_no_column); j++) {
                _column += `<div class='col-md-${_no_column} border my-2'>`;
                _column += `<div class='row m-1'>`;
                _column += `<div class='col-md-12'>
                                 <div class="service-one-inner one">
                                    ${loader()}
                                    <div class="thumbnail ${(_defaultSelection == 'icon') ? 'd-none' : ''}">
                                        <img src="{{ asset('frontend/kpa/assets/images/service/icon/01.svg')}}" alt="finbiz_service" style='max-width:65px; max-height: 65px;'>
                                        <button type='button' onclick='triggerUploadImage(this)' class='btn btn-sm btn-primary upload-service-image'>Upload Image </button>
                                        <button onclick='resetImage(this)' type='button' class='d-none btn btn-sm btn-danger reset-button'>Reset Image</button>
                                        <input type='file' class='d-none file-trigger' onchange='uploadImage(this)' />
                                        <input type='hidden' class='form-control d-none service_image component_field' name='service_image[]' />
                                    </div>
                                    <div class="icon  ${(_defaultSelection == 'icon') ? '' : 'd-none'}">
                                        <div class='row my-2'>
                                            <div  class='col-md-12'>
                                                <div class='form-group'>
                                                    <label>
                                                        Icon Web font Class
                                                    </label>
                                                    <input type='text' placeholder='Icon Class Eg: fas fa-pencil' class='form-control component_field' name='icon[]'  /> 
                                                    <span class='text-danger'>Reference to icon: https://fontawesome.com</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="service-details">
                                        <div class='row my-2'>
                                            <div class='col-md-12'>
                                                <input type='text' name='service_title[]' placeholder='Heading' class='form-control component_field' value='Title' />
                                            </div>
                                        </div>
                                        
                                        <div class='row mt-3'>
                                            <div class='col-md-12'>
                                                <textarea placeholder='description' class='form-control @if(env('APP_ENV') !='local') tiny-mce @endif component_field' name='service_description[]'></textarea> 
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        `
                _column += `</div>`
                _column += `</div>`;
            }
            _column += `</div>`;
        }
        $('.field_generator').empty().append(_column);

        @if(env('APP_ENV') != 'local')
            window.setupTinyMce();
        @endif
    }

    $(document).on('change',"input[name=row]", function(event){
        generateField();
    });
    $(document).on('change',"select[name=column]", function(event){
        generateField();
    });

    function updateImageSelector(elm){
        let _currentValue = $(elm).find(':selected').val();
        let _wrapper  = $(document).find('.field_generator');

        if (_currentValue == 'icon') {
            $(_wrapper).find('.thumbnail').addClass('d-none');
            $(_wrapper).find('.icon').removeClass('d-none');
        } else {
            $(_wrapper).find('.thumbnail').removeClass('d-none');
            $(_wrapper).find('.icon').addClass('d-none');

        }
    }

    function triggerUploadImage(elm) {
        let _parent = $(elm).closest('div.thumbnail');
        $(_parent).find('.file-trigger').trigger('click');
    }

    function uploadImage(elm) {

        const fileInput = elm;
        console.log('file input:' , elm.target);
        const file = fileInput.files[0];

        if ( ! file ) {
            return;
        }

        if ( file ) {
            let _parentWrapper = $(elm).closest('.thumbnail');
            $(_parentWrapper).find('.component-loader-wrapper').css('display','block');
            const formData = new FormData();
                formData.append('image',file);
                formData.append('name',$(this).attr('name'))
                formData.append('component','service_block')
                formData.append('_action','uploadMedia')
                axios.post('/admin/components/common/upload-image/service_block',formData,{
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    }
                }).then(function(response){

                    let _response = response.data;
                    $(_parentWrapper).find('.service_image').val(_response.params.image);
                    $(_parentWrapper).find('img').attr('src',_response.params.image);
                    $(_parentWrapper).find('.upload-service-image').addClass('d-none');
                    $(_parentWrapper).find('.reset-button').removeClass('d-none');
                    $(_parentWrapper).find('.component-loader-wrapper').css('display','none');

                    // $('input[name="'+$(_this).attr('data-target')+'"]').val(_response.params.image);

                    // $(_this).closest('div').find('img').attr('src',_response.params.image);
                    // $(_this).closest('div').find('.component-loader-wrapper').css('display','none');
                }) .catch((error)=>{
                    console.log('error: ', error);
                    $(_parentWrapper).find('.component-loader-wrapper').css('display','none');
                })
        }

    }

    function resetImage(elm) {
        let _sampleImage = '{{ asset('frontend/kpa/assets/images/service/icon/01.svg')}}';
        let _parentWrapper = $(elm).closest('.thumbnail');
        $(elm).addClass('d-none');
        $(_parentWrapper).find('.upload-service-image').removeClass('d-none')
        $(_parentWrapper).find('img').attr('src',_sampleImage);
    }
</script>
