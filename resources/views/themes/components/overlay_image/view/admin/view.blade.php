<div class="card-body">
    <?php
    $values = json_decode($component->values);
    $style = '';
    if ($values->min_height) {
        $style .= 'min-height:' . (float) $values->min_height . $values->unit . ';';
    }
    
    if ($values->min_width) {
        $style .= 'min-width: ' . (float) $values->min_width . $values->unit . ';';
    }
    
    if (!$component->getImage || !$component->getImage->count()) {
        $image_url = '';
        $style = '';
    } else {
        $image = $component->getImage[0]->image;
        $image_url = \App\Classes\Helpers\Image::getImageAsSize($image->filepath, 'l');
        $style .= 'background: url(' . $image_url . ');';
        $style .= 'position:relative;background-repeat: no-repeat;background-position:center;background-size:contain';
    }
    ?>

    <div class="row mb-4">
        <div class="col-md-12" style="{{ $style }};">
            @if ($values->title)
                <h1 class="fs-1 d-flex justify-content-center">{{ $values->title }}</h1>
            @endif
            @if ($values->description)
                <div class="description d-flex justify-content-center">
                    {!! $values->description !!}
                </div>
            @endif
        </div>
        @if ($values->buttons && count($values->buttons))
            <div class="col-md-12" style="position:absolute;top:20%;display:flex;justify-content:center">
                @foreach ($values->buttons as $button)
                    @if ($button->link)
                        <a href="{{ $button->link }}" class='btn btn-primary ms-2'>
                            {{ $button->label }}
                        </a>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</div>
