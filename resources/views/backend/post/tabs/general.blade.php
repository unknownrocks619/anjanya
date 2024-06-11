@php
    /** @var \App\Models\Post $post */
    $componentValue['glitter_background'] = $post->glitter_background;
@endphp
<form action="{{ route('admin.posts.edit', ['post' => $post]) }}" class="ajax-form" method="post">
    <div class="row">
        <!-- Zero Configuration  Starts-->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row g-2">
                        <div class="mb-3 col-md-8 mt-0">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input class="form-control" id="title" name="title" type="text" required=""
                                    placeholder="Title" autocomplete="off" value="{{ $post->title }}">
                            </div>
                        </div>
                        <div class="mb-3 col-md-4 mt-0">
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input class="form-control" id="slug" name="slug" type="text" required=""
                                    placeholder="Page Slug" autocomplete="off" value="{{ $post->slug }}">
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="mb-3 col-md-12 mt-0">
                            <div class="form-group">
                                <label for="page_title">Intro Text</label>
                                <textarea name="intro_text" class="form-control">{!! $post->intro_description !!}</textarea>
                            </div>
                        </div>
                        <div class="mb-3 col-md-12 mt-0">
                            <div class="form-group">
                                <label for="page_title">Short Description</label>
                                <textarea name="short_description" class="form-control tiny-mce">{!! $post->short_description !!}</textarea>
                            </div>
                        </div>
                        <div class="mb-3 col-md-12 mt-0">
                            <div class="form-group">
                                <label for="page_title">Full Description</label>
                                <textarea name="full_description" class="form-control tiny-mce">{!! $post->full_description !!}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="status">Post Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="draft">Draft</option>
                                    <option value="pending">Pending</option>
                                    <option value="active">published</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="post_type">Post Type</label>
                                <select name="post_type" id="post_type" class="form-control">
                                    <option value="blog" @if ($post->type == 'blog') selected @endif>Blog
                                    </option>
                                    <option value="gallery" @if ($post->type == 'gallery') selected @endif>Gallery
                                    </option>
                                    <option value="video" @if ($post->type == 'video') selected @endif>Video
                                    </option>
                                </select>
                            </div>
                        </div>
                        @if(env('APP_THEMES') == 'siddhamahayog')
                            <div class='col-md-4'>
                                @include('themes.frontend.siddhamahayog.components.common.glitter',['componentValue' => $componentValue])
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="categories">Categories</label>
                                <select name="categories[]" multiple id="categories" class="form-control ajax-select-2"
                                    data-action="{{ route('admin.ajax-select2.categories') }}">
                                    @foreach ($post->getCategories() as $category)
                                        <option value="{{ $category->getKey() }}" selected>
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Zero Configuration  Ends-->
    </div>
    <div class="row my-2">
        <div class="col-md-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">
                Update Post
            </button>
        </div>
    </div>
</form>
