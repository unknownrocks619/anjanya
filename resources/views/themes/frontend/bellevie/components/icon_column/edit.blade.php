<!-- Block Builder  -->
@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp
<div class="bg-light px-2 py-2 text-dark">
    <div class="component-container">
        <input type="hidden" name="_component_name" value="icon_column" class="component_field  d-none">
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
                                        <div class="form-group">
                                            <label>Select Icon</label>
                                            <input name="icon[{{$rowKey}}][{{$column_key}}]" class="form-control component_field" value="{{$column_value['icon']}}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" name="title[{{$rowKey}}][{{$column_key}}]" placeholder="Type your title" value="{{$column_value['title']}}" class="component_field form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div name="description[{{$rowKey}}][{{$column_key}}]" class="tiny-mce component_field">{!! $column_value['description'] !!}</div>
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
    window.setupTinyMceAll();
</script>
