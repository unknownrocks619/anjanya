@extends('themes.admin.master')

@push('page_title')
    - All Orders
@endpush

@section('main-content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Purchase Order</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover display datatable-lister" id='user-list-table'>
                                <thead>
                                    <tr>
                                        <th>Order Number</th>
                                        <th>Customer Name</th>
                                        <th>Total Amount</th>
                                        <th>Order Status</th>
                                        <th>Total Item</th>
                                        <td>

                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>
                                                #PO-{{ $order->getKey() }}
                                            </td>
                                            <td>
                                                {{ $order->getName() }}
                                            </td>
                                            <td>
                                                {{ \App\Classes\Helpers\Money::AU($order->total_amount) }}
                                            </td>
                                            <td>
                                                {{ $order::ORDER_STATUS[$order->order_status] }}
                                            </td>
                                            <td>
                                                {{ $order->getOrderLines->count() }}
                                            </td>
                                            <td>
                                                <a
                                                    href="{{ route('admin.orders.edit', ['order' => $order, 'current_tab' => 'general']) }}">View
                                                    Order Detail</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Zero Configuration  Ends-->
        </div>
    </div>
@endsection
