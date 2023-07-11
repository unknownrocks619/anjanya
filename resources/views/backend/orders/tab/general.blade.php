<form data-action="{{ route('admin.orders.update-order-status', ['order' => $order]) }}" class="ajax-form" method="post">
    <div class="row mb-4 d-flex justify-content-between">
        <!-- Zero Configuration  Starts-->
        <div class="col-sm-5 bg-light">
            <div class="bg-transparent">
                <div class="card-body  text-dark">
                    <div class="row g-2">
                        <div class="mb-3 col-md-12 mt-0">
                            <div class="fs-3 text-primary">
                                <span class="text-primary">{{ $order->getName() }}</span>
                                <span class="text-danger fs-5">
                                    {{ $order->email }}
                                    </small>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="mb-3 col-md-6 mt-2">
                            <h5>
                                Delivery Address
                            </h5>
                            <div class="">
                                -
                            </div>
                        </div>
                        <div class="mb-3 col-md-6 mt-2">
                            <h5>
                                Billing Address
                            </h5>
                            <div class=""> - </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 bg-light">
            <div class="bg-transparent">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 text-dark">
                            <div class="form-group">
                                <label for="">
                                    Order Status
                                </label>
                                <select name="order_status" id="order_status" class="form-control order_status_update">
                                    @if (isset(\App\Models\Order::ORDER_STATUS[$order->order_status]))
                                        <option value="{{ $order->order_status }}">
                                            {{ \App\Models\Order::ORDER_STATUS[$order->order_status] }}
                                        </option>
                                    @endif
                                    @foreach (\App\Models\Order::ADMIN_ORDER_STATUS as $key => $value)
                                        <option value="{{ $key }}"
                                            @if ($key == $order->order_status) selected @endif>{{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div
                            class="col-md-6 order_print_ready @if ($order->order_status == 'order_print_ready') d @else d-none @endif order_status_options text-dark">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Print Date</label>
                                        <input type="date" name="print_date"
                                            @if (isset($order->order_attributes[$order->order_status]) &&
                                                    isset($order->order_attributes[$order->order_status]['print_date'])) value="{{ $order->order_attributes[$order->order_status]['print_date'] }}" @endif
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Expected Date of Complete</label>
                                        <input type="date" name="exp_compelete_date"
                                            @if (isset($order->order_attributes[$order->order_status]) &&
                                                    isset($order->order_attributes[$order->order_status]['exp_compelete_date'])) value="{{ $order->order_attributes[$order->order_status]['exp_compelete_date'] }}" @endif
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-md-6 order_print_complete @if ($order->order_status == 'order_print_complete') d @else d-none @endif order_status_options text-dark">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Completed Date</label>
                                        <input type="date" name="print_completed_date"
                                            @if (isset($order->order_attributes[$order->order_status]) &&
                                                    isset($order->order_attributes[$order->order_status]['print_completed_date'])) value="{{ $order->order_attributes[$order->order_status]['print_completed_date'] }}" @endif
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-md-6 order_dispatched @if ($order->order_status == 'order_dispatched') d @else d-none @endif order_status_options text-dark">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Dispactched Date</label>
                                        <input type="date" name="dispatched_date"
                                            @if (isset($order->order_attributes[$order->order_status]) &&
                                                    isset($order->order_attributes[$order->order_status]['dispatched_date'])) value="{{ $order->order_attributes[$order->order_status]['dispatched_date'] }}" @endif
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Shipping Company</label>
                                        <input type="text" name="shipping_company_partner"
                                            @if (isset($order->order_attributes[$order->order_status]) &&
                                                    isset($order->order_attributes[$order->order_status]['shipping_company_partner'])) value="{{ $order->order_attributes[$order->order_status]['shipping_company_partner'] }}" @endif
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Tracking Code</label>
                                        <input type="text" name="tracking_code"
                                            @if (isset($order->order_attributes[$order->order_status]) &&
                                                    isset($order->order_attributes[$order->order_status]['tracking_code'])) value="{{ $order->order_attributes[$order->order_status]['tracking_code'] }}" @endif
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-dark">
                            <div class="form-group">
                                <label for="">Notes</label>
                                <textarea name="order_note" class="form-control">{{ $order->order_note }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</form>
</div>
<!-- Zero Configuration  Ends-->
</div>

<div class="row">
    <div class="col-md-12">
        @include('backend.orders.tab.partials.orderlines', ['orderLines' => $order->getOrderLines])
    </div>
    @include('backend.orders.tab.partials.total', ['order' => $order])
</div>
</form>
