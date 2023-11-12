@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp

<input type="hidden" name="_component_name" value="content" class="component_field  d-none">
<input type="hidden" name="_action" value="store" class="component_field d-none">
<input type="hidden" name="_componentID" value="{{$_loadComponentBuilder->getKey()}}" class="component_field d-none">

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Background Text</label>
                    <input type="text" name="background_text" value="{{$componentValue['background_text']}}" class="form-control component_field" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" name="title" value="{{$componentValue['title']}}" class="form-control component_field">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Underline Text</label>
                    <input type="text" name="underline_text" value="{{$componentValue['underline_text']}}" class="form-control component_field" />
                </div>
            </div>
        </div>
        <div class="row my-4">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="description"  class="form-control component_field tiny-mce">{!! $componentValue['description'] !!}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Content Type</label>
                    <select name="content_type" class="form-control component_field no-select-2">
                        <option value="category" @if($componentValue['content_type'] == 'category') selected @endif>Category</option>
                        <option value="post" @if($componentValue['content_type'] == 'post') selected @endif>Post</option>
                        <option value="page" @if($componentValue['content_type'] == 'page') selected @endif>Page</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row content-type category my-3">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Select Category</label>
                    <select name="category[]" multiple class="form-control component_field ajax-select-2"  data-action="{{route('admin.ajax-select2.categories')}}">
                        @if($componentValue['content_type'] == 'category')
                            @php
                                $categories = \App\Models\Category::whereIn('id',$componentValue['categories'])->get();
                            @endphp
                            @foreach ($categories as $category)
                                <option value="{{$category->getKey()}}" selected>{{$category->category_name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
        </div>

        <div class="row content-type post my-3">
            <div class="col-md-8">
                <div class="form-group">
                    <label>Select post</label>
                    <select name="post[]" multiple class="form-control component_field ajax-select-2"  data-action="{{route('admin.ajax-select2.posts')}}">
                        @if($componentValue['content_type'] == 'post')
                            @php
                                $posts = \App\Models\Post::whereIn('id',$componentValue['post']['ids'])->get();
                            @endphp
                            @foreach ($posts as $post)
                                <option value="{{$post->getKey()}}" selected>{{$post->title}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group d-flex align-items-center mt-1">
                    <div class="m-t-15 m-checkbox-inline">
                        <div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                            <input @if($componentValue['content_type'] == 'post' && $componentValue['post']['latest'] == true) checked @endif class="form-check-input component_field" name="latest_post" id="latest_post" type="checkbox" data-bs-original-title="" title="Active">
                            <label class="form-check-label" for="latest_post">
                                Use Latest 8 post
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row content-type page my-3">
            <div class="col-md-8">
                <div class="form-group">
                    <label>Select page</label>
                    @php
                        $pages = \App\Models\Page::whereIn('id',$componentValue['page']['ids'])->get();
                    @endphp

                    <select name="page[]" multiple class="form-control component_field ajax-select-2" data-action="{{route('admin.ajax-select2.pages')}}">
                        @if($componentValue['content_type'] == 'page')
                            @php
                                $pages = \App\Models\Page::whereIn('id',$componentValue['page']['ids'])->get();
                            @endphp
                            @foreach ($pages as $page)
                                <option value="{{$page->getKey()}}" selected>{{$page->title}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group d-flex align-items-center mt-1">
                    <div class="m-t-15 m-checkbox-inline">
                        <div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                            <input  @if($componentValue['content_type'] == 'page' && $componentValue['page']['latest'] == true) checked @endif  class="form-check-input component_field" name="latest_page" id="latest_page" type="checkbox" data-bs-original-title="" title="Active">
                            <label class="form-check-label" for="latest_page">
                                Use Latest 6 Page
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $.each($('select'), function (index, element) {
        if (!$(element).hasClass('no-select-2')) {
            window.ajaxReinitalize(element);
        }
    });
    window.setupTinyMce();
    contentType();
    function contentType() {
        $('.content-type').addClass('d-none');
        let _selectedContent = $('select[name="content_type"]').find(':selected').val();
        $('.' + _selectedContent).removeClass('d-none');
    }

    $(document).on('change',$('select[name="content_type"]'), function() {
        contentType();
    })
</script>
