@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp

<script>
    var updateIframeProperty = function(elm) {
        let _elmContent = $($(elm).val());

        if ($(_elmContent).attr('height')) {
            $('input[name="iframe_height"]').val($(_elmContent).attr('height'))
        }
        if ($(_elmContent).attr('width')) {
            $('input[name="iframe_width"]').val($(_elmContent).attr('width'))
        }
        // Check if the iframe has a 'style' attribute
        if ($(_elmContent).attr('style')) {
            // Get the style attribute
            let styleAttr = $(_elmContent).attr('style');

            // Use a regular expression to find the 'border' style
            let borderMatch = styleAttr.match(/border\s*:\s*([^;]+);?/i);

            // If there is a border style, set the input value
            if (borderMatch && borderMatch[1]) {
                $('input[name="iframe_border"]').val(borderMatch[1]);
            }
        }
    }

    var updateiframeCode = function(elm) {
        let height = $('input[name="iframe_height"]').val();
        let width = $('input[name="iframe_width"]').val();
        let border = $('input[name="iframe_border"]').val();
        let _iframeCode = $($('#iframe_code').val());

        _iframeCode.attr('height', height);

        if (width && !width.includes('%')) {
            _iframeCode.attr('width', width);
        }

        if (width && width.includes('%')) {
            _iframeCode.removeAttr('width');
        }

        let styleAttr = $(_iframeCode).attr('style') || '';
        let updatedStyle = styleAttr.replace(/border\s*:\s*[^;]+;?/i, '').replace(/width\s*:\s*[^;]+;?/i, '');

        // Append new 'border' and 'width' styles
        if (border) {
            updatedStyle += `border: ${border};`;
        }
        if (width && width.includes('%')) {
            updatedStyle += `width: ${width};`;
        }

        $(_iframeCode).attr('style', updatedStyle.trim());
        $('#iframe_code').val($(_iframeCode)[0].outerHTML)

    }
</script>

<div class="row align-items-center">
    <div class="col-md-12">
        <div class="component-container">
            <input type="hidden" name="_component_name" value="iframe" class="component_field  d-none">
            <input type="hidden" name="_componentID" value="{{ $_loadComponentBuilder->getKey() }}"
                class="d-none component_field">
            <input type="hidden" name="_action" value="store" class="component_field d-none">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="iframe_code" class="text-dark">Iframe Code</label>
                        <textarea onchange="updateIframeProperty(this)" name="iframe" rows="5" id="iframe_code"
                            class="form-control component_field">{{ $componentValue['iframe'] ?? '' }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="iframe_code" class="text-dark">Height</label>
                        <input onchange="updateiframeCode(this)" type="text" name="iframe_height" id="iframe_height"
                            class="form-control component_field" value="{{ $componentValue['height'] ?? '0' }}" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="iframe_code" class="text-dark">Width</label>
                        <input onchange="updateiframeCode(this)" type="text" name="iframe_width" id="iframe_width"
                            class="form-control component_field" value="{{ $componentValue['width'] ?? '0' }}" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="iframe_code" class="text-dark">Border</label>
                        <input onchange="updateiframeCode(this)" type="number" name="iframe_border" id="iframe_border"
                            class="form-control component_field" value="{{ $componentValue['border'] ?? '0' }}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
