<?php
$imageGallery = $gallery;
$image_galley = \App\Models\Image::whereIn('id', $imageGallery)->get();
?>
<div class="row mansonry-design-component-preview-wrapper">
    @foreach ($image_galley as $key => $image)
        <div class="col mansonry-design-component-preview">
            <div class="card">
                <div class="card-body">
                    <img src='{{ App\Classes\Helpers\Image::getImageAsSize($image->filepath, 'm') }}'
                        class="img-fluid w-50" />
                </div>
                <div class="card-footer text-center">
                    <button data-method='post'
                        data-action="{{ route('admin.components.delete-element', ['componentBuilder' => $component, 'index' => $key]) }}"
                        class="btn btn-danger data-confirm" data-confirm='Are you Sure ?'>Delete</button>
                </div>
            </div>
        </div>
    @endforeach
</div>
