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
    </div>
@endsection
