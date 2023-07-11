<div class="up-s">
    <div class="container">
        <div class="up-grid">
            @foreach ($values->contents as $column_icon)
                <div class="up-card">
                    <div class="up-img b1"
                        @if (isset($column_icon->background)) style="background: {{ $column_icon->background }} !important" @endif>
                        <i aria-hidden="true" class="{{ $column_icon->icon }}"></i>
                    </div>
                    <div class="up-t">
                        {!! htmlspecialchars_decode($column_icon->title) !!}
                    </div>
                    <div class="up-p">
                        {!! htmlspecialchars_decode($column_icon->content) !!}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
