<div class="row my-2">
    <div class="col-md-12 d-flex justify-content-end">
        <a href="{{ route('admin.org.projects.add', ['org' => $org->getKey()]) }}" class="btn btn-info">
            Add Project
        </a>
    </div>
</div>
@include ('backend.organisation.projects.list', ['projects' => $content, 'associate' => $org]);
