@php $values = json_decode($component->values) @endphp
@php
    if ($values->type == 'categories') {
        $categories = \App\Models\Category::whereIn('id', $values->values)->get();
    }
    
    if ($values->type == 'posts') {
    }
    
    if ($values->type == 'pages') {
        $pages = \App\Models\Page::wherIn('id', $values->values)->get();
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
                            Slider Layout
                        </label>
                        <select name="layout" class="form-control">
                            <option value="card_slider" @if ($values->layout == 'card_slider') selected @endif>Card Slider
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="" class="text-dark">
                            Slider Type
                        </label>
                        <select name="slider_layout" class="form-control">
                            <option value="categories" @if ($values->type == 'categories') selected @endif>Categories
                            </option>
                            <option value="posts" @if ($values->type == 'posts') selected @endif>Posts</option>
                            <option value="pages" @if ($values->type == 'pages') selected @endif>Pages</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="" class="text-dark">
                            Limit Number of Slider
                        </label>
                        <input type='number' value="{{ $values->limit }}" class='form-control' name='number_of_slider'
                            min='1' max='30' />

                    </div>
                </div>
            </div>

            <div class="row slider_row border-bottom categories @if ($values->type != 'categories') d-none @endif">
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

            <div class="row slider_row border-bottom posts @if ($values->type != 'posts') d-none @endif">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>
                            Please select Post to Display
                        </label>
                        <select name="posts[]" class="form-control ajax-select2"></select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group d-flex align-items-center mt-1">
                        <div class="m-t-15 m-checkbox-inline">
                            <div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                                <input class="form-check-input" name="latest_posts" id="latest_posts" type="checkbox"
                                    data-bs-original-title="" title="latest_posts">
                                <label class="form-check-label" for="latest_posts">
                                    Display Latest Posts
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row slider_row border-bottom pages @if ($values->type != 'pages') d-none @endif">
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
