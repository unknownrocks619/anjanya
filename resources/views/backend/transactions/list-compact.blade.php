<div class="table-responsive">
    <table class="table table-bordernone">
        <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <td>
                        <div class="d-flex">
                            <div class="flex-grow-1"><a
                                    href="{{ route('admin.orders.edit', ['order' => $transaction->getOrder->getKey()]) }}">
                                    <h5>{{ $transaction->getOrder->getName() }}</h5>
                                </a>
                                <p>Total Item: {{ $transaction->getOrder->getOrderLines()->count() }}</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h5>{{ $transaction->getOrder->email }}</h5>
                                <p>
                                    Phone: {{ $transaction->getOrder->phone_number }}
                                </p>
                                </a>
                            </div>
                        </div>
                    </td>
                    <td>
                        <h5>{{ strtoupper($transaction->payment_type) }}</h5>
                        <p>Date: {{ Date('Y-m-d', strtotime($transaction->created_at)) }}</p>
                    </td>
                    {{-- <td class="text-center"> <i class="flag-icon flag-icon-gb"></i></td> --}}
                    <td>
                        <h5>{{ \App\Classes\Helpers\Money::AU($transaction->amount) }}</h5>
                        <p> Processing Charge:
                            {{ \App\Classes\Helpers\Money::AU($transaction->getOrder->getOrderLines->sum('processing_charge')) }}
                        </p>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
