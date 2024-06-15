<div class="row">
    <div class="col-md-12 text-end">
        <button class="btn btn-primary" data-bs-toggle='modal' data-bs-target='#newMember'><i class="fas fa-plus"></i> Add New Member</button>
    </div>
</div>
<div class="row mt-4">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover w-100">
                <thead>
                    <tr>
                        <th>Member Name</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($content as $member)
                        @include("TeamBuilder::backend.members.partials.member",['member' => $member])
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<x-modal id="newMember">
    @include('TeamBuilder::backend.members.partials.new-member',['team' => $team])
</x-modal>