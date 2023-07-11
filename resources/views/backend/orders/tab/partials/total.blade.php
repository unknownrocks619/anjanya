<div class="row d-flex justify-content-end mt-4 text-end">
    <div class="col-md-4 d-flex justify-content-between">
        <div class="row">
            <div class="col-md-12">
                Sub Total
            </div>
            <div class="col-md-12">
                Processing Fee
            </div>
            <div class="col-md-12">
                Total
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                {{ \App\Classes\Helpers\Money::AU($order->getOrderLines->sum('final_amount')) }}
            </div>
            <div class="col-md-12">
                {{ \App\Classes\Helpers\Money::AU($order->getOrderLines->sum('processing_charge')) }}
            </div>
            <div class="col-md-12">
                @php
                    $total = $order->getOrderLines->sum('final_amount') + $order->getOrderLines->sum('processing_charge');
                    echo \App\Classes\Helpers\Money::AU($total);
                @endphp
            </div>
        </div>
    </div>
</div>
