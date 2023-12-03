import axios from "axios";
import Swal from 'sweetalert2';
window.Swal = Swal;
export default class  Registration  {

    #eventID;
    #elm;
    constructor(elm) {
        this.#elm = elm;
        this.#eventID = this.#elm.attr('data-event-id');
        this.defaultLoad();
    }

    defaultLoad() {
        let _url = '/event/'+ this.#elm.attr('data-event-slug')+'/'+'registration';
        let _this = this;
       $.ajax({
           method : "GET",
           url : _url,
           success : function (response) {
               _this.#elm.html(response.params.view)
           }
       })
    }

    checkProfilePictures() {
        let _enable = true;
        // check if button should be enabled.
        $.each ($('input.profile_picture'),function (index, profileElement){
            console.log('attr value: ' , $(profileElement).val())
            if ( ! $(profileElement).val() ) {
                _enable = false;
            }
        });

        if ( _enable === true) {
            $('button.registration-progress-button').removeAttr('disabled')
                .attr('onclick','window.Registration.alertComplete(this)')
                .removeClass('btn-secondary');
        } else {
            $('button.registration-progress-button').attr('disabled','disabled')
                .removeAttr('onclick')
                .addClass('btn-secondary');
        }
    }
    populateMemberList(elm) {
        let _currentTotal = $(elm).val();
        let _appendRowCount = $('div.member-list-field').children().length;

        let _toPopulate = `<div class='row'>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Full name<sup class="text-danger">*</sup></label>
                    <input type="text" name="family_member[]" value="" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Relation<sup class="text-danger">*</sup></label>
                    <input type="text" name="family_relation[]" value="" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Phone number<sup class="text-danger">*</sup></label>
                    <input type="text" name="family_phone_number[]" value="" class="form-control">
                </div>
            </div>
        </div>`

        let _appendHTML = '';
        if ( ! _appendRowCount ) {
            for(let i=1; i <= _currentTotal ; i++) {
                _appendHTML += _toPopulate;
            }
            $('div.member-list-field').html(_appendHTML);

        } else if (_appendRowCount > _currentTotal ) {
            $('div.member-list-field').children().slice(_currentTotal).remove();
        } else {

            for (let i = 1; i <= (_currentTotal - _appendRowCount); i++) {
                _appendHTML += _toPopulate;
            }

            $('div.member-list-field').append(_appendHTML);

        }

    }

    changeProfile(elm ,params={}) {
        let _this = this;
        $('.error-reporting').addClass('d-none').empty();
        console.log('params: ', params);
        const fileInput = elm;
        const file = fileInput.files[0];

        if ( ! file ) {
            $(".error-reporting_"+params.profileID)
                .html('Unable to upload your picture. Please check your file permission and file type.')
                .removeClass('d-none');
            return ;
        }
        const formData = new FormData();
        formData.append('image', file);
        let _enable = true;

        axios.post('/event/registration/upload-photo/'+this.#eventID,formData)
            .then(function(response) {
                let _response = response.data.params;
                $('img.display_profile_picture_'+params.profileID).attr('src',_response.image);
                $('#profile_picture_'+params.profileID).attr('value',_response.image);

                _this.checkProfilePictures();

            }).catch(error => {
            $(".error-reporting_"+params.profileID)
                .html('Oops ! Something went wrong, Please try again.')
                .removeClass('d-none');
        })

    }

    complete() {
        axios.post('/event/registration/'+this.#eventID,{});
    }

    stepBack() {
        let _url = '/event/stepback/'+this.#eventID;
        let _this = this;
        axios.post(_url,{}).then(function(response){
            _this.#elm.html(response.data.params.view)
        }).catch(error => {
            console.log('Error: Unable to go back.');
        })
    }

    alertComplete(elm) {
        let _this = this;
        window.Swal.fire({
            title: 'Submit Your Information',
            text: "Please Make sure all your information are correct before submitting your form.",
            showConfirmButton: true,
            confirmButtonText: "Submit My Application",
            showCloseButton: true,
            showCancelButton: true,
            cancelButtonText : 'Re-confirm'
        }).then((action) => {
            if (action.isConfirmed === true) {
                // perform ajax query.
                _this.submitForm(elm);
            }
        })
    }
    submitForm(elm) {
        let _formData = this.#elm.find('form')[0];
        let _url = '/event/registration/'+this.#eventID;
        let _this = this;

        axios.post(_url,_formData).then(function(response){
            _this.#elm.html(response.data.params.view)
        }).catch(error => {

            if (error.response.status == 422) {
                window.handle422Case(error.response);
            }

            if (error.response.status == 500 ) {
                window.handleBadResponse(error.response);
            }

            console.log ('Error: ',error.response.status);
        })
    }

    #postRequest(url, params) {
        return axios.post(url,params);
    }
    #getRequest(url,params={}) {
        return axios.get(url,params);
    }
}

if ($('#event-registration-wrapper-elm').length) {
    window.Registration = new Registration($('#event-registration-wrapper-elm'));
}
