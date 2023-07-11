<div class="row">
    <div class="col-md-12">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>
                        Page Name
                    </th>
                    <th>
                        Current Sidebar Setting
                    </th>
                    <th>
                        Action
                    </th>

                </tr>
            </thead>
            <tbody>
                @foreach ($configs as $config)
                    <tr>
                        <td>
                            {{ __('admin/settings/labels.' . $config->name) }}
                        </td>
                        <td>
                            @if ($config->additional_text && $config->additional_text['sidebar'])
                                {!! \App\Classes\Helpers\Status::label_text('Active', 'success') !!}
                            @else
                                {!! \App\Classes\Helpers\Status::label_text('Inactive', 'danger') !!}
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-dark data-confirm"
                                data-confirm="Change Current Setting ?" data-method="POST"
                                data-action="{{ route('admin.settings.page-setting', ['setting' => $config->getKey()]) }}">
                                Toggle Setting
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
