<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="connect_component">Connect Component</label>
            <select multiple name="connector_component[]" id="connector_component" class="form-control component_field">
                <option value="">Select Component</option>
                @foreach (\App\Models\WebComponents::where('active',true)->get() as $component)
                    <option value="{{$component->getKey()}}"
                            @if(isset($componentValue['connector_component']) && in_array($component->getKey(),$componentValue['connector_component'])) selected @endif>{{$component->component_name}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
