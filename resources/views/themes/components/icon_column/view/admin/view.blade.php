<?php
$values = json_decode($component->values);
?>
@if ($values->layout == 'home_theme')
    <div class="row border-bottom my-2">
        @foreach ($values->contents as $content)
            <div class="col-md-4 d-flex justify-content-center">
                <i class="fs-3 {{ $content->icon }}"></i>
                <div class="up-t" style="color: #242254">
                    <h3>{{ $content->title }}</h3>
                </div>
                <div class="description">
                    {{ $content->content }}
                </div>
            </div>
        @endforeach
    </div>
@endif

@if ($values->layout == 'course_theme')
    <div class="row my-4">
        <div class="col-md-12 d-flex justify-content-between">
            @foreach ($values->contents as $content)
                <div class="">
                    <i class="fs-3 {{ $content->icon }}"></i>
                    <div class="up-t" style="color: #242254">
                        <h3>{{ $content->title }}</h3>
                    </div>
                    <div class="description">
                        {!! $content->content !!}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
