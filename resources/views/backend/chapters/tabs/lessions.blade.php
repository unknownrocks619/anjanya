<?php
$newLession = route('admin.lessions.create');

if (isset($chapter) && !is_null($chapter)) {
    $newLession = route('admin.lessions.create', ['chapter' => $chapter]);
}

if (isset($course) && !is_null($course)) {
    $newLession = route('admin.lessions.create', ['chapter' => $chapter, 'course' => $course]);
}
?>
<div class="row my-3">
    <div class="col-md-12 text-end">
        <a href="{{ $newLession }}" class="btn btn-warning">
            Add Video Lession
        </a>
    </div>
</div>

@include('backend.lessions.list', ['lessions' => $content, 'chapter' => $chapter, 'course' => $course])
