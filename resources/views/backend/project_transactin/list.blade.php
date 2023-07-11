<table class="table table-hover display datatable-lister" id='user-list-table'>
    <thead>
        <tr>
            <th>Project</th>
            <th>Organisation</th>
            <th>Amount</th>
            <th>Source</th>
            <th>Transaction Detail</th>
            <th>Remarks</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transactions as $transaction)
            <tr>
                <td>
                    {{ $transaction->getProject->title }}
                </td>
                <td>
                    {{ $transaction->getOrganisation->organisation_name }}
                </td>
                <td>
                    {{ \App\Classes\Helpers\Money::AU($transaction->transaction_amount) }}
                </td>
                <td>
                    {{ strtoupper($transaction->source) }}
                </td>
                <td>
                    @if ($transaction->source_detail)
                    @else
                        <span class="badge badge-warning px-2">Not Available</span>
                    @endif
                </td>
                <td>
                    @if ($transaction->source == 'wp_import')
                        'Payment succeeded'
                    @else
                    @endif
                </td>
                <td>
                    {{ $transaction->created_at }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
