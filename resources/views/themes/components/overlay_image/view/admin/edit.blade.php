<?php
$values = json_decode($component->values);
?>
<form action="{{ route('admin.components.update', ['componentBuilder' => $component]) }}" method="post"
    class="ajax-component-form">
    <input type="hidden" name="component" value="{{ $component->component_type }}">
    <div class="bg-light px-2 py-2">
        <div class="component-container">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="title" class="text-dark">Overlay Title</label>
                        <input type="text" name="title" value="{{ $values->title }}" id="title"
                            class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="text-dark">Tagline</label>
                        <input type="text" name="tagline"
                            value="{{ isset($values->tagline) ? $values->tagline : '' }}" class="form-control">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description" class="text-dark">Overlay Description</label>
                        <textarea name="overlay_description" id="overlay_description" class="form-control tiny-mce">{{ $values->description }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="form-group d-flex align-items-center mt-1">
                            <div class="m-t-15 m-checkbox-inline">
                                <div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                                    <input class="form-check-input" @if ($values->overlay_active) checked @endif
                                        name="active" id="enable_overlay_{{ $component->getKey() }}_active"
                                        type="checkbox" data-bs-original-title="" title="Active">
                                    <label class="form-check-label text-dark"
                                        for="enable_overlay_{{ $component->getKey() }}_active">
                                        Enable Overlay Image
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="overlay_color" class="text-dark">
                                    Overlay Color
                                </label>
                                <input type="color" value="{{ $values->overlay_color }}" name="color" id="color"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12 mt-2">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="overlay_color" class="text-dark">
                                            Min Width Container
                                        </label>
                                        <input type="text" value="{{ $values->min_width }}" name="width"
                                            id="width" class="form-control">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="overlay_color" class="text-dark">
                                            Min Height Container
                                        </label>
                                        <input type="text" name="height" value="{{ $values->min_height }}"
                                            id="height" class="form-control">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="overlay_color" class="text-dark">
                                            Unit
                                        </label>
                                        <select name="unit" id="unit" class="form-control">
                                            <option value="px" @if ($values->unit == 'px') selected @endif>
                                                Pixel
                                                (PX)</option>
                                            <option value="%" @if ($values->unit == '%') selected @endif>
                                                Percentage (%)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 parent_link_button">
                    @if (!$values->buttons || !count($values->buttons))
                        <div class="row clone_element">
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="button_label" class="text-dark">Button Label</label>
                                            <input type="text" name="button_label[]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="buttons" class="text-dark">Button Link</label>
                                            <input type="text" name="button_link[]" class="form-control">
                                        </div>
                                    </div>
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
                    @else
                        @foreach ($values->buttons as $button)
                            <div class="row clone_element">
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="button_label" class="text-dark">Button Label</label>
                                                <input type="text" value="{{ $button->label }}"
                                                    name="button_label[]" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="buttons" class="text-dark">Button Link</label>
                                                <input type="text" value="{{ $button->link }}"
                                                    name="button_link[]" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex justify-content-center align-items-center">
                                    @if ($loop->iteration == 1)
                                        <a class="btn btn-info clone-component">
                                            <i class="fa fa-copy"></i>
                                        </a>
                                    @else
                                        <a class="btn btn-danger remove-clone-component">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

            </div>
            <div class="row">
                <div class="col-col-md-6 text-dark">
                    <div class="form-group">
                        <label for="overlay_video">
                            Display video
                        </label>
                        <input type="url"
                            value="@if (isset($values->videos)) {{ $values->videos->content->link }} @endif"
                            class="form-control" name="video_url" />
                    </div>
                </div>

                <div class="col-md-6 text_dark">
                    <div class="form-group">
                        <label for="display_image">
                            Display Image
                        </label>
                        <input type="file" name="display_image" class="form-control">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">
                    Update Component
                </button>
            </div>
        </div>
    </div>
</form>
