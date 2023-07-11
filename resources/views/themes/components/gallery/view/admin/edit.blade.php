<?php
$values = json_decode($component->values);
?>
<form action="{{ route('admin.components.update', ['componentBuilder' => $component]) }}" method="post"
    class="ajax-component-form">
    <input type="hidden" name="component" value="{{ $component->component_type }}">
    <div class="bg-light px-2 py-2">
        <div class="component-container">
            <div class="row clone_element">
                <div class="col-md-10">
                    <div class="form-group">
                        <label class="text-dark">Image</label>
                        <input type="file" name="images[]" id="images" class="form-control">
                    </div>
                </div>
                <div class="col-md-2 d-flex justify-content-center align-items-center">
                    <a class="btn btn-info clone-component">
                        <i class="fa fa-copy"></i>
                    </a>
                    <a class="btn btn-danger d-none remove-clone-component">
                        <i class="fa fa-trash"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10">
                <div class="form-group">
                    <label class="text-dark">Layout</label>
                    <select name="layout" id="layout" class="form-control">
                        <option value="grid" @if ($values->layout == 'grid') selected @endif>Grid</option>
                        <option value="mansonry" @if ($values->layout == 'mansonry') selected @endif>Mansori </option>
                        <option value="general_slider" @if ($values->layout == 'general_slider') selected @endif>General Slider
                        </option>
                        <option value="mac_slider" @if ($values->layout == 'mac_slider') selected @endif>Mac Slider</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">
                    Save Component
                </button>
            </div>
        </div>
    </div>
</form>
