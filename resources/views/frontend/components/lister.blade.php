@foreach ($model?->webComponents?? [] as $components)
    @foreach ($components->getComponents as $component)
        @php
            $componentService = new \App\Classes\Components\Component($component->component_type);
        @endphp
        {!! $componentService->previewBuilder(['_loadComponentBuilder' => $component]) !!}
  @endforeach
@endforeach
