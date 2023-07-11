<div class="bring-section">
    <div class="container">
        <div class="row justify-content-between mt-5 pt-5">
            @foreach ($values->contents as $column_icon)
                <div class="col-lg-4 mb-4 px-5 px-md-3">
                    <div class="bring-card">
                        <div class="bring-icon text-center mb-3">
                            <i aria-hidden="true" class="{{ $column_icon->icon }}"></i>
                        </div>
                        <h4 class="mb-3">{!! htmlspecialchars_decode($column_icon->title) !!}</h4>
                        <div>
                            {!! htmlspecialchars_decode($column_icon->content) !!}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
