<div class="stats">
    <div class="stat-box">
        <div class="img">
            <img src=" {{ $user->role == 'teacher' ? asset('lms/assets/images/t-account.svg') : asset('lms/assets/images/s-account.svg') }}"
                alt="">
        </div>
        <div class="name">{{ __('web/profile.' . $user->role) }}</div>
    </div>
    @if ($user->role == 'teacher')
        <?php
        $teacherOrganisation = $user->getOrganisation;
        $totalStudent = [];
        if ($teacherOrganisation) {
            $totalStudent = array_keys(
                \App\Models\OrganisationStudent::where('org_id', $teacherOrganisation->org_id)
                    ->where('id', '!=', $teacherOrganisation->getKey())
                    ->get()
                    ->groupBy('user_id')
                    ->toArray(),
            );
        }
        
        ?>
        <div class="stat-box">
            <div class="img"><img src="{{ asset('lms/assets/images/active.svg') }}" alt=""></div>
            <div class="count">{{ count($totalStudent) }}</div>
            <div class="name">Students</div>
        </div>
        <div class="stat-box add-box">
            <div class="img c-p" data-bs-toggle="modal" data-bs-target="#inviteShare">
                <img src="{{ asset('lms/assets/images/plus.svg') }}" alt="">
            </div>
            <div class="name">
                Add Student(s)
            </div>
        </div>
        @include('frontend.profile.modals.invite-share')
    @endif
</div>
