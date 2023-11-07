<?php
$userCount = \App\Models\User::countByRole();
?>
@extends('themes.admin.master')

@push('page_title')
    - Dashboard
@endpush

@section('main-content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>
                        Dashboard</h3>
                </div>
                <div class="col-6">
                    <!-- Breadcrum sample -->
                    {{-- <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a class="home-item" href="route()"><i data-feather="home"></i></a>
            </li>
          </ol> --}}
                </div>
            </div>
        </div>
    </div>

    <!-- Container-fluid starts-->
    <div class="container-fluid ecommerce-page">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card sale-chart">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <div class="sale-detail">
                                    <div class="icon"><i data-feather="shopping-bag"></i></div>
                                    <div class="sale-content">
                                        <h3>Total Applicants</h3>
                                        <p class="total_sales">
                                            {{ $total_application }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="small-chart-view sales-chart" id="sales-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card sale-chart">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <div class="sale-detail">
                                    <div class="icon"><i data-feather="dollar-sign"></i></div>
                                    <div class="sale-content">
                                        <h3>Pending Applications</h3>
                                        <p>{{ $pending_application }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="small-chart-view income-chart" id="income-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card sale-chart">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <div class="sale-detail">
                                    <div class="icon"><i data-feather="file-text"></i></div>
                                    <div class="sale-content">
                                        <h3>Total Resubmission</h3>
                                        <p>{{ $resubmission_application }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="small-chart-view order-chart" id="order-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card sale-chart">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <div class="sale-detail">
                                    <div class="icon"><i data-feather="users"></i></div>
                                    <div class="sale-content">
                                        <h3>Total Post</h3>
                                        <p>
                                            {{ $totalPost }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="small-chart-view visitor-chart" id="visitor-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card sale-chart">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <div class="sale-detail">
                                    <div class="icon"><i data-feather="users"></i></div>
                                    <div class="sale-content">
                                        <h3>Total Applicants Transaction</h3>
                                        <p>
{{--                                            {{ \App\Classes\Helpers\Money::CA($transactions->sum('amount')) }}--}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="small-chart-view visitor-chart" id="visitor-chart"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-xl-6 col-sm-6 box-col-30">
                <div class="card top-products">
                    <div class="card-header pb-0">
                        <h3>Recent Transactions</h3>
                    </div>
                    <div class="card-body">
                        @include('backend.transactions.applicants', ['transactions' => $transactions])
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-sm-5 box-col-30">
                <div class="card top-products">
                    <div class="card-header pb-0">
                        <h3>Recent Applications</h3>
                    </div>
                    <div class="card-body">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover datatable-lister " id='user-list-table'>
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Age</th>
                                            <th>Phone Number</th>
                                            <th>Gender</th>
                                            <th>Country</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($new_applications as $application)
                                            @include('backend.users.applications.applicants-list', [
                                                'application' => $application,
                                            ])
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
