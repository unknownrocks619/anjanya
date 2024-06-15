@extends('themes.admin.master')
@push('page_title')- Team Members @endpush

@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card action-bar align-content-end mt-3 rounded-3" style="background: #e0e0e0">
                <div class="card-body py-0 ps-2">
                    <a href="" data-bs-target='#newMember' data-bs-toggle='modal' class="btn btn-danger">
                        <i class="fa fa-plus"></i>
                        New Team Member
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card rounded-3">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover display datatable-lister" id='user-list-table'>
                                <thead>
                                <tr>
                                    <th>Member Name</th>
                                    <th>Team Group</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($members as $member)
                                        @include('TeamBuilder::backend.members.partials.member',['member' => $member,'group' => true])
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

    <x-modal id="newMember">
        @include('TeamBuilder::backend.members.partials.new-member')
    </x-modal>
@endsection
