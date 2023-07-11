<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table data-action="{{ route('admin.sort.re-order-column', ['model_name' => 'Chapter']) }}" data-method="post"
                class="table table-hover display datatable-lister-sortable">
                <thead>
                    <tr>
                        <th></th>
                        <th>Chapter name</th>
                        @if (!isset($course))
                            <th>
                                Course name
                            </th>
                        @endif
                        <th>Status</th>
                        <th>Total Lession</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($chapters as $chapter)
                        <tr data-sort-id="{{ $chapter->getKey() }}">
                            <td class="text-center sortable-handle">
                                <i class="fa fa-sort fs-3"></i>
                            </td>
                            <td>
                                {{ $chapter->chapter_name }}
                            </td>
                            @if (!isset($course))
                                <td>
                                    {{ $chapter->getCourse->course_name }}
                                </td>
                            @endif
                            <td>
                                {!! \App\Classes\Helpers\Status::active_label($chapter->active) !!}
                            </td>
                            <td>
                                {!! $chapter->lessions->count() !!}
                            </td>
                            <td>
                                <?php
                                $editChapter = route('admin.chapters.edit', ['chapter' => $chapter]);
                                
                                if (isset($course) && !is_null($course)) {
                                    $editChapter = route('admin.chapters.edit', ['chapter' => $chapter, 'course' => $course, 'current_tab' => 'general']);
                                }
                                ?>
                                <ul class="action">

                                    <li class="edit">
                                        <a href="{{ $editChapter }}"><i class="icon-pencil-alt"></i>
                                        </a>
                                    </li>
                                    <li class="delete">
                                        <a href="#" class="data-confirm" data-method="post"
                                            data-action="{{ route('admin.chapters.delete_course', ['chapter' => $chapter]) }}"
                                            data-method="post">
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
