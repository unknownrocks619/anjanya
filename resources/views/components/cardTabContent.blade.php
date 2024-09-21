@php
    $currentOriginalRoute = Illuminate\Support\Facades\Route::getCurrentRoute();
    $parameters = $currentOriginalRoute->parameters();
    if (isset($parameters['tab'])) {
        unset($parameters['tab']);
    }
    $reformUrl = route(Illuminate\Support\Facades\Route::currentRouteName(), $parameters);
@endphp
@if(! isset ($transparent))
    <div class="card">
@endif
    <div class="card-header pt-0">
        <ul class="nav nav-tabs card-header-tabs border-none p-4" role="tablist" style="background: #e9deeb">
            @foreach ($tabs as $tab)
                <li class="nav-item me-2" role="presentation">
                    <a href="{{ $tab['link'] }}"
                        class="js-dynamic-url-mapping btn @if ($tab['type'] == 'ajax-tab') ajax-view-tab @endif @if ((!$activeTab && isset($tab['default'])) || $activeTab == $tab['name']) btn-primary active @else btn-primary @endif"
                        role="tab" data-js-url = "{{ $reformUrl }}/{{ $tab['name'] }}" data-bs-toggle="tab"
                        data-bs-target="#editable_content_nav_{{ $tab['name'] }}"
                        aria-controls="editable_content_nav_{{ $tab['name'] }}" aria-selected="false" tabindex="-1">
                        {{ $tab['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    @if(! isset ($transparent))
        <div class="card-body">
    @endif
        <div class="tab-content p-0">

            @foreach ($tabs as $tab)
                <div class="tab-pane fade @if ((!$activeTab && isset($tab['default'])) || $activeTab == $tab['name']) active show @endif"
                    id="editable_content_nav_{{ $tab['name'] }}" r ole="tabpanel">
                    @includeWhen($tab['type'] == 'ajax-tab', 'ajax-tabs.ajax-loader', [
                        'data' => $tab['data'],
                        'modelName' => $tab['modelName'],
                        $tab['modelName'] => ${$tab['modelName']},
                        'ajaxView' => $tab['ajax-view'] ?? '',
                    ])
                    @includeWhen($tab['type'] == 'tab', $base . '.tabs.' . $tab['name'], [
                        'data' => $tab['data'],
                        $tab['modelName'] => ${$tab['modelName']},
                    ])
                </div>
            @endforeach
        </div>
    @if(! isset ($transparent))
        </div>
    @endif
    
@if(! isset ($transparent))
    </div>
@endif