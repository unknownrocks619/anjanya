@if (isset($previewSliderItem) && isset($previewImage))
    @php
        $image = \App\Classes\Helpers\Image::getImageAsSize($previewImage->filepath);
    @endphp
    <div class="row mt-1">
        <form action="{{route('admin.gallery-items.update',['album'=>$previewSliderItem->gallery_albums_id,'item'=>$previewSliderItem->getKey()])}}" class="ajax-form" method="post">
            <div class="col-md-12 text-center">
                <img src='{{ $image }}' class="img-responsive"/>
            </div>
            <div class="col-md-12 mt-3 bg-light text-black-50 p-2">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="heading_one">Heading One</label>
                            <input type="text" name="heading_one" value="{{$previewSliderItem->heading_one}}" id="heading_one" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="heading_two">Heading Two</label>
                            <input type="text" name="heading_two" id="heading_two" class="form-control" value="{{$previewSliderItem->heading_two}}">
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="subtitle">Subtitle</label>
                            <input type="text" name="subtitle" id="subtitle" class="form-control" value="{{$previewSliderItem->subtitle}}">
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control">{!! $previewSliderItem->description !!}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-3">
                        <div class="form-group d-flex align-items-center mt-1">
                            <div class="m-t-15 m-checkbox-inline">
                                <div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                                    <input @if($previewSliderItem->featured_background) checked @endif class="form-check-input" name="featured_background" id="featured" type="checkbox" data-bs-original-title="" title="featured">
                                    <label class="form-check-label" for="featured">
                                        Image Background
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group d-flex align-items-center mt-1">
                            <div class="m-t-15 m-checkbox-inline">
                                <div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                                    <input @if($previewSliderItem->featured_button) checked @endif class="form-check-input" name="featured_button" id="featured_button" type="checkbox" data-bs-original-title="" title="Display Icon on Button side">
                                    <label class="form-check-label" for="featured_button">
                                        Aside Button
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12 text-end">
                        <button type="submit" class="btn btn-primary">
                            Save Changes
                        </button>
                    </div>
                </div>
            </div>


        </form>
    </div>
@endif
