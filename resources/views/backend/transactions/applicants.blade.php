<div class="table-responsive">
    <table class="table table-bordernone">
        <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <td>
                        <div class="d-flex">
                            <div class="flex-grow-1"><a href="">
                                    <h5>{{ $transaction->user->getFullName() }}</h5>
                                </a>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h5>{{ $transaction->user->email }}</h5>
                                <p>
                                    Phone: {{ $transaction->user->phone_number }}
                                </p>
                                </a>
                            </div>
                        </div>
                    </td>
                    <td>
                        <h5>{{ strtoupper($transaction->payment_type) }}</h5>
                        <p>Date: {{ $transaction->start_date }}</p>
                    </td>
                    <td class="text-center">
                        <img src="https://flagcdn.com/16x12/{{ strtolower($transaction->user->getCountry->code) }}.png"
                            srcset="https://flagcdn.com/32x24/{{ strtolower($transaction->user->getCountry->code) }}.png 2x,
                                https://flagcdn.com/48x36/{{ strtolower($transaction->user->getCountry->code) }}.png 3x"
                            width="16" height="12" alt="{{ $transaction->user->getCountry->name }}" />
                    </td>
                    <td>
                        <h5>{{ \App\Classes\Helpers\Money::CA($transaction->amount, $transaction->currency) }}</h5>
                        <p> Processing Charge:
                            {{ \App\Classes\Helpers\Money::CA(0.0, $transaction->currency) }}
                        </p>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
