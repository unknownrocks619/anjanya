<form action="{{ route('admin.org.edit', ['org' => $org]) }}" method="post" class="ajax-form">
    <div class="row g-2">
        <div class="mb-3 col-md-6 mt-0">
            <div class="form-group">
                <label for="con-name">Organisation Name</label>
                <input class="form-control" id="org_name" name="org_name" type="text" required=""
                    placeholder="Organisation Name" autocomplete="off" value="{{ $content->organisation_name }}">
            </div>
        </div>
        <div class="mb-3 col-md-6 mt-0">
            <div class="form-group">
                <label for="con-name">Slug</label>
                <input value="{{ $content->slug }}" class="form-control" id="slug" name="slug" type="text"
                    required="" placeholder="Slug" autocomplete="off">
            </div>
        </div>
    </div>

    <div class="row g-2">
        <div class="col-md-12">
            <div class="form-group">
                <label for="short_description">
                    Short Description
                </label>
                <textarea name="short_description" id="short_description" class="form-control tiny-mce">{!! $content->short_description !!}</textarea>
            </div>
        </div>
    </div>

    <div class="row g-2">
        <div class="col-md-12">
            <div class="form-group">
                <label for="full_description">
                    Full Description
                </label>
                <textarea name="full_description" id="full_description" class="form-control tiny-mce">{!! $content->full_description !!}</textarea>
            </div>
        </div>
    </div>

    <div class="row g-2">
        <div class="mb-3 col-md-6 mt-2">
            <div class="form-group">
                <label for="con-mail">Type</label>
                <select name="type" id="type" class="form-control">
                    @foreach (App\Models\Organisation::ORG_TYPES as $key => $value)
                        <option value="{{ $key }}" @if ($org->type == $key) selected @endif>
                            {{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-3 col-md-6 mt-4 d-flex align-items-center">
            <div class="form-group d-flex align-items-center">
                <div class="m-t-15 m-checkbox-inline">
                    <div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                        <input class="form-check-input" id="active" type="checkbox" data-bs-original-title=""
                            title="">
                        <label class="form-check-label" for="active">
                            Active
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-2">
        <div class="col-md-12 text-end">
            <button type="submit" class="btn btn-primary">
                Update Detail
            </button>
        </div>
    </div>
</form>
