<table class="table table-hover display datatable-lister" id='user-list-table'>
    <thead>
        <tr>
            <th>Product Type</th>
            <th>Source</th>
            <th>Amount</th>
            <th>Donation</th>
            <th>Tip</th>
            <th>
                Processing Fees
            </th>
            <td>

            </td>
        </tr>
    </thead>
    <tbody>
        @foreach ($transactions as $transaction)
            <tr>
                <td>
                    {{ 'E Product' }}
                </td>
                <td>
                    {{ $transaction->payment_type }}
                </td>
                <td>

                    {{ \App\Classes\Helpers\Money::AU($transaction->getOrder->total_amount) }}
                </td>

                <td>
                    {{ \App\Classes\Helpers\Money::AU($transaction->getOrder->getOrderLines->sum('donation_amount')) }}
                </td>
                <td>
                    {{ \App\Classes\Helpers\Money::AU($transaction->getOrder->getOrderLines->sum('tip_amount')) }}
                </td>
                <td>
                    {{ \App\Classes\Helpers\Money::AU($transaction->getOrder->getOrderLines->sum('processing_charge')) }}
                </td>
                <td>
                    View Order Detail
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
