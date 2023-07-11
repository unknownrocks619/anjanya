<?php
$values = json_decode($component->values);
?>
<div class="row">
    <div class="col-md-12 alert alert-warning">
        Template Render for &lt;registration&gt; etc are not viewable in this panel.
    </div>
    <div class="col-md-12">
        {!! $values->paragraph !!}
    </div>
</div>
