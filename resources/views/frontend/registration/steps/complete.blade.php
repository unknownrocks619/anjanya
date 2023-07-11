<div class="right-side w-100" style="min-height: 100%">
    <div class="main active">
        <div class="row">
            <div class="col-md-12 alert alert-success">
                <h2>
                    Your Application has been submitted.
                </h2>
                <p>
                    We will review your application. You will be updated on your given email address. In the mean time,
                    explore our website and social media.
                    <br />
                    Thank-you !
                </p>
                <p>
                    @if (\App\Classes\Helpers\SystemSetting::basic_configuration('host'))
                        <a
                            href="{{ \App\Classes\Helpers\SystemSetting::basic_configuration('host') }}">@Website</a><br />
                    @endif

                    @if (\App\Classes\Helpers\SystemSetting::basic_configuration('social_facebook'))
                        <a
                            href="{{ \App\Classes\Helpers\SystemSetting::basic_configuration('social_facebook') }}">@Facebook</a><br />
                    @endif

                    @if (\App\Classes\Helpers\SystemSetting::basic_configuration('social_instagram'))
                        <a
                            href="{{ \App\Classes\Helpers\SystemSetting::basic_configuration('social_instagram') }}">@Instagram</a>
                    @endif
                </p>

            </div>
        </div>
    </div>
</div>
@php
    session()->forget(session()->getId());
@endphp
