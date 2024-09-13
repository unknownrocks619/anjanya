@foreach ($model?->webComponents ?? [] as $components)
    @foreach ($components->getComponents as $component)
        @php
            $componentService = new \App\Classes\Components\Component($component->component_type);
        @endphp
        @if (isset($_ENV['ENABLE_PREVIEW_MODE']))
            <hr />
            <div class="my-0 py-0 text-right d-flex justify-content-end preview-on">
                <button onclick="window.parent.CB.selectComponent(this,'edit')"
                    data-url="{{ route('admin.components.common.edit', ['webcomponent' => $components, 'component_name' => $component->component_type, 'componentID' => $component->getKey()]) }}"
                    class="btn btn-primary btn-icon">
                    <i class="fas fa-edit"></i>
                </button>
                <button onclick="window.parent.CB.removeComponent(this)" type="button"
                    class="btn btn-danger btn-icon ms-1" data-web-id="{{ $components->getKey() }}"
                    data-component-id={{ $component->getKey() }}
                    data-url="{{ route('admin.components.common.edit', ['webcomponent' => $components, 'component_name' => $component->component_type, 'componentID' => $component->getKey()]) }}">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        @endif
        {!! $componentService->previewBuilder(['_loadComponentBuilder' => $component, 'model' => $model]) !!}
    @endforeach
@endforeach
