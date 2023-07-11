@php
    $values = json_decode($component->values);
@endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <p class="text-pink fs-100 text-center implement-theme-color">
                <i aria-hidden="true" class="fas fa-quote-left"></i>
            </p>
            <div class="text-center fw-300 mb-4">
                {!! htmlspecialchars_decode($values->quotes) !!}
            </div>
            <p class="text-pink fs-100 text-center implement-theme-color">
                <i aria-hidden="true" class="fas fa-quote-right"></i>
            </p>
        </div>
    </div>
</div>
