
@php
    $hanumandYagyaInfo = (new App\Plugins\Volunteer\Http\Controllers\web\WebVolunteerController())->getSession('_volunteerParticipation') ?? [];
@endphp
<div class="container-fluid my-3 p-4">
    <form method="post" id="registration-form" class="ajax-form ajax-append ajax-message ajax-response login-form" action="{{route('frontend.volunteer.registration-store')}}">
        <input type="hidden" name="step" value="volunteerParticipation" />
        <div class="row my-3">
            <div class="col-md-12">
                <h3 class="mb-30"><span class="text-danger">Volunteer </span> {{__('web/registration/events.registration')}} - Volunteer History</h3>

            </div>
        </div>
    <div class="row">
            <div class="col-md-6">
                <label for="jaap_anushthan"  class="mb-4">
                    Are you in Hanuman Mantra Jaap Anusthan?
                </label>
                <select name="jaap_anushthan" id="jaap_anushthan" class="form-control mt-1">
                    <option value="no" @if($hanumandYagyaInfo['jaap_anushthan'] ?? null == 'no') selected @endif>No</option>
                    <option value="yes" @if($hanumandYagyaInfo['jaap_anushthan'] ?? null == 'yes') selected @endif>Yes</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="previous_volunteer">
                    Have you volunteered with Himalayan Siddha Mahayog/Anjaneya Youth Club before?
                </label>
                <select name="previous_volunteer" id="previous_volunteer" class="form-control">
                    <option value="no" @if($hanumandYagyaInfo['previous_volunteer'] ?? null == 'no') selected @endif>No</option>
                    <option value="yes"  @if($hanumandYagyaInfo['previous_volunteer'] ?? null == 'yes') selected @endif>Yes</option>
                </select>
            </div>
        </div>
        <div class="row mt-3 my-3">
            <div class="col-md-12 text-end">
                <button type="button" onclick="window.VolunteerRegistration.stepBack({'back' : 'personal'})" class="btn edu-btn btn-danger me-1">
                    <i class="fas fa-arrow-left"></i>
                    {{__('web/registration/events.back')}}
                </button>
                <button type="submit" onclick="window.VolunteerRegistration.submitForm(this)" class="btn edu-btn btn-primary"  style="background:#488925 !important">Next
                    <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        </div>
    </form>
</div>
