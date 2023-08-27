@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp
<input type="hidden" name="_component_name" value="contact_form" class="component_field  d-none">
<input type="hidden" name="_componentID" value="{{$_loadComponentBuilder->getKey()}}" class="component_field  d-none">
<input type="hidden" name="_action" value="update" class="component_field d-none">

<div class="bg-light px-2 py-2 text-dark">
    <div class="component-container">
        <div class="row text-dark">
            <div class="col">
                <div class="form-group">
                    <label for="">Label for Full name Field</label>
                    <input type="text"onchange="contactUsPreview(this)"
                           name="full_name_label" value="{{$componentValue['full_name']}}" class="form-control component_field">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="">Label for Email Field</label>
                    <input type="text"  onchange="contactUsPreview(this)"
                           name="email_label" value="{{$componentValue['email']}}" class="form-control component_field">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="">Label for Subject Field</label>
                    <input type="text" value="{{$componentValue['subject']}}" onchange="contactUsPreview(this)"
                           name="subject_label" class="form-control component_field">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="">Label for Message box Field</label>
                    <input type="text" value="{{$componentValue['message_box']}}" onchange="contactUsPreview(this)"
                           name="message_box_label" class="form-control component_field">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="">Label for Button Field</label>
                    <input type="text" value="{{$componentValue['button']}}" onchange="contactUsPreview(this)"
                           name="button_text" class="form-control component_field">
                </div>
            </div>
        </div>
        <div class="row mt-3 bg-white">
            <div class="col-md-4 p-3">
                <div class="row text-dark">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Success Message Text</label>
                            <input value="{{$componentValue['success_message']}}" type="text"
                                   onchange="contactUsPreview(this)" name="success_message"
                                   class="form-control component_field">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Failed Message Text</label>
                            <input value="{{$componentValue['error_message']}}" type="text"
                                   onchange="contactUsPreview(this)" name="fail_message"
                                   class="form-control component_field">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 p-3 text-dark">
                <h4 class="text-center">
                    Sample Preview
                </h4>
                <div class="row text-dark d-block contact-preview-sample-area">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 my-2 alert alert-success success_message_preview">
                                {{$componentValue['success_message']}}
                            </div>
                            <div class="col-md-12 my-2 alert alert-danger fail_message_preview">
                                {{$componentValue['error_message']}}
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" placeholder="{{$componentValue['full_name']}}"
                                           class="form-control full_name_label_preview">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <input type="text" placeholder="{{$componentValue['email']}}" class="form-control email_label_preview">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <input type="text" placeholder="{{$componentValue['subject']}}" class="subject_label_preview">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <textarea placeholder="{{$componentValue['message_box']}}" class="form-control message_box_label_preview"></textarea>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-4">
                                <button type="button" class="btn btn-primary button_text_preview">{{$componentValue['button']}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function contactUsPreview (ele) {

        let _preivewElementClass = $(ele).attr('name') + '_preview';

        let _targetEle = $('.contact-preview-sample-area').find('.' + _preivewElementClass);

        if ($(_targetEle).is('div')) {
            $(_targetEle).empty().html($(ele).val());
        }

        if ($(_targetEle).is('input') || $(_targetEle).is('textarea')) {
            $(_targetEle).attr('placeholder', $(ele).val());
        }
        if ($(_targetEle).is('button')) {
            $(_targetEle).text($(ele).val());
        }
    }
</script>
