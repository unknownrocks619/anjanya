@extends('themes.admin.master')

@push('page_title')
    - All Transactions
@endpush

@section('main-content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>List of Performed Transaction</h3>
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
                            @include('backend.transactions.list-table', [
                                'transactions' => $transactions,
                            ])
                        </div>
                    </div>

                </div>
            </div>
            <!-- Zero Configuration  Ends-->
        </div>
    </div>
@endsection
