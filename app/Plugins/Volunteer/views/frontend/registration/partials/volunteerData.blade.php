@php
    $volunteerData = (new App\Plugins\Volunteer\Http\Controllers\web\WebVolunteerController())->getSession('_volunteerData') ?? [];
@endphp
<div class="container my-5 p-4">
    <form method="post" id="registration-form" class="ajax-form ajax-append ajax-message ajax-response login-form" action="{{route('frontend.volunteer.registration-store')}}">
        <input type="hidden" name="step" value="volunteerData" />
        <div class="row my-2">
            <div class="col-md-12">
                <div class='ajax-form-message-box'></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12 p-5 col-sm-12">
                <h4>
                    {{__('web/registration/events.volunteer-page')}}
                </h4>
                <div class="text-danger">
                    This opportunity requires volunteering in person.
                    <ul>
                        <li>You must be present in-person at the volunteer orientation from Monday, April 1 to Friday, April 5, 2024</li>
                        <li>You must abide by the rules and regulations of Anjaneya Youth Club</li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h5>
                            Orientation Confirmation and Agreement to Club Rules
                        </h5>
                        <div class="text-description d-flex align-items-center">
                            <input @checked($volunteerData['confirm_presence'] ?? null == 1) type="checkbox" value="1" class="me-2" name="confirm_presence" id="confirm_presence" style="width:30px; height:30px" />
                            <label for="confirm_presence" style="font-size: 16px;">
                                I confirm my presence at the orientation from <span class="fw-400">Monday, April 1</span> to <span class="fw-500">Friday, April 5, 2024</span> at Shree Ram Tarak Bhrama Peeth, Chattaradham, Barachetra, Nepal.
                            </label>
                        </div>
                        <div class="text-description d-flex align-items-center mt-3">
                            <input @checked($volunteerData['confirm_presence'] ?? null == 1)  type="checkbox" value="1" name="accept_rules_and_regulation" class="me-3" id="accept_rules_and_regulation" style="width:30px;height:30px;" />
                            <label for="accept_rules_and_regulation" style="font-size: 16px; ">
                                I agree to abide by all rules and regulations of Anjaneya Youth Club. I acknowledge that failure to comply may result in my removal as a volunteer.
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="volunteer_dates" class="fw-500 fs-4">
                                {{ __('web/registration/events.volunteer-page-title') }}
                                <sup class="text-danger">*</sup>
                                @php
                                    $totalDays = \Carbon\Carbon::createFromFormat('Y-m-d','2023-04-01');
                                @endphp
                            </label>
                        </div>
                    </div>
                    @for($i = 1; $i < date('t'); $i++)
                        <div class="col-md-4 d-flex align-items-center my-2">
                            @php
                                $data =($i>=10) ? $i : '0'.$i;
                            @endphp
                            <input @checked(in_array(\Carbon\Carbon::createFromFormat('Y-m-d','2023-04-'.$data)->format('Y-m-d'),$volunteerData['dateCheckBox'] ?? [])) id="{{ \Carbon\Carbon::createFromFormat('Y-m-d','2023-04-'.$data)->format('M d, Y') }}" type="checkbox" name="dateCheckBox[]" value="{{ \Carbon\Carbon::createFromFormat('Y-m-d','2023-04-'.$data)->format('Y-m-d') }}" class="me-2" style="width:30px; height: 30px" />
                            <label for="{{ \Carbon\Carbon::createFromFormat('Y-m-d','2023-04-'.$data)->format('M d, Y') }}">{{ \Carbon\Carbon::createFromFormat('Y-m-d','2023-04-'.$data)->format("M d, Y") }}</label>
                        </div>
                    @endfor
                </div>
            </div>
            <div class="col-md-12 text-end">
                <button type="button" onclick="window.VolunteerRegistration.stepBack({'back' : 'volunteerParticipation'})" class="edu-btn btn btn-danger me-1">
                    <i class="fas fa-arrow-left"></i>
                    {{__('web/registration/events.back')}}
                </button>
                <button type="button" onclick="window.VolunteerRegistration.submitForm(this)" class="edu-btn btn btn-primary"   style="background:#488925 !important">
                    Next
                    <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        </div>
    </form>
</div>
