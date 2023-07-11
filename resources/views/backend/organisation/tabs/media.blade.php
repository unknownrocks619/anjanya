<div class="row g-2 bg-white">
    <div class="col-md-12 mt-4">
        <div class="card-body">
            <div class="dropzone dropzone-info dz-area" id="fileTypeValidation"
                action="{{ route('admin.org.upload', ['org' => $org->getKey(), 'current_tab' => 'media']) }}"
                data-max-file='6'>
                <div class="dz-message needsclick"><i class="icon-cloud-up"></i>
                    <h4>Drop files here or click to upload.</h4><span class="note needsclick">
                        Upload now organize later. Simple :)
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3 bg-light">
        <?php
        $org_image_type = \App\Models\Organisation::IMAGE_TYPES;
        ?>
        @foreach ($content as $image)
            <div class="row mt-3 border-bottom mb-2">
                <div class="col-md-3">
                    <img src="{{ \App\Classes\Helpers\Image::getImageAsSize($image->image->filepath, 'm') }}"
                        class="img-fluid w-25" />
                </div>
                <div class="col-md-3 d-flex align-items-center">
                    <h3 class="text-dark">{{ $org->organisation_name }} - {{ $image->type }}</h3>
                </div>
                <div class="col-md-3 d-flex align-items-center">
                    <select name="image_type[]" class="form-control update-from-select"
                        data-action="{{ route('admin.org.update_image_type', ['org' => $org->getKey(), 'image_relation' => $image->getKey(), 'current_tab' => 'media']) }}">
                        <option value="">Select Option</option>
                        @foreach ($org_image_type as $key => $type)
                            <option value="{{ $key }}" @if ($key == $image->type) selected @endif>
                                {{ $type }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 d-flex justify-content-end">
                    <button type='button' data-confirm='Are you Sure ?'
                        data-action="{{ route('admin.org.remove_image', ['org' => $org, 'image_relation' => $image, 'current_tab' => 'media']) }}"
                        target="_blank" class="data-confirm btn btn-sm px-3 py-2 btn-danger">
                        <i class="fa fa-trash-o fs-3"></i>
                    </button>
                </div>

            </div>
        @endforeach
    </div>
</div>
