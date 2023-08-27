<ul class="d-flex flex-row files-content datatable-sortable-component ui-sortable">
    @forelse ($sliders as $slider)
        @php
            $sliderImage = $slider->getImage()->first();
            $image = \App\Classes\Helpers\Image::getImageAsSize($sliderImage->image->filepath,'xs');
        @endphp
        <li class="folder-box d-flex align-items-center" data-sort-id="{{$slider->getKey()}}">
            <div class="d-flex align-items-center files-list border">
                <div class="mx-1 sortable-handle">
                    <i class="fa fa-arrows-alt"></i>
                </div>
                <div class="">
                    <img src="{{$image}}" class="img-fluid" />
                </div>
                <div class="ms-2 px-1">
                    <h6>{{ $slider->heading_one }}</h6>
                    <p>{{ $slider->created_at->format('H:i:s Y-m-d') }}, 2.0 MB</p>
                    <p>
                        <a href="" class="image-preview-edit" data-endpoint="{{route('admin.slider.items.edit',['album'=>$slider->slider_album_id,'slider'=>$slider->getKey()])}}">
                            Edit

                        </a> |
                        <a href="" data-method="post" data-action="{{route('admin.slider.items.delete',['album'=>$slider->slider_album_id,'slider'=>$slider->getKey()])}}" class="text-danger data-confirm" data-confirm="Are you sure, You cannot undo this action ?">
                            Delete
                        </a>
                    </p>
                </div>
            </div>
        </li>
    @empty
        <li class="folder-box d-flex align-items-center">
            <div class="d-flex align-items-center files-list">
                <div class="flex-shrink-0 file-left"><i class="f-22 fa fa-folder font-info"></i>
                </div>
                <div class="flex-grow-1 ms-xxl-3 ms-xl-2">
                    <h6>No Images Found.</h6>
                </div>
            </div>
        </li>
    @endforelse
</ul>
