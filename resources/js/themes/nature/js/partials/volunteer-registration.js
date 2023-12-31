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
        let _url = '/volunteer/registration';
        let _this = this;
        _this.#loading();

        $.ajax({
            method : "GET",
            url : _url,
            header : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success : function (response) {
                console.log('response: ', response.params);
                _this.#elm.html(response.params.view)
                _this.#loading(false);
            }
        })
    }

    /**
     * Make changes
     * to select appropirate
     * reference point
     * @param elm
     */
    referenceSource(elm) {
        let _currentValue = $(elm).val();
        $('.reference').addClass('d-none');
        $('.'+_currentValue).removeClass('d-none');
    }

    dikshyaInfo(elm) {
        let _currentValue = $(elm).val();
        $('.dikshya_type').addClass('d-none');
        $('.'+_currentValue).removeClass('d-none');

    }
    /**
     *  Check if all image has been uploaded
     */
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
        if ( _currentTotal > 12 ) {
            $(elm).val(12);
            _currentTotal = 12;
        }
        let _appendRowCount = $('div.member-list-field').children().length;
        let _langDataParam =  $('div.member-list-field').attr('data-language-key');
        _langDataParam = JSON.parse(_langDataParam);
        let _toPopulate = `<div class='row border border-1 my-1'>
            <div class="col-md-6 col-sm-12 col-lg-3">
                <div class="form-group">
                    <label>${_langDataParam.full_name}<sup class="text-danger">*</sup></label>
                    <input type="text" name="family_member[]" value="" class="form-control">
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-lg-3">
                <div class="form-group">
                    <label>${_langDataParam.relation}<sup class="text-danger">*</sup></label>
                    <input type="text" name="family_relation[]" value="" class="form-control">
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-lg-3">
                <div class="form-group">
                    <label>${_langDataParam.gender}<sup class="text-danger">*</sup></label>
                    <input type="text" name="family_gender[]" value="" class="form-control">
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-lg-3">
                <div class="form-group">
                    <label>${_langDataParam.phone_number}<sup class="text-danger">*</sup></label>
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
        this.#loading();
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
                _this.#loading(false)

            }).catch(error => {
            $(".error-reporting_"+params.profileID)
                .html('Oops ! Something went wrong, Please try again.')
                .removeClass('d-none');
            _this.#loading(false)

        })

    }

    complete() {
        axios.post('/volunteer/registration/'+this.#eventID,{});
    }

    stepBack() {
        this.#loading();
        let _url = '/volunteer/stepback';
        let _this = this;
        axios.post(_url,{}).then(function(response){
            _this.#elm.html(response.data.params.view);
            _this.#loading(false);
        }).catch(error => {
            console.log('Error: Unable to go back.');
            _this.#loading(false);
        })
    }


    alertComplete(elm) {
        let _this = this;
        let _languageFile = $(elm).attr('data-language-file');
        _languageFile = JSON.parse(_languageFile);

        window.Swal.fire({
            title: _languageFile.dialogue_box_title,
            text: _languageFile.dialogue_box_description,
            showConfirmButton: true,
            confirmButtonText: _languageFile.dialouge_box_approve_label,
            showCloseButton: true,
            showCancelButton: true,
            cancelButtonText : _languageFile.dialouge_box_cancel_label
        }).then((action) => {
            if (action.isConfirmed === true) {
                // perform ajax query.
                _this.submitForm(elm);
            }
        })
    }

    #loading(_isLoading=true) {

        if ( _isLoading === true) {
            this.#elm.closest('.main-wrapper').find('.loading').height(this.#elm.height()).removeClass('d-none')
        } else {
            this.#elm.closest('.main-wrapper').find('.loading').addClass('d-none');
        }
    }

    submitForm(elm) {
        this.#loading();
        let _formData = this.#elm.find('form')[0];
        let _url = '/volunteer/volunteer-registration';
        let _this = this;

        axios.post(_url,_formData).then(function(response){
            _this.#elm.html(response.data.params.view)
            let  _eventRegistrationWrapperElm = document.getElementById('volunteer-registration-wrapper-elm');
            _eventRegistrationWrapperElm.scrollTop = 0;
            _this.#loading(false);

        }).catch(error => {

            if (error.response.status == 422) {
                window.handle422Case(error.response);
            }

            if (error.response.status == 500 ) {
                window.handleBadResponse(error.response);
            }

            _this.#loading(false);

        })
    }

    insertHTML(params) {
        this.#elm.html(params.view)
        let  _eventRegistrationWrapperElm = document.getElementById('event-registration-wrapper-elm');
        _eventRegistrationWrapperElm.scrollTop = 0;
        this.#loading(false);
    }

    #postRequest(url, params) {
        return axios.post(url,params);
    }
    #getRequest(url,params={}) {
        return axios.get(url,params);
    }
}

if ($('#volunteer-registration-wrapper-elm').length) {
    window.Registration = new Registration($('#volunteer-registration-wrapper-elm'));
}
