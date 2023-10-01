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
                                                        <input class="h5 component_field tiny-mce form-control" value="{{$column_value['title']}}" name="title[{{$rowKey}}][{{$column_key}}]" placeholder="Title"  />
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
    window.setupTinyMceAll()
    window.setupTinyMce();
</script>
