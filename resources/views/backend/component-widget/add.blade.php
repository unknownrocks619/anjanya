<div class="row">
    <div class="col-md-12">
        <table class="table table-hover display datatable-lister">
            <thead>
                <tr>
                    <th>
                        Component Name
                    </th>
                    <th>Position</th>
                    <th>

                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($model->getComponents as $component)
                    <tr>
                        <td>
                            {{ $component->component_name }}
                        </td>
                        <td>
                            <select
                                data-action="{{ route('admin.components.update-position', ['componentBuilder' => $component->getKey()]) }}"
                                name="position" multiple class="form-control">
                                <option value="">Select Display Position</option>
                                @foreach ($component::COMPONENTS_WIDGETS as $position_key => $positions)
                                    <option @if (is_array($component->display_location) && in_array($position_key, $component->display_location)) selected @endif
                                        value="{{ $position_key }}">
                                        {{ $positions }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <a href="#" class="btn btn-primary component-position-save">
                                Save Widget
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
