@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;

    $type = 'custom';
    $layout = 'container';
    if (isset($componentValue['type']) && $componentValue['type'] != 'custom') {
        $type = $componentValue['type'];
    }

    if (isset($componentValue['layout']) && $componentValue['layout'] != 'container') {
        $layout = $componentValue['layout'];
    }

@endphp
@foreach ($componentValue['data'] as $row => $data)
    @foreach ($data as $dataIndex => $icon_builder)
        <style type="text/css">
            .on-hover-effect-{{ $row }}-{{ $dataIndex }}:hover {
                border: 1px solid {{ isset($icon_builder['color']) ? isset($icon_builder['color']) : '#000000' }} !important;
                background: {{ isset($icon_builder['color']) ? isset($icon_builder['color']) : '#000000' }}12 !important;
                transition: all .3s ease;
            }
        </style>
    @endforeach
@endforeach
<div class="{{ $layout }} py-2">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="text-center mb-4">
                <h2 class="display-2 fw-bolder">{{ $componentValue['title'] ?? '' }}</h2>
            </div>
            @if (isset($componentValue['description']) && !empty(trim($componentValue['description'])))
                <div class="text-center">
                    {!! $componentValue['description'] !!}
                </div>
            @endif
            <!-- /lc-block -->
        </div>
        <!-- /col -->
    </div>
    @foreach ($componentValue['data'] as $row => $data)
        <div class="row mb-4">
            @foreach ($data as $dataIndex => $icon_builder)
                <div class="col-{{ $componentValue['column'] }} text-center">
                    <div class="on-hover-effect-{{ $row }}-{{ $dataIndex }} rounded-circle d-flex justify-content-center align-items-center mx-auto bg-light"
                        style="width:72px; height:72px;">
                        <i class="fs-3 fas {{ $icon_builder['icon'] }}"
                            @if (isset($icon_builder['color'])) style="background:{{ $icon_builder['color'] }}" @endif></i>
                    </div>
                    <h5 class="mt-3"> {{ $icon_builder['title'] }}</h5>
                    <div class="mt-2">
                        {!! $icon_builder['description'] !!}
                    </div>
                </div>
            @endforeach

        </div>
    @endforeach
