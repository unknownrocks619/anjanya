<form action="{{ route('admin.book.edit', ['book' => $book]) }}" class="ajax-form" method="post">
    <div class="row mt-2">
        <div class="col-md-8">
            <div class="form-group">
                <label for="book_title">Book Title</label>
                <input type="text" name="book_title" id="book_title" value="{{ $book->book_title }}"
                    class="form-control" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" name="slug" id="slug" value="{{ $book->slug }}" class="form-control" />
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-6">
            <div class="form-group">
                <label for="author">Select Author</label>
                <select name="author" id="author" class="form-control ajax-select-2" data-method="get"
                    data-action="{{ route('admin.users.customers.select2-users') }}">
                    @if ($book->getAuthor)
                        <option value="{{ $book->getAuthor->getKey() }}">
                            {{ $book->getAuthor->getFullName() }}
                        </option>
                    @endif
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="select-project">
                    Select Project
                </label>
                <select name="project" id="project" class="form-control">
                    @foreach (\App\Models\Project::get() as $project)
                        <option value="{{ $project->getKey() }}" @if ($book->default_project == $project->getKey()) selected @endif>
                            {{ $project->title }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>


    <div class="row mt-2">
        <div class="col-md-12">
            <div class="form-group">
                <label for="intro_text">Intro Text</label>
                <textarea name="intro_text" class="form-control">{{ $book->intro_text }}</textarea>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-12 mt-2">
            <div class="form-group">
                <label for="short_description">Short Description</label>
                <textarea name="short_description" class="form-control tiny-mce">{{ $book->short_description }}</textarea>
            </div>
        </div>
        <div class="col-md-12 mt-2">
            <div class="form-group">
                <label for="full_description">Full Description</label>
                <textarea name="full_description" class="form-control tiny-mce">{{ $book->full_description }}</textarea>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-8">
            <div class="form-group">
                <label for="categories">Select Categories</label>
                <select name="categories[]" id="categories" multiple class="form-control">
                    @foreach (\App\Models\Category::where('category_type', 'books')->get() as $category)
                        <option value="{{ $category->getKey() }}" @if ($book->categories && in_array($category->getKey(), $book->categories)) selected @endif>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group">
                <label for="status">Publish Status</label>
                <select name="status" id="status" class="form-control">
                    @foreach (\App\Models\Book::STATUS as $key => $status)
                        <option value="{{ $key }}">
                            {{ $status }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group">
                <label for="status">Canva Link</label>
                <input type="url" name="canva_link" value="{{ $book->canva_link }}" id="canva_link"
                    class="form-control">
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12 text-end">
            <button type="submit" class="btn btn-primary">
                Update Book Information
            </button>
        </div>
    </div>
</form>
