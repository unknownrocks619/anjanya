<div class="table-responsive">
    <table class="table table-hover display datatable-lister" id='user-list-table'>
        <thead>
            <tr>
                <th>
                    S.No
                </th>
                <th>
                    Project Name
                </th>
                <th>
                    Product Name
                </th>
                <th>
                    Quantity
                </th>
                <th>
                    Unit Amount
                </th>
                <th>
                    Donation
                </th>
                <th>
                    Tip
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orderLines as $orderline)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        {{ $orderline->getProject->title }}
                    </td>
                    <td>
                        {{ $orderline->getProduct->product_name }}
                    </td>
                    <td>
                        {{ $orderline->quantity }}
                    </td>
                    <td>
                        {{ \App\Classes\Helpers\Money::AU($orderline->item_price) }}
                    </td>
                    <td>
                        {{ \App\Classes\Helpers\Money::AU($orderline->donation_amount) }}
                    </td>
                    <td>
                        {{ \App\Classes\Helpers\Money::AU($orderline->tip_amount) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
