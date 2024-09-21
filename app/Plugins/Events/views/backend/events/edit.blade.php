@extends('themes.admin.master')

@push('page_title')
    - {{ $event->event_title }}
@endpush

@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card action-bar align-content-end mt-3 rounded-3" style="background: #e0e0e0">
                <div class="card-body py-0 ps-2">
                    <a href="{{ route('admin.events.list') }}" class="btn btn-danger">
                        <i class="fa fa-arrow-left"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <x-cardTabContent :transparent='true' :event="$event" :base="$base" :active_tab="$current_tab"
                    :tabs="$tabs"></x-cardTabContent>
            </div>
            <!-- Zero Configuration  Ends-->
        </div>
    </div>
@endsection
@push('custom_script')
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.2/css/dataTables.dataTables.min.css">
    <script src="//cdn.datatables.net/2.1.2/js/dataTables.min.js"></script>
@endpush
