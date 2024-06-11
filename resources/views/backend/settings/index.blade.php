@extends('themes.admin.master')

@push('page_title')
    - Product List
@endpush

@section('main-content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>web Settings</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-4">
                <form action="{{ route('admin.settings.basic-settings') }}" class="ajax-form ajax-append" method="post">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h3 class='text-white'>Basic Configuration</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="site_name">Site name</label>
                                        <input type="text"
                                            value="{{ \App\Classes\Helpers\SystemSetting::basic_configuration('site_name') }}"
                                            name="site_name" id="site_name" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="tagline">
                                            Tagline
                                        </label>
                                        <input type="text"
                                            value="{{ \App\Classes\Helpers\SystemSetting::basic_configuration('tagline') }}"
                                            name="tagline" id="tagline" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="host">Web Address</label>
                                        <input type="text"
                                            value="{{ \App\Classes\Helpers\SystemSetting::basic_configuration('host') }}"
                                            name="host" id="host" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="official_email">Official Contact Email</label>
                                        <input type="text" name="email_official"
                                            value="{{ \App\Classes\Helpers\SystemSetting::basic_configuration('email_official') }}"
                                            id="email_official" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="facebook">Facebook</label>
                                        <input type="text"
                                            value="{{ \App\Classes\Helpers\SystemSetting::social_media('social_facebook') }}"
                                            name="social_facebook" id="social_facebook" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="instagram">Instagram</label>
                                        <input type="text"
                                            value="{{ \App\Classes\Helpers\SystemSetting::social_media('social_instagram') }}"
                                            name="social_instagram" id="instagram" class="form-control" />
                                    </div>
                                </div>
                            </div>

                            @if (!\App\Classes\Helpers\SystemSetting::basic_configuration('intro_description'))
                                <div class="col-md-12 my-2">
                                    <div class="alert alert-danger">
                                        Some of the configuration seems to be missing ! Please Reset Configuration File.
                                    </div>
                                    <button class="btn btn-info data-confirm" data-confirm="Are you sure ?"
                                        data-method="post" data-action="{{ route('admin.settings.list') }}">Reset
                                        Configuration</button>
                                </div>
                            @else
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="intro_description">Intro Text</label>
                                            <textarea name="intro_description" class="form-control">{{ \App\Classes\Helpers\SystemSetting::basic_configuration('intro_description') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="short_description">Short Description</label>
                                            <textarea name="short_description" class="form-control">{{ \App\Classes\Helpers\SystemSetting::basic_configuration('short_description') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="full_description">Full Description</label>
                                            <textarea name="full_description" id="full_description" class="tiny-mce form-control">{{ \App\Classes\Helpers\SystemSetting::basic_configuration('full_description') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                Save Configuration
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Zero Configuration  Ends-->
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">
                            Logo & Media
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="logo">Company Logo</label>
                                    <form method="post" action="{{ route('admin.settings.logo-settings') }}"
                                        data-max-file='6'>
                                        <div class="dropzone dropzone-info dz-area" id="fileTypeValidation">
                                            <div class="dz-message needsclick"><i class="icon-cloud-up"></i>
                                                <h4>Drop files here or click to upload.</h4><span class="note needsclick">
                                                    Upload Company Logo :)
                                                </span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @if (\App\Classes\Helpers\SystemSetting::logo())
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <img src="{{ \App\Classes\Helpers\SystemSetting::logo() }}" class="img-fluid w-50" />
                                </div>
                                <div class="col-md-6 d-flex">
                                    <h5>
                                        Current Logo
                                    </h5>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <form action="{{ route('admin.settings.basic-contact-settings') }}" class='ajax-form ajax-append'
                    method="post">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4>
                                Company Address
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row bg-light py-2">
                                <div class="col-md-12">
                                    <h4 class='text-info'>
                                        Primary Address / Contact Info
                                    </h4>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="text-dark" for="primary_country">Full Address</label>
                                                <textarea name="primary_address" class="form-control">{{ \App\Classes\Helpers\SystemSetting::primary_contact_info('primary_address') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-dark" for="primary_contact_person">Contact
                                                    Person</label>
                                                <input type="text"
                                                    value="{{ \App\Classes\Helpers\SystemSetting::primary_contact_info('primary_contact_person') }}"
                                                    name="primary_contact_person" id="primary_contact_person"
                                                    class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="text-dark" for="primary_contact_number">Contact
                                                    Number</label>
                                                <input type="text"
                                                    value="{{ \App\Classes\Helpers\SystemSetting::primary_contact_info('primary_contact_number') }}"
                                                    name="primary_contact_number" id="primary_contact_number"
                                                    class="form-control" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="text-dark" for="primary_email_address">Primary Email
                                                    Address</label>
                                                <input type="text"
                                                    value="{{ \App\Classes\Helpers\SystemSetting::primary_contact_info('primary_email_address') }}"
                                                    name="primary_email_address" id="primary_email_address"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="text-dark" for="primary_contact_map">Iframe Map</label>
                                                <textarea name="primary_contact_map" id="primary_contact_map" class="form-control">{{ \App\Classes\Helpers\SystemSetting::primary_contact_info('primary_contact_map') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                Save Contact Info
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('admin.settings.registration-welcome-email') }}" class="ajax-form"
                    method="post">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="text-white">Welcome Email Text</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="welcome_text_subject">
                                            Subject
                                        </label>
                                        <input type="text" name="welcome_email_subject" id="welcome_text_subject"
                                            value="{{ \App\Classes\Helpers\SystemSetting::welcomeEmailSubject('value') }}"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea name="welcome_email_text" class="tiny-mce form-control" id="welcome_email_block">{{ \App\Classes\Helpers\SystemSetting::welcomeEmail('value') }}</textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                Save Email Settings
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-6">
                <form action="{{ route('admin.settings.membership-registration-email') }}" class="ajax-form"
                    method="post">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="text-white">User Membership Registration Text</h4>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="user_membership_registration_subject">
                                            Subject
                                        </label>
                                        <input type="text" name="user_membership_registration_subject"
                                            id="user_membership_registration_subject"
                                            value="{{ \App\Classes\Helpers\SystemSetting::member_registration_email_subject('value') }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea name="user_membership_registration_text" id="membership_registration" class="tiny-mce form-control">{{ \App\Classes\Helpers\SystemSetting::member_registration_email('value') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save Email Tempalte</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('admin.settings.membership-approved-registration-email') }}" class="ajax-form"
                    method="post">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="text-white">
                                User Membership Approved Text
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="user_membership_approved_subject">
                                            Subject
                                        </label>
                                        <input type="text" name="user_membership_approved_subject"
                                            id="user_membership_approved_subject"
                                            value="{{ \App\Classes\Helpers\SystemSetting::member_registration_approved_email_subject('value') }}"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea name="user_membership_approved_text" id="member_approved_text" class="tiny-mce form-control">{{ \App\Classes\Helpers\SystemSetting::member_registration_approved_email('value') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                Save Email Settings
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <form action="{{ route('admin.settings.membership-rejected-registration-email') }}" class="ajax-form"
                    method="post">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="text-white">
                                User Membership Rejected Text
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="form-group">
                                        <label for="user_membership_rejected_subject">
                                            Subject
                                        </label>
                                        <input type="text" name="user_membership_rejected_subject"
                                            id="user_membership_rejected_subject"
                                            value="{{ \App\Classes\Helpers\SystemSetting::member_registration_rejected_subject('value') }}"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea name="user_membership_rejected_text" id="membership_rejected_text" class="tiny-mce form-control">{{ \App\Classes\Helpers\SystemSetting::member_registration_rejected_email('value') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                Save Email Setting
                            </button>
                        </div>
                </form>
            </div>
        </div>

        <div class="row">
            @if (!\App\Classes\Helpers\SystemSetting::basic_configuration('intro_description'))
                <div class="col-md-12 my-2">
                    <div class="alert alert-danger">
                        Some of the configuration seems to be missing ! Please Reset Configuration File.
                    </div>
                    <button class="btn btn-info data-confirm" data-confirm="Are you sure ?" data-method="post"
                        data-action="{{ route('admin.settings.list') }}">Reset Configuration</button>
                </div>
            @else
                <div class="col-md-6">
                    <form action="{{ route('admin.settings.membership-approved-registration-email') }}" class="ajax-form"
                        method="post">
                        <div class="card">
                            <div class="card-header bg-primary">
                                <h4 class="text-white">
                                    Site Intro Text
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="intro_description">Intro Text</label>
                                            <textarea name="intro_description" class="form-control">{{ \App\Classes\Helpers\SystemSetting::basic_configuration('intro_description') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="short_description">Short Description</label>
                                            <textarea name="short_description" class="form-control">{{ \App\Classes\Helpers\SystemSetting::basic_configuration('short_text') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="intro_text">Full Description</label>
                                            <div class="editor-js-wrapper">
                                                <div class="editor-js" id="taskEditor">{!! \App\Classes\Helpers\SystemSetting::member_registration_approved_email('value') !!}</div>
                                                <input type="hidden" value="{{ \App\Classes\Helpers\SystemSetting::member_registration_approved_email('value') }}" name="intro_text" class="editor-js-input hidden">
                                            </div>
                                            {{-- <textarea name="intro_text" id="intro_text" class="tiny-mce form-control">{{ \App\Classes\Helpers\SystemSetting::member_registration_approved_email('value') }}</textarea> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    Save Description
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>
    </div>
@endsection
