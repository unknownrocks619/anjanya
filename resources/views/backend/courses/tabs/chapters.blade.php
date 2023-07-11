<div class="row">
    <div class="col-md-12 text-end">
        <a href="{{ route('admin.chapters.create', ['current_tab' => 'chapters', 'course' => $course]) }}"
            class="btn btn-primary">Add new Chapter</a>
    </div>
</div>
@include('backend.chapters.list', ['chapters' => $content, 'course' => $course])
