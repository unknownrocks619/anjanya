<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 text-center">
            <!-- progressbar -->
            <!-- progressbar -->
            <ul id="progressbar">
                <li class="active" id="account"><strong>Account</strong></li>
                <li id="personal" class="active"><strong>Personal</strong></li>
                <li id="payment" class="active"><strong>Family Information</strong></li>
                <li id="jap"><strong>Jap Information</strong></li>
                <li id="profile"><strong>Profile Picture</strong></li>
            </ul>
        </div>
    </div>

    <div class="row justify-content-center">
        <form action="" method="post" class="ajax-form ajax-append ajax-message ajax-response login-form">
            <div class="card border-0">
                <div class="card-body p-0">
                    <div class="row no-gutters justify-content-center">
                        <div class="col-lg-7">
                            <div class="p-5">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="total_family_member">Total Family Member(s)
                                            <span class="text-danger">
                                                 (Attending Hanuman Yagya)
                                            </span>
                                            </label>
                                            <input type="number" @if(isset(session()->get('registration_detail')['family_detail']['total_member'])) value="{{session()->get('registration_detail')['family_detail']['total_member']}}" @else value='0' @endif onchange="window.Registration.populateMemberList(this)" name="total_family_member" class="form-control" value="" id="total_family_member">
                                        </div>
                                    </div>
                                </div>

                                <div class="row member-list-field">
                                    @if(isset(session()->get('registration_detail')['family_detail']['members']))
                                        @foreach (session()->get('registration_detail')['family_detail']['members'] as $member)
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Full Name <sup class="text-danger">*</sup></label>
                                                        <input type="text" name="family_member[]" value="{{$member['name']}}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Relation <sup class="text-danger">*</sup></label>
                                                        <input type="text" name="family_relation[]" value="{{$member['relation']}}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Phone Number <sup class="text-danger">*</sup></label>
                                                        <input type="text" name="family_phone_number[]" value="{{$member['phone_number']}}" />
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-md-12 alert alert-danger">
                                        Please Note: Only Kitchen sharing family is considered single family.
                                    </div>
                                </div>
                                <div class="row no-gutters my-3">
                                    <div class="col-md-11 text-end">
                                        <button type="button" onclick="window.Registration.stepBack()" class="edu-btn  bg-info">
                                            <i class="fas fa-arrow-left"></i>
                                            Back
                                        </button>
                                        &nbsp;
                                        <button class="edu-btn" type="button" onclick="window.Registration.submitForm(this)">
                                            Next
                                            <i class="fas fa-arrow-right"></i>
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card-body -->
            </div>
        </form>
    </div>
    <!-- Row -->
</div>
<script>

    if ($('select').length) {

        $.each($('select'), function (index, element) {
            if (!$(element).hasClass('no-select-2')) {
                window.ajaxReinitalize(element);
            }
        });
    }

</script>
