<div class="card">
    <div class="card-header bg-primary" id="{{ $component->component_type }}_{{ $component->getKey() }}">
        <h3 class="mb-0">
            <button class="btn btn-link ps-0 text-white" data-bs-toggle="collapse"
                data-bs-target="#{{ $component->component_type }}_{{ $component->getKey() }}" aria-expanded="true"
                aria-controls="{{ $component->component_type }}_{{ $component->getKey() }}" data-bs-original-title=""
                title=""><i class="icofont icofont-briefcase-alt-2"></i>
                {{ __('components.' . $component->component_type) }}
            </button>
        </h3>
    </div>
    <div class="collapse" id="{{ $component->component_type }}_{{ $component->getKey() }}" aria-labelledby="headingOne"
        data-bs-parent="#accordionicon">
        <div class="card-body">
            @include('themes.components.lms_resource.view.admin.edit', ['component' => $component])
        </div>

    </div>
</div>


