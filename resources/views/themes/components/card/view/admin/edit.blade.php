<?php
$values = json_decode($component->values);

$categories = [];
if ($values->layout == 'category_content') {
    // dd($values->card_content);
    $categories = \App\Models\Category::whereIn('id', $values->card_content)->get();
}
$posts = [];
if ($values->layout == 'post_content') {
    // dd($values->card_content);
    $posts = \App\Models\Post::whereIn('id', $values->card_content)->get();
}

$pages = [];
if ($values->layout == 'page_content') {
    // dd($values->card_content);
    $pages = \App\Models\Page::whereIn('id', $values->card_content)->get();
}
?>
<form action="{{ route('admin.components.update', ['componentBuilder' => $component]) }}" method="post"
    class="ajax-component-form">
    <input type="hidden" name="component" value="{{ $component->component_type }}">
    <div class="row">
        <div class="col-md-12 text-dark">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="text-dark">
                            Card Display Size
                        </label>
                        <select name="card_size" class="form-control">
                            <option value="12" @if ($values->size == '12') selected @endif>12/12</option>
                            <option value="6" @if ($values->size == '6') selected @endif>6/12</option>
                            <option value="3" @if ($values->size == '3') selected @endif>3/12</option>
                            <option value="4" @if ($values->size == '4') selected @endif>4/12</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="" class="text-dark">
                            Display Type
                        </label>
                        <select name="display_type" class="form-control">
                            <option value="default" @if ($values->display_type == 'default') selected @endif>Default</option>
                            <option value="single" @if ($values->display_type == 'single') selected @endif>Featured</option>
                            <option value="thumbnail" @if ($values->display_type == 'thumbnail') selected @endif>Single and Thumb
                            </option>
                            <option value="two_column" @if ($values->display_type == 'two_column') selected @endif>Two Column
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="" class="text-dark">
                            Content Type
                        </label>
                        <select name="slider_layout" class="form-control">
                            <option value="custom_content" @if ($values->layout == 'custom_content') selected @endif>Custom
                            </option>
                            <option value="category_content" @if ($values->layout == 'category_content') selected @endif>Category
                                Content</option>
                            <option value="post_content" @if ($values->layout == 'post_content') selected @endif>Post
                                Content</option>
                            <option value="page_content" @if ($values->layout == 'page_content') selected @endif>Page
                                Content</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="custom_content slider_row @if ($values->layout != 'custom_content') d-none @endif">
                @if ($values->layout == 'custom_content')
                    @foreach ($values->card_content as $index => $card_element)
                        <div class="row border-bottom @if ($loop->iteration == 1) first_accordian @endif">
                            <div class="col-md-11">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Card Title</label>
                                            <input type="text" name="card_title[]" class="form-control"
                                                value="{{ $card_element->title }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Card Background Color</label>
                                            <input type="color" name="background_color[]" class="form-control"
                                                value="{{ $card_element->background_color }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Card Title Color</label>
                                            <input type="color" name="text_color[]" class="form-control"
                                                value="{{ $card_element->text_color }}" />
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="body-content">Body Content</label>
                                                <textarea name="card_body[]" class="form-control tiny-mce">{{ $card_element->body }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="button_label">Button Label</label>
                                                <input type="text" name="card_button_label[]"
                                                    value="{{ $card_element->footer->label }}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="button_label">Button Link</label>
                                                <input type="text" name="card_button_link[]"
                                                    value="{{ $card_element->footer->link }}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="button_label">Button Position</label>
                                                <select name="button_position[]" class="form-control no-select-2">
                                                    <option value="start"
                                                        @if ($card_element->footer->position == 'start') selected @endif>
                                                        Start</option>
                                                    <option value="center"
                                                        @if ($card_element->footer->position == 'start') selected @endif>
                                                        Center</option>
                                                    <option value="end"
                                                        @if ($card_element->footer->position == 'start') selected @endif>End
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    @if ($card_element->media->type == null)
                                        <div class="row mt-2">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Select Media Type</label>
                                                    <select name="media_type[]"
                                                        class="form-control no-select-2 component_card_media_type">
                                                        <option value="">None</option>
                                                        <option value="image">Image</option>
                                                        <option value="video">Video</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-8 component_card_image_selector d-none">
                                                <div class="form-group">
                                                    <label for="">Select File</label>
                                                    <input type="file" name="cardImage[]" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="col-md-8 component_card_video_selector d-none">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">
                                                                Media Source
                                                            </label>
                                                            <select name="media_source[]"
                                                                class="form-control no-select-2  ">
                                                                <option value="vimeo">Vimeo</option>
                                                                <option value="youtube">Youtube</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">
                                                                Media Source(URL)
                                                            </label>
                                                            <input type="url" name="media_url[]"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        @if ($card_element->media->type == 'image')
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <img src="{{ \App\Classes\Helpers\Image::getImageAsSize($card_element->media->images, 'm') }}"
                                                        class="img-fluid w-25" />
                                                </div>
                                                <div class="col-md-2 d-flex align-item-center">
                                                    <button class="btn btn-danger" data-method="post"
                                                        data-action="{{ route('admin.components.delete-card-media', ['componentBuilder' => $component, 'index' => $index]) }}">
                                                        Remove Image
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="row mt-2">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Select Media Type
                                                    </label>
                                                    <select name="media_type[]"
                                                        class="form-control no-select-2 component_card_media_type">
                                                        <option value="">None</option>
                                                        <option value="image">Image</option>
                                                        <option value="video"
                                                            @if ($card_element->media->type == 'video') selected @endif>Video
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-8 component_card_image_selector d-none">
                                                <div class="form-group">
                                                    <label for="">Select File</label>
                                                    <input type="file" name="cardImage[]" class="form-control" />
                                                </div>
                                            </div>
                                            <div
                                                class="col-md-8 component_card_video_selector @if ($card_element->media->type == 'image' || $card_element->media->type == '') d-none @endif">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">
                                                                Media Source
                                                            </label>
                                                            <select name="media_source[]"
                                                                class="form-control no-select-2  ">
                                                                <option value="vimeo">Vimeo</option>
                                                                <option value="youtube">Youtube</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">
                                                                Media Source(URL)
                                                            </label>
                                                            <input type="url"
                                                                value="@if ($card_element->media->type == 'video') {{ $card_element->media->video->link }} @endif"
                                                                name="media_url[]" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                            </div>
                            <div
                                class="col-md-1
                                                d-flex justify-content-center align-items-center">
                                @if ($loop->iteration == 1)
                                    <a class="btn btn-info clone_accordian_component">
                                        <i class="fa fa-copy"></i>
                                    </a>
                                @endif
                                <a
                                    class="btn btn-danger  @if ($loop->iteration == 1) d-none @endif remove_accordian_component">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="row first_accordian border-bottom">
                        <div class="col-md-11">
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Card Title</label>
                                        <input type="text" name="card_title[]" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Card Background Color</label>
                                        <input type="color" name="background_color[]" class="form-control"
                                            value="#ffffff" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Card Title Color</label>
                                        <input type="color" name="text_color[]" class="form-control"
                                            value="#181739" />
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="body-content">Body Content</label>
                                            <textarea name="card_body[]" class="form-control tiny-mce"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="button_label">Button Label</label>
                                            <input type="text" name="card_button_label[]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="button_label">Button Link</label>
                                            <input type="text" name="card_button_link[]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="button_label">Button Position</label>
                                            <select name="button_position[]" class="form-control no-select-2">
                                                <option value="start">Start</option>
                                                <option value="center">Center</option>
                                                <option value="end">End</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Select Media Type</label>
                                            <select name="media_type[]"
                                                class="form-control no-select-2 component_card_media_type">
                                                <option value="">None</option>
                                                <option value="image">Image</option>
                                                <option value="video">Video</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-8 component_card_image_selector d-none">
                                        <div class="form-group">
                                            <label for="">Select File</label>
                                            <input type="file" name="cardImage[]" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-8 component_card_video_selector d-none">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">
                                                        Media Source
                                                    </label>
                                                    <select name="media_source[]" class="form-control no-select-2  ">
                                                        <option value="vimeo">Vimeo</option>
                                                        <option value="youtube">Youtube</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">
                                                        Media Source(URL)
                                                    </label>
                                                    <input type="url" name="media_url[]" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-1 d-flex justify-content-center align-items-center">
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

            <div class="category_content @if ($values->layout != 'category_content') d-none @endif slider_row">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>
                                Please Select Category To Display
                            </label>
                            <select name="categories[]" multiple
                                data-action="{{ route('admin.ajax-select2.categories') }}"
                                class="form-control ajax-select-2">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->getKey() }}" selected>
                                        {{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="post_content @if ($values->layout != 'post_content') d-none @endif slider_row">
                <div class="row border-bottom">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>
                                Please select Post to Display
                            </label>
                            <select name="posts[]" multiple='multiple' class="form-control ajax-select-2"
                                data-action="{{ route('admin.ajax-select2.posts') }}">
                                @foreach ($posts as $post)
                                    <option value="{{ $post->getKey() }}" selected>{{ $post->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group d-flex align-items-center mt-1">
                            <div class="m-t-15 m-checkbox-inline">
                                <div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                                    <input class="form-check-input" @if ($values->latest) checked @endif
                                        name="latest_posts" id="latest_posts_{{ $component->getKey() }}"
                                        type="checkbox" data-bs-original-title="" title="latest_posts">
                                    <label class="form-check-label" for="latest_posts_{{ $component->getKey() }}">
                                        Display Latest Posts
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page_content d-none slider_row">
                <div class="row border-bottom">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>
                                Pages to display
                            </label>
                            <select name="pages[]" multiple='multiple' class="form-control ajax-select-2"
                                data-action="{{ route('admin.ajax-select2.pages') }}">
                                @foreach ($pages as $page)
                                    <option value="{{ $page->getKey() }}" selected> {{ $page->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">
                Update Component Component
            </button>
        </div>
    </div>
</form>
