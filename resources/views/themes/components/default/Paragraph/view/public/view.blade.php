@if (
    $component->active ||
        auth()->guard('admin')->check())
    <div class="row">
        <div class="col-md-12 my-1 ">
            <div class="post-content clearfix">
                {!! htmlspecialchars_decode($values->paragraph) !!}
            </div>
        </div>
    </div>
@endif
