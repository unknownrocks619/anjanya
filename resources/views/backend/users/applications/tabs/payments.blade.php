<div class="row">
    <div class="col-md-12">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_payment_info">Add Payment Info</button>
    </div>
</div>
<div class="row">
    <!-- Zero Configuration  Starts-->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>
                                        Membership Date
                                    </th>
                                    <th>
                                        Expire Date
                                    </th>
                                    <th>
                                        Amount
                                    </th>
                                    <th>
                                        Remarks
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($content as $payment)
                                    <tr>
                                        <td>
                                            {{ $payment->start_date }}
                                        </td>
                                        <td>
                                            {{ $payment->expire_date }}
                                        </td>
                                        <td>{{ $payment->currency }}{{ $payment->amount }}</td>
                                        <td>
                                            {{ $payment->remarks }}
                                        </td>
                                        <td>
                                            @php
                                                $carbonEndDate = \Carbon\Carbon::parse($payment->expire_date);

                                                if ($carbonEndDate->greaterThan(Carbon\Carbon::now())) {
                                                    echo "<span class='badge badge-success text-white px-3'>Active</span>";
                                                } else {
                                                    echo "<span class='badge badge-danger text-white px-3'>Exipred</span>";
                                                }
                                            @endphp
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Zero Configuration  Ends-->
</div>
<x-modal id="add_payment_info">
    @include('backend.users.applications.modals.payment', ['application' => $application, 'user' => $user]);
</x-modal>
