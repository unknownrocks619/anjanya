@php
    $containerLayout = 'container-fluid';
    if (isset($values->display_type)) {
        $containerLayout = $values->display_type;
    }
    $columnSize = 'col-lg-12';
    if ($component->display_location && is_array($component->display_location)) {
        $columnSize = 'col-lg-8';
    }
@endphp
@if (
    $component->active ||
        auth()->guard('admin')->check())
    <div class=" my-3 {{ $containerLayout }}">
        <div class="row  @if ($component->display_location && is_array($component->display_location)) sidebar-content @endif">
            <div class="{{ $columnSize }}">
                <div class="row">
                    <div class="col-md-6">
                        <h2>
                            {{ $values->display_title }}
                        </h2>
                        {!! htmlspecialchars_decode($values->registration_tagline) !!}

                        <div class="mt-3">
                            {!! htmlspecialchars_decode($values->registration_button) !!}
                        </div>
                        <div class="row" style="min-height: 250px">
                            <div class="col-md-12 d-flex align-items-end"
                                style="background:url({{ asset('frontend/faq.png') }});background-repeat: no-repeat;background-position:left;background-position-y:100px">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="accordion" id="{{ $component->component_type }}_{{ $component->getKey() }}">
                            @foreach ($values->faqs as $faq)
                                <div class="accordion-item"
                                    style="border:none; border-top: 1px solid #ccc;border-bottom:1px solid #ccc;padding:10px 0px">
                                    <h2 class="accordion-header"
                                        id="heading_{{ $component->component_type }}_{{ $component->getKey() }}{{ $loop->iteration }}">
                                        <a type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                                            data-bs-target="#collapse_{{ $component->component_type }}_{{ $component->getKey() }}{{ $loop->iteration }}">
                                            {!! $faq->title !!}
                                        </a>
                                    </h2>
                                    <div id="collapse_{{ $component->component_type }}_{{ $component->getKey() }}{{ $loop->iteration }}"
                                        class="accordion-collapse collapse"
                                        data-bs-parent="#{{ $component->component_type }}_{{ $component->getKey() }}">
                                        <div class="card-body" style="padding-left: 1.25rem;color:#aa2e2e !important">
                                            {!! $faq->description !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
            @if ($component->display_location && is_array($component->display_location))
                <div class="col-md-4">
                    <div class="sidebar">
                        @foreach ($component->display_location as $sidebarValue)
                            {!! $user_theme->widget($sidebarValue) !!}
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
@endif
