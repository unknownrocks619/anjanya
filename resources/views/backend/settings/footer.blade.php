@extends('themes.admin.master')

@push('page_title')
    - Footer Settings
@endpush

@section('main-content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Footer Settings</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            @if (!$footerInstagramSetting)
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-info">
                                Your Social Profile Instagram Setting is missing. Please Provide your instagram username to
                                continue.
                            </div>
                            <form action="{{ route('admin.settings.save-social-configuration') }}" method="post"
                                class="ajax-form">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="instagram">Instagram</label>
                                            <input type="text"
                                                value="{{ \App\Classes\Helpers\SystemSetting::social_media('social_instagram') }}"
                                                name="social_instagram" id="instagram" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mt-3">
                                        <button type="submit" class="btn btn-primary">
                                            Save Information
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <!-- Zero Configuration  Starts-->
                <div class="col-8">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h3 class='text-white'>Upload Gallery</h3>
                        </div>
                        <div class="card-body">
                            @if (\App\Models\Setting::where('name', 'social_instagram_footer_images')->exists())
                                @php
                                    $instagramSetting = \App\Models\Setting::where('name', 'social_instagram_footer_images')->first();
                                @endphp
                                @include('backend.media.list', [
                                    'model' => $instagramSetting,
                                    'content' => $instagramSetting->getImage,
                                ])
                            @else
                                <div class="alert alert-danger">
                                    Configuration Missing !
                                </div>
                                <form action="{{ route('admin.settings.footer-page') }}" method="post" class="ajax-form">
                                    <button class="btn btn-warning" type="submit">
                                        Reset Configuration
                                    </button>
                                </form>
                            @endif

                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary">
                                Save Configuration
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <button class="btn btn-danger data-confirm" data-confirm="Clear All Cache ?"
                        data-action="{{ route('admin.settings.footer-page') }}" data-method="post">
                        Clear Cache !
                    </button>
                </div>
            @endif
        </div>
    </div>
@endsection
