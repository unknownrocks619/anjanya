<div class="row align-items-center d-none">
    <div class="col-md-12">
        <div class="component-container">
            <input type="hidden" name="_component_name" value="iframe" class="component_field  d-none">
            <input type="hidden" name="_action" value="store" class="component_field d-none">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="iframe_code" class="text-dark">Iframe Code</label>
                        <textarea name="iframe" rows="5" id="iframe_code" class="form-control component_field"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(() => {
        window.CB.updateComponent();
        setTimeout(() => {
            // reload iframe,
            document.getElementById('slider_frame').contentWindow.location.reload();
        }, 1000);
    });
</script>
