@php
    $values = json_decode($component->values);
@endphp

@if (
    $component->active ||
        auth()->guard('admin')->check())
    <section class="vh-100" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-9 col-xl-7">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-5">

                            <div class="text-center mb-4 pb-2">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-quotes/bulb.webp"
                                    alt="Bulb" width="100">
                            </div>

                            <figure class="text-center mb-0">
                                <blockquote class="blockquote">
                                    <p class="pb-3">
                                        <i class="fa-solid fa-quote-left"></i>
                                        <span class="lead font-italic">
                                            {!! htmlspecialchars_decode($values->quotes) !!}

                                        </span>
                                        <i class="fas fa-quote-right fa-xs text-primary"></i>
                                    </p>
                                </blockquote>
                                {{-- <figcaption class="blockquote-footer mb-0">
                  Thomas Edison
                </figcaption> --}}
                            </figure>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
