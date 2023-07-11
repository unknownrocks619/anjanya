<div class="row">
    <div class="col-md-12 mt-3">
        <div class="table-responsive">
            <table class="table table-hover display ">
                <thead>
                    <tr>
                        <th>
                            Log Type
                        </th>
                        <th>
                            User
                        </th>
                        <th>
                            Message
                        </th>
                        <th>
                            Date
                        </th>
                    </tr>
                </thead>
                <tbody class="log-tbody" data-action="{{ route('admin.orders.list_log', ['order' => $order]) }}">
                    @foreach ($content as $log)
                        <tr>
                            <td>
                                {{ $log->log_type }}
                            </td>
                            <td>
                                {{ $log->getAdmin->getFullName() }}
                            </td>
                            <td>
                                {!! $log->log_message !!}
                            </td>
                            <td>
                                {{ $log->created_at }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
