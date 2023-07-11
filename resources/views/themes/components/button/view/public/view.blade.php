<?php
$values = json_decode($component->values);
?>

<div class="row">
    @foreach ($values as $button)
        <div class='col-md-{{ $button->size }} my-1'>
            @if (!isset($button->theme))
                <themecolor>
            @endif
            <a href='{{ $button->link }}' class="btn btn-block w-100"
                @if (isset($button->theme)) style="background: {{ $button->theme }};color:#fff" @endif>
                {{ $button->label }}
            </a>
            @if (!isset($button->theme))
                </themecolor>
            @endif
        </div>
    @endforeach
</div>
