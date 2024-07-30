    @if (!isset($model))
        @php

            $modelReference = $namespace . '\\' . ucfirst($modelName);
            $model = $modelReference
                ::where((new $modelReference())->getKeyName(), $$modelName[(new $modelReference())->getKeyName()])
                ->with('getSeo')
                ->first();
            $seo = $model?->getSeo?->seo;
        @endphp
    @endif

    <form action="{{ route('admin.seo.store', ['model' => $model]) }}" method="post" class="ajax-form">
        <input type="hidden" name="model_name" value="{{ $model::class }}">
        <div class="row g-2">
            <div class="col-md-12 mt-1">
                <div class="form-group">
                    <label for="seo_title">SEO Title</label>
                    <input type="text" name="seo_title" value="{{ $seo?->title }}" id="seo_title"
                        class="form-control">
                </div>
            </div>
        </div>

        <div class="row g-2 mt-1">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label for="seo_keyword">SEO Keyword</label>
                    <input type="text" name="seo_keyword" id="seo_keyword" value="{{ $seo?->keyword }}"
                        class="form-control">
                </div>
            </div>
        </div>


        <div class="row g-2 mt-1">
            <div class="col-md-12 ">
                <div class="form-group">
                    <label for="seo_title">SEO Description</label>
                    <textarea name="seo_description" id="seo_description" cols="30" rows="10" class="form-control">{{ $seo?->description }}</textarea>
                </div>
            </div>
        </div>

        <div class="row g-2 mt-1">
            <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary btn-lg">
                    Save
                </button>
            </div>
        </div>
    </form>
