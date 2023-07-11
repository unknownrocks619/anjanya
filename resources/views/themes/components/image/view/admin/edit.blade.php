<?php
$values = json_decode($component->values);
?>
<form action="{{ route('admin.components.update', ['componentBuilder' => $component]) }}" enctype="multipart/form-data"
    method="post" class="ajax-component-form">
    <input type="hidden" name="component" value="{{ $component->component_type }}">
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label for="">Title</label>
                <input type="text" name="title" value="{{ $values->title }}" class="form-control">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="">Display Type</label>
                <select name="display_type" class="form-control">
                    <option value="container" @if (isset($values->display_type) && $values->display_type == 'container') selected @endif>Compact</option>
                    <option value="container-fluid" @if (isset($values->display_type) && $values->display_type == 'container-fluid') selected @endif>Fluid</option>
                </select>
            </div>
        </div>
        <div class="col-md-12 mt-2">
            <div class="form-group">
                <label for="">Description</label>
                <textarea name="description" class="form-control tiny-mce">{{ $values->description }}</textarea>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="">Display Position</label>
                <select name="display_position" class="form-control">
                    <option value="left" @if ($values->display_position == 'left') selected @endif>Left</option>
                    <option value="right" @if ($values->display_position == 'right') selected @endif>Right</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="">Background Color</label>
                <input type="color" name="background_color" value="{{ $values->background_color }}"
                    class="form-control">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="">Select Image</label>
                <input type="file" name="image" class="form-control">
            </div>
        </div>
    </div>

    <div class="row py-2 bg-light ">
        <div class="col-md-3">
            <?php
            $images = $component
                ->getImage()
                ->latest()
                ->first();
            
            if ($images) {
                $images = $images->image->filepath;
            }
            ?>
            <img src="@if ($images) {{ \App\Classes\Helpers\Image::getImageAsSize($images, 'm') }} @endif"
                class="img-fluid" />
        </div>
        <div class="col-md-2 d-flex align-item-center">
            <a class="btn btn-danger data-confirm" data-confirm="Are you sure? "
                data-action="{{ route('admin.components.delete-element', ['componentBuilder' => $component]) }}"
                data-method="post">
                Delete
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">
                Save Component
            </button>
        </div>
    </div>
</form>
