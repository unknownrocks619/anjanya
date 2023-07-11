<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table data-action="{{ route('admin.sort.re-order-column', ['model_name' => 'Category']) }}"
                class="table
                table-hover display datatable-lister-sortable" id='user-lession-table'>
                <thead>
                    <tr>
                        <th></th>
                        <th>Category Name</th>
                        <th>Category Type</th>
                        <th>Category Status</th>
                        <th>Total Item</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr data-sort-id="{{ $category->getKey() }}">
                            <td class="text-center sortable-handle">
                                <i class="fa fa-sort fs-3"></i>
                            </td>
                            <td>
                                {{ $category->category_name }}
                            </td>
                            <td>
                                {{ \App\Models\Category::CATEGORY_TYPES[$category->category_type] }}
                            </td>
                            <td>
                                {!! \App\Classes\Helpers\Status::active_label($category->active) !!}
                            </td>
                            <td>
                                0
                            </td>
                            <td>
                                <ul class="action">
                                    <li class="edit">
                                        <?php
                                        $editLink = route('admin.categories.edit', ['category' => $category]);
                                        ?>
                                        <a href="{{ $editLink }}"><i class="icon-pencil-alt"></i>
                                        </a>
                                    </li>
                                    <li class="delete">
                                        <a href="#" class="data-confirm" data-confirm='Are you sure? '
                                            data-method="post"
                                            data-action="{{ route('admin.categories.delete', ['category' => $category]) }}">
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
