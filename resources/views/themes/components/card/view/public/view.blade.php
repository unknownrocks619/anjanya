@php
    $card_content = json_decode($values->card_content);
@endphp
<div class="image-card-section">
    <div class="container-fluid">
        <div class="row">
            @foreach ($card_content as $card_element)
                <div class="col-md-{{ $values->size }} text-center">
                    <div class="card" style="border: none">
                        @if ($card_element->title)
                            <div class="card-header"
                                @if ($card_element->background_color) style="background : {{ $card_element->background_color }};border:none;color:#ffffff" @else style="background:transparent;border:none" @endif>
                                <h2>{{ $card_element->title }}</h2>
                            </div>
                        @endif
                        <div class="card-body">
                            @if ($card_element->media->type == 'image')
                                <img src="{{ \App\Classes\Helpers\Image::getImageAsSize($card_element->media->images, 'm') }}"
                                    class="img-fluid" />
                            @endif
                            @if ($card_element->media->type == 'video')
                                @if (isset($card_element->media->video->query->host))
                                    {!! \App\Classes\Helpers\Video::renderCardVimeo($card_element->media->video->id) !!}
                                @else
                                    {!! \App\Classes\Helpers\Video::renderCardYoutube($card_element->media->video->id) !!}
                                @endif
                            @endif

                            {!! htmlspecialchars_decode($card_element->body) !!}
                        </div>
                        @if (isset($card_element->footer->label) && $card_element->footer->label != '')
                            <div class="card-footer d-flex justify-content-{{ $card_element->footer->position }}"
                                style="border: none; background: transparent">
                                <a href='{{ $card_element->footer->link }}'>{!! htmlspecialchars_decode($card_element->footer->label) !!}</a>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
