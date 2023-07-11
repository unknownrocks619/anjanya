<?php
$values = json_decode($component->values);
?>
<form action="{{ route('admin.components.update', ['componentBuilder' => $component]) }}" method="post" class="ajax-form">
    <input type="hidden" name="component" value="{{ $component->component_type }}">
    <div class="bg-light px-2 py-2">
        <div class="component-container">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="text-dark">Overlay Title</label>
                        <input type="text" name="title" value="{{ $values->title }}" class="form-control">
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
                        <textarea name="overlay_description" id="overlay_description" class="form-control tiny-mce">{!! $values->description !!}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="overlay_color" class="text-dark">
                            Overlay Color
                        </label>
                        <input type="color" value="{{ $values->overlay_color }}" name="color" id="color"
                            class="form-control">
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
                                                <input type="text" value="{{ $button->label }}" name="button_label[]"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="buttons" class="text-dark">Button Link</label>
                                                <input type="text" value="{{ $button->link }}" name="button_link[]"
                                                    class="form-control">
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
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="video_type" class="text-dark">Video Source Type</label>
                        <select name="video_source" id="video_source" class="form-control">
                            <option value="vimeo" @if ($values->video_source == 'vimeo') selected @endif>Vimeo</option>
                            <option value="youtube" @if ($values->video_source == 'youtube') selected @endif>Youtube</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="video_url" class="text-dark">Video URL</label>
                        <input type="url" name="video_url" id="video_url" value="{{ $values->video_url }}"
                            class="form-control" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="position" class="text-dark">Position</label>
                        <select name="position" id="position" class="form-control">
                            <option value="background">Background</option>
                            <option value="visible">Visible</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
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
                <button type="submit" class="btn btn-danger data-confirm" data-confirm="Are you sure? "
                    data-action='{{ route('admin.components.delete', ['componentBuilder' => $component]) }}'
                    data-method="post">
                    Delete
                </button>
                <button type="submit" class="btn btn-primary ms-3">
                    Update Compoent
                </button>
            </div>
        </div>
    </div>
</form>
