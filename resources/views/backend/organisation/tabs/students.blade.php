<div class="row mt-2 d-flex justify-content-between">
    <div class="col-md-3">
        <button data-bs-toggle='modal' data-bs-target="#newStaff" class="btn btn-primary">
            Add New Staff / Student
        </button>
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-8 d-flex align-items-center">
                <input type="file" name="staff_file" class="form-control" id="staff_file" />
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-warning">Upload</button>
            </div>
        </div>
    </div>
</div>
<?php
$org->load(['getAllStaff']);
$allStudentList = $org->getAllStaff->keyBy('user_id', 'user_id')->toArray();
$userList = \App\Models\User::whereIn('id', array_keys($allStudentList))
    ->with('getCountry')
    ->get();
?>
@include('backend.users.user-list', ['users' => $userList, 'org' => $org])
<x-modal id="newStaff">
    @include('backend.organisation.modal.add-staff', ['org' => $org])
</x-modal>
