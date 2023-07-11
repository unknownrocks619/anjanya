<div class="row">
    <form action="{{ route('admin.settings.page-setting') }}" method="post" class="ajax-form">
        <input type="hidden" name="type" value="widgets" />
        <input type="hidden" name="setting_id" value="{{ $about_page->getKey() }}" />
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>
                            Widget Name
                        </th>
                        <th>
                            Current Status
                        </th>
                        <th>
                            Position
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (\App\Models\ComponentBuilder::COMPONENTS_WIDGETS as $position_key => $positions)
                        <tr>
                            <td>
                                {{ $positions }}
                                <input type="hidden" name="name[]" value="{{ $position_key }}">
                            </td>
                            <td>
                                @if (in_array($position_key, $about_page->additional_text['blocks']))
                                    {!! \App\Classes\Helpers\Status::label_text('Active', 'success') !!}
                                @else
                                    {!! \App\Classes\Helpers\Status::label_text('Inactive', 'danger') !!}
                                @endif
                            </td>
                            <td>
                                <select name="position[]" class="form-control no-select-2">
                                    @for ($i = 0; $i < count(\App\Models\ComponentBuilder::COMPONENTS_WIDGETS); $i++)
                                        <option value="{{ $i }}"
                                            @if (
                                                $about_page->additional_text['blocks'] &&
                                                    isset($about_page->additional_text['blocks'][$i]) &&
                                                    $about_page->additional_text['blocks'][$i] == $position_key) selected @endif>{{ $i + 1 }}
                                        </option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <select name="status[]" class="form-control no-select-2">
                                    <option value="1" @if (in_array($position_key, $about_page->additional_text['blocks'])) selected @endif>
                                        Enable
                                    </option>
                                    <option value="0" @if (!in_array($position_key, $about_page->additional_text['blocks'])) selected @endif>
                                        Disable
                                    </option>
                                </select>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-12 text-end">
            <button type="submit" class="btn btn-primary">
                Save About Page Widget
            </button>
        </div>
    </form>
</div>
