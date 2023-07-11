@php $values = json_decode($component->values) @endphp
@php
    $categories = [];
    if ($values->block_type == 'categories') {
        $categories = \App\Models\Category::whereIn('id', $values->blocks)->get();
    }
    
    $posts = [];
    if ($values->block_type == 'posts') {
        $posts = \App\Models\Post::whereIn('id', $values->blocks)->get();
    }
    $pages = [];
    if ($values->block_type == 'pages') {
        $pages = \App\Models\Page::wherIn('id', $values->blocks)->get();
    }
@endphp
<form action="{{ route('admin.components.update', ['componentBuilder' => $component]) }}" method="post"
    class="ajax-component-form">
    <input type="hidden" name="component" value="{{ $component->component_type }}">

    <div class="row">
        <div class="col-md-12 text-dark">

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="" class="text-dark">
                            Block Size
                        </label>
                        <select name="card_size" class="form-control">
                            <option value="12" @if ($values->card_size == 12) selected @endif>12/12</option>
                            <option value="6" @if ($values->card_size == 6) selected @endif>6/12</option>
                            <option value="3" @if ($values->card_size == 3) selected @endif>3/12</option>
                            <option value="4" @if ($values->card_size == 4) selected @endif>4/12</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">
                            Display Type
                        </label>
                        <select name="display_type" class="form-control">
                            <option value="container" @if ($values->display_type == 'container') selected @endif>Compact</option>
                            <option value="container-fluid" @if ($values->display_type == 'container-fluid') selected @endif>Fluid
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="" class="text-dark">
                            Block Type
                        </label>
                        <select name="slider_layout" class="form-control" placeholder="Click to select block type">
                            <option value=""></option>
                            <option value="categories" @if ($values->block_type == 'categories') selected @endif>Categories
                            </option>
                            <option value="posts" @if ($values->block_type == 'posts') selected @endif>Posts</option>
                            <option value="pages" @if ($values->block_type == 'pages') selected @endif>Pages</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row slider_row border-bottom categories @if ($values->block_type != 'categories') d-none @endif">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>
                            Please Select Category To Display
                        </label>
                        <select name="categories[]" multiple data-action="{{ route('admin.ajax-select2.categories') }}"
                            class="form-control ajax-select-2">
                            @foreach ($categories as $category)
                                <option value="{{ $category->getKey() }}" selected>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="row slider_row border-bottom posts @if ($values->block_type != 'posts') d-none @endif">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>
                            Please select Post to Display
                        </label>
                        <select name="posts[]" class="form-control ajax-select2"></select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group d-flex align-items-center mt-1">
                        <div class="m-t-15 m-checkbox-inline">
                            <div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                                <input @if ($values->latest_posts == true) checked @endif class="form-check-input"
                                    name="latest_posts" id="latest_post_for_block" type="checkbox"
                                    data-bs-original-title="" title="Latest post">
                                <label class="form-check-label" for="latest_post_for_block">
                                    Display Latest Posts
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="">
                            Limit post
                        </label>
                        <input type="number" name="post_limit" value="{{ $values->post_limit }}"
                            class="form-control" />
                    </div>
                </div>
            </div>
            <div class="row slider_row border-bottom pages @if ($values->block_type != 'pages') d-none @endif">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>
                            Pages to display
                        </label>
                        <select class="form-control ajax-select-2" multiple
                            data-action="{{ route('admin.ajax-select2.pages') }}">
                            @if (isset($pagse) && count($pages))
                                @foreach ($pages as $page)
                                    <option value="{{ $page->getKey() }}">
                                        {{ $page->title }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
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
</form>
