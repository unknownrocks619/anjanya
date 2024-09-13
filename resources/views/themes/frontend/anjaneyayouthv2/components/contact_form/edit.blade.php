@php
    /** @var App\Models\ComponentBuilder $_loadComponentBuilder */
    $componentValue = $_loadComponentBuilder->values;
@endphp

<input type="hidden" name="_component_name" value="contact_form" class="component_field  d-none">
<input type="hidden" name="_action" value="store" class="component_field d-none">
<input type="hidden" name="_componentID" value="{{ $_loadComponentBuilder->getKey() }}" class="component_field d-none">

<div class="bg-light px-2 py-2 text-dark">
    <div class="component-container">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="heading">Heading</label>
                    <input type="text" name="heading" value="{{ $componentValue['heading'] ?? 'Contact Us' }}"
                        id="heading" class="form-control component_field" />
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="heading">Description</label>
                    <textarea name="description" class="tiny-mce form-control component_field">{!! $componentValue['description'] ?? '' !!}</textarea>
                </div>
            </div>
        </div>

        <div class="row text-dark">
            <div class="col-12">
                <div class="form-group">
                    <label for="">Label for Full name Field</label>
                    <input type="text" name="full_name_label" value="{{ $componentValue['full_name'] }}"
                        class="form-control component_field">
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="">Label for Email Field</label>
                    <input type="text" name="email_label" value="{{ $componentValue['email'] }}"
                        class="form-control component_field">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="">Label for Subject Field</label>
                    <input type="text" value="{{ $componentValue['subject'] }}" name="subject_label"
                        class="form-control component_field">
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="">Label for Message box Field</label>
                    <input type="text" value="{{ $componentValue['message_box'] }}" name="message_box_label"
                        class="form-control component_field">
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="">Label for Button Field</label>
                    <input type="text" value="{{ $componentValue['button'] }}" name="button_text"
                        class="form-control component_field">
                </div>
            </div>
        </div>
        <div class="row mt-3 bg-white">
            <div class="col-md-12 p-3">
                <div class="row text-dark">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Success Message Text</label>
                            <input value="{{ $componentValue['success_message'] }}" type="text"
                                name="success_message" class="form-control component_field">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Failed Message Text</label>
                            <input value="{{ $componentValue['error_message'] }}" type="text" name="fail_message"
                                class="form-control component_field">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    $(() => {
        window.setupTinyMce();
    })
</script>
