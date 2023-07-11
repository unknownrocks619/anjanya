<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table data-action="{{ route('admin.sort.re-order-column', ['model_name' => 'Lession']) }}"
                class="table
                table-hover display datatable-lister-sortable" id='user-lession-table'>
                <thead>
                    <tr>
                        <th></th>
                        <th>Lession Name</th>
                        @if (!isset($course))
                            <th>
                                Course name
                            </th>
                        @endif
                        @if (!isset($chapter))
                            <th>
                                Chapter name
                            </th>
                        @endif
                        <th>Status</th>
                        <th>Total Duration</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lessions as $lession)
                        <tr data-sort-id="{{ $lession->getKey() }}">
                            <td class="text-center sortable-handle">
                                <i class="fa fa-sort fs-3"></i>
                            </td>

                            <td>
                                {{ $lession->lession_name }}
                            </td>
                            @if (!isset($course))
                                <td>
                                    {{ $lession->getCourse?->course_name }}
                                </td>
                            @endif
                            @if (!isset($chapter))
                                <td>
                                    {{ $lession->getChapter?->chapter_name }}
                                </td>
                            @endif
                            <td>
                                {!! \App\Classes\Helpers\Status::active_label($lession->active) !!}
                            </td>
                            <td>
                                {{ $lession->total_duration }}
                            </td>
                            <td>
                                <ul class="action">
                                    <li class="edit">
                                        <?php
                                        $editLink = route('admin.lessions.edit', ['lession' => $lession]);
                                        if (isset($chapter) && !is_null($chapter)) {
                                            $editLink = route('admin.lessions.edit', ['lession' => $lession, 'chapter' => $chapter, 'current_tab' => 'general']);
                                        }
                                        
                                        if (isset($course) && !is_null($course)) {
                                            $editLink = route('admin.lessions.edit', ['lession' => $lession, 'chapter' => $chapter, 'course' => $course, 'current_tab' => 'general']);
                                        }
                                        
                                        ?>
                                        <a href="{{ $editLink }}"><i class="icon-pencil-alt"></i>
                                        </a>
                                    </li>
                                    <li class="delete">
                                        <a href="#" class="data-confirm" data-confirm='Are you sure? '
                                            data-method="post"
                                            data-action="{{ route('admin.lessions.delete_lession', ['lession' => $lession]) }}">
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
