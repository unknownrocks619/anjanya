<div class="bg-light px-2 py-2">
    <div class="component-container">
        <div class="row text-dark">
            <div class="col">
                <div class="form-group">
                    <label for="">Label for Full name Field</label>
                    <input type="text" value="Full Name" onchange="window.componentContactPreview(this)"
                        name="full_name_label" class="form-control">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="">Label for Email Field</label>
                    <input type="text" value="Email" onchange="window.componentContactPreview(this)"
                        name="email_label" class="form-control">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="">Label for Subject Field</label>
                    <input type="text" value="Subject" onchange="window.componentContactPreview(this)"
                        name="subject_label" class="form-control">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="">Label for Message box Field</label>
                    <input type="text" value="Type Your Message" onchange="window.componentContactPreview(this)"
                        name="message_box_label" class="form-control">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="">Label for Button Field</label>
                    <input type="text" value="Submit" onchange="window.componentContactPreview(this)"
                        name="button_text" class="form-control">
                </div>
            </div>
        </div>
        <div class="row mt-3 bg-white">
            <div class="col-md-4 p-3">
                <div class="row text-dark">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Success Message Text</label>
                            <input value="Thank-You, Message Sent ." type="text"
                                onchange="window.componentContactPreview(this)" name="success_message"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Failed Message Text</label>
                            <input value="Error: Unable to Send Message." type="text"
                                onchange="window.componentContactPreview(this)" name="fail_message"
                                class="form-control">
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
                                Thank-You, Message Sent .
                            </div>
                            <div class="col-md-12 my-2 alert alert-danger fail_message_preview">
                                Error: Unable to Send Message.
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" placeholder="Full Name"
                                        class="form-control full_name_label_preview">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <input type="text" placeholder="Email" class="form-control email_label_preview">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <input type="text" placeholder="Subject" class="subject_label_preview">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <textarea placeholder="Type Your Message" class="form-control message_box_label_preview"></textarea>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-4">
                                <button type="button" class="btn btn-primary button_text_preview">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">
                Save Component
            </button>
        </div>
    </div>
</div>
