<?php
$component_values = json_decode($component->values);
?>
<form action="{{ route('admin.components.update', ['componentBuilder' => $component]) }}" method="post"
    class="ajax-component-form">
    <input type="hidden" name="component" value="{{ $component->component_type }}">
<div class="bg-light px-2 py-2">
    <div class="component-container">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="resource_title" class="text-dark">Resource Title</label>
                    <input type="text" name="resource_title" id="resource_title"
                        value="{{ $component_values->resource_title }}" class="form-control" />
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="resource_description" class="text-dark">Resource Description</label>
                    <textarea name="resource_description" id="resource_description" class="form-control tiny-mce">{!! $component_values->resource_description !!}</textarea>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-5 accordian_group">
                @if ($component_values->accordians && is_array($component_values->accordians))
                    @foreach ($component_values->accordians as $accordian_key => $accordian_value)
                        <div class="row  @if ($loop->iteration == 1) first_accordian @endif">
                            <div class="col-md-11">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="accordian_title" class="text-dark">Accordian Title</label>
                                            <input type="text" name="accordian_title[]"
                                                value="{{ $accordian_value->title }}" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="accordian_description" class="text-dark">Description</label>
                                            <textarea name="accordian_description[]" id="accordian_{{ $accordian_key }}" class="form-control tiny-mce">{!! $accordian_value->description !!}</textarea>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 d-flex align-items-center">
                                @if ($loop->iteration == 1)
                                    <a class="btn btn-info clone_accordian_component">
                                        <i class="fa fa-copy"></i>
                                    </a>
                                    <a class="btn d-none btn-danger remove_accordian_component">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                @else
                                    <a class="btn btn-danger remove_accordian_component">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="row first_accordian">
                        <div class="col-md-11">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="accordian_title" class="text-dark">Accordian Title</label>
                                        <input type="text" name="accordian_title[]" value=""
                                            class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="accordian_description" class="text-dark">Description</label>
                                        <textarea name="accordian_description[]" class="form-control tiny-mce"></textarea>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 d-flex align-items-center">
                            <a class="btn btn-info clone_accordian_component">
                                <i class="fa fa-copy"></i>
                            </a>
                            <a class="btn btn-danger d-none remove_accordian_component">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-5">
                @if ($component_values->buttons && is_array($component_values->buttons))
                    @foreach ($component_values->buttons as $button_keys => $button_values)
                        <div class="row @if ($loop->iteration == 1) clone_element @endif">
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="button_label" class="text-dark">Button Label</label>
                                            <input type="text" name="button_label[]"
                                                value="{{ $button_values->label }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="buttons" class="text-dark">Button Link</label>
                                            <input type="text" name="button_link[]"
                                                value="{{ $button_values->link }}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 d-flex justify-content-center align-items-center">
                                @if ($loop->iteration == 1)
                                    <a class="btn btn-info clone-component">
                                        <i class="fa fa-copy"></i>
                                    </a>
                                    <a class="btn d-none btn-danger remove-clone-component">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                @else
                                    <a class="btn btn-danger remove-clone-component">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="row clone_element ">
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="button_label" class="text-dark">Button Label</label>
                                        <input type="text" name="button_label[]" value=""
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="buttons" class="text-dark">Button Link</label>
                                        <input type="text" name="button_link[]" value=""
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 d-flex justify-content-center align-items-center">

                            <a class="btn btn-info clone-component">
                                <i class="fa fa-copy"></i>
                            </a>

                            <a class="btn d-none btn-danger remove-clone-component">
                                <i class="fa fa-trash"></i>
                            </a>

                        </div>
                    </div>
                @endif
            </div>
        </div>

        <?php
        $component->load(['getImage' => fn($query) => $query->with('image')]);
        $images = $component->getImage;
        ?>

        @if ($images && count($images))
            @foreach ($images as $image)
                <div class="row mt-3 border-bottom mb-2">
                    <div class="col-md-3">
                        <img src="{{ \App\Classes\Helpers\Image::getImageAsSize($image->image->filepath, 'm') }}"
                            class="img-fluid w-25" />
                    </div>

                    <div class="col-md-9 d-flex justify-content-end">
                        <button type='button' data-confirm='Are you Sure ?'
                            data-action="{{ route('admin.media.remove_image', ['image_relation' => $image, 'model' => $component::class, 'model_id' => $component->getKey()]) }}"
                            target="_blank" class="data-confirm btn btn-sm px-3 py-2 btn-danger">
                            <i class="fa fa-trash-o fs-3"></i>
                        </button>
                    </div>

                </div>
            @endforeach
        @endif

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
    <div class="row mt-2">
        <div class="col-md-12 text-end">
            <button type="submit" class="btn btn-primary">
                Update Component
            </button>
        </div>
    </div>
</div>
</form>
