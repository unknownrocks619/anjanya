@extends('themes.admin.master')

@push('page_title')
    - Courses
@endpush

@section('main-content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>All Courses</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <a href="{{ route('admin.menu.create') }}" data-bs-target='#newCourseModal' data-bs-toggle='modal'
                            class="btn btn-primary">
                            Add New Course
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table datatable-lister-sortable"
                                data-action="{{ route('admin.sort.re-order-column', ['model_name' => 'Course']) }}">
                                <thead>
                                    <tr>
                                        <th>

                                        </th>
                                        <th>Course Title</th>
                                        <th>Status</th>
                                        <th>Permission</th>
                                        <th>
                                            Meta
                                        </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($courses as $course)
                                        <tr data-sort-id="{{ $course->getKey() }}">
                                            <td class="text-center sortable-handle">
                                                <i class="fa fa-sort fs-3"></i>
                                            </td>
                                            <td>
                                                {{ $course->course_name }}
                                            </td>
                                            <td>
                                                @php echo \App\Classes\Helpers\Status::active_label($course->active) @endphp
                                            </td>
                                            <td>

                                            </td>
                                            <td>
                                                <strong>{{ $course->chapters_count }}</strong>
                                                {{ \Illuminate\Support\Str::plural('Chapter', $course->chapters_count) }}
                                                <br />
                                                <strong>{{ $course->lessions_count }}</strong>
                                                {{ \Illuminate\Support\Str::plural('Lession', $course->lessions_count) }}
                                            </td>
                                            <td>
                                                <ul class="action">
                                                    <li class="edit">
                                                        <a href="{{ route('admin.courses.edit', ['course' => $course]) }}">
                                                            <i class="icon-pencil-alt"></i>
                                                        </a>
                                                    </li>
                                                    <li class="delete">
                                                        <a href="#" class="data-confirm" data-confirm="Are you Sure ?"
                                                            data-method="post"
                                                            data-action="{{ route('admin.courses.delete_course', ['course' => $course]) }}">
                                                            <i class="icon-trash"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Zero Configuration  Ends-->
        </div>
    </div>
    <x-modal id='newCourseModal'>
        @include('backend.courses.modal.new')
    </x-modal>
@endsection
