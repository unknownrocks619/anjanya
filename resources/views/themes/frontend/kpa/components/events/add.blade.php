@php
    $backgroundImage = asset('frontend/kpa/assets/images/service/bg-03.jpg');
    $events = App\Plugins\Events\Http\Models\Event::where('active',true)
                                                    ->where('event_start_date','>=',now()->format('Y-m-d'))
                                                    // ->where('event_end_date','<=' , now()->format('Y-m-d'))
                                                    ->limit(6)
                                                    ->get();
@endphp
<input type="hidden" name="_component_name" value="events" class="component_field  d-none">
<input type="hidden" name="_action" value="store" class="component_field d-none">
<div class="row">
    <div class="col-md-12" id="componentPreview">
        <iframe id="background_image_add_iframe" sandbox="allow-scripts allow-same-origin" srcdoc="{{view('themes.frontend.kpa.components.events.preview',[
            '_component_name' => 'background_image',
            '_action'   => 'store',
            'events'    => $events
        ])->render()}}"
                height="450px" width="100%" loading='lazy' name="Background Image Preview">
        </iframe>
    </div>
</div>

<div class="container-fluid bg-light mt-3 p-4">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <h5 for="" class="text-dark">Sub Heading</h5>
                <input type="text" name="subtitle" id="subtitle" class="form-control component_field" placeholder="Building Business From Scratch">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <h5 for="" class="text-dark">Heading</h5>
                <input type="text" name="title" id="" class=" tiny-mce text-dark component_field">
            </div>
        </div>
    </div>
    <div class="row my-4">
        <div class="col-md-12">
            <label for="description" class="text-dark">Description</label>
            <textarea name="description"  class="component_field form-control @if(env('APP_ENV') == 'production') tiny-mce @endif text-dark"></textarea>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <h4 class="text-dark">Update Background Image</h4>
        </div>

        <div class="col-md-6" style="position: relative;">
            <div class="component-loader-wrapper" style="display: none;position: absolute;top:10%;left:30%">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" width="125" height="100" style="shape-rendering: auto; display: block;" xmlns:xlink="http://www.w3.org/1999/xlink"><g><circle fill="#e15b64" r="10" cy="50" cx="84">
                    <animate begin="0s" keySplines="0 0.5 0.5 1" values="10;0" keyTimes="0;1" calcMode="spline" dur="0.25s" repeatCount="indefinite" attributeName="r"></animate>
                    <animate begin="0s" values="#e15b64;#abbd81;#f8b26a;#f47e60;#e15b64" keyTimes="0;0.25;0.5;0.75;1" calcMode="discrete" dur="1s" repeatCount="indefinite" attributeName="fill"></animate>
                </circle><circle fill="#e15b64" r="10" cy="50" cx="16">
                  <animate begin="0s" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" values="0;0;10;10;10" keyTimes="0;0.25;0.5;0.75;1" calcMode="spline" dur="1s" repeatCount="indefinite" attributeName="r"></animate>
                  <animate begin="0s" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" values="16;16;16;50;84" keyTimes="0;0.25;0.5;0.75;1" calcMode="spline" dur="1s" repeatCount="indefinite" attributeName="cx"></animate>
                </circle><circle fill="#f47e60" r="10" cy="50" cx="50">
                  <animate begin="-0.25s" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" values="0;0;10;10;10" keyTimes="0;0.25;0.5;0.75;1" calcMode="spline" dur="1s" repeatCount="indefinite" attributeName="r"></animate>
                  <animate begin="-0.25s" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" values="16;16;16;50;84" keyTimes="0;0.25;0.5;0.75;1" calcMode="spline" dur="1s" repeatCount="indefinite" attributeName="cx"></animate>
                </circle><circle fill="#f8b26a" r="10" cy="50" cx="84">
                  <animate begin="-0.5s" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" values="0;0;10;10;10" keyTimes="0;0.25;0.5;0.75;1" calcMode="spline" dur="1s" repeatCount="indefinite" attributeName="r"></animate>
                  <animate begin="-0.5s" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" values="16;16;16;50;84" keyTimes="0;0.25;0.5;0.75;1" calcMode="spline" dur="1s" repeatCount="indefinite" attributeName="cx"></animate>
                </circle><circle fill="#abbd81" r="10" cy="50" cx="16">
                  <animate begin="-0.75s" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" values="0;0;10;10;10" keyTimes="0;0.25;0.5;0.75;1" calcMode="spline" dur="1s" repeatCount="indefinite" attributeName="r"></animate>
                  <animate begin="-0.75s" keySplines="0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1;0 0.5 0.5 1" values="16;16;16;50;84" keyTimes="0;0.25;0.5;0.75;1" calcMode="spline" dur="1s" repeatCount="indefinite" attributeName="cx"></animate>
                </circle><g></g></g><!-- [ldio] generated by https://loading.io --></svg>
            </div>

            <img class="w-100" src="{{$backgroundImage}}" alt="banner">
            <input  type="file" data-target="imageOne" class="mt-2 form-control border-1 uploadImage"/>
            <input type="hidden" class="component_field" name="imageOne" value="{{$backgroundImage}}">
        </div>
        
        
    </div>


    <div class="row mt-2">
        <div class="col-md-12 text-end">
            <button type="button" class="btn btn-primary action-button" onclick="window.CB.updateComponent()">Save Component</button>
        </div>
    </div>
</div>

<script>
    window.setupTinyMce();
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
                axios.post('/admin/components/common/upload-image/events',formData,{
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