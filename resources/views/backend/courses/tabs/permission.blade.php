<div class="row p-2 bg-light">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="permission_level" class="text-dark">Permission Level</label>
                    <select name="permission" id="permission" class="form-control">
                        <option value="">All</option>
                        @foreach (\App\Models\Course::PERMISSIONS as $key => $permission)
                            <option value="{{ $key }}">{{ $permission }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6 organisation d-none">
                <div class="form-group">
                    <label for="organisation_level" class="text-dark">Organisation</label>
                    <select name="organisation" id="organisation" class="form-contro">
                        <option value="">All</option>
                        @foreach (\App\Models\Organisation::get() as $organisation)
                            <option value="{{ $organisation->getKey() }}">{{ $organisation->organisation_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-md-6 d-none teacher">
                <label for="teacher" class='text-dark'>Teacher</label>
                <select name="teacher" id="teacher" class="form-control"></select>
            </div>
            <div class="col-md-6 student d-none">
                <label for="student" class="text-dark">Student</label>
                <select name="student" id="student" class="form-control"></select>
            </div>
        </div>
    </div>
</div>

<div class="row mt-2 d-flex justify-content-center">
    <div class="col-md-12">
        <div class="card mb-0">
            <div class="card-header">
                <h3 class="mb-0">Course Permission Management </h3>
            </div>
            <div class="card-body p-0">
                <div class="taskadd">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>
                                        <h4 class="task_title_0">Permission Header</h4>
                                    </td>
                                    <td>
                                        <h4 class="task_title_1">Status</h4>
                                    </td>
                                </tr>

                            </thead>
                            <tbody>
                                @if (!$course->permission)
                                    <tr>
                                        <td>
                                            Public
                                        </td>
                                        <td>
                                            <i class="fa fa-check fs-3 text-success"></i>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            Organisation
                                        </td>
                                        <td>
                                            <i class="fa fa-check fs-3 text-success"></i>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            Teacher
                                        </td>
                                        <td>
                                            <i class="fa fa-check fs-3 text-success"></i>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            Student
                                        </td>
                                        <td>
                                            <i class="fa fa-check fs-3 text-success"></i>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>
                                            Admin
                                        </td>
                                        <td>
                                            <i class="fa fa-check fs-3 text-success"></i>
                                        </td>

                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
