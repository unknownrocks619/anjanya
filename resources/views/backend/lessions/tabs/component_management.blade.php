<div class="row">
    <div class="col-md-12">
        <table class="table table-hover display datatable-lister">
            <thead>
                <tr>
                    <th></th>
                    <th>
                        Component Name
                    </th>
                    <th>Position</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lession->getComponents as $component)
                    <tr>
                        <td class="text-center">
                            <i class="fa fa-sort fs-3"></i>
                        </td>
                        <td>
                            {{ __('components.' . $component->component_type) }}
                        </td>
                        <td>
                            <select
                                data-action="{{ route('admin.components.update-position', ['componentBuilder' => $component->getKey()]) }}"
                                name="position" id="form-control" class="form-control component-position">
                                <option value="">Select Display Position</option>
                                @foreach ($component::COMPONENT_POSITIONS as $position_key => $positions)
                                    <option @if ($component->display_location == $position_key) selected @endif
                                        value="{{ $position_key }}">
                                        {{ $positions }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
