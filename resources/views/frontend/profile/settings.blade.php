@extends('themes.frontend.users.profile')

@push('title')
    :: Settings
@endpush

@section('main_content')
    <div class="container">

        @include ('frontend.profile.partials.stat', ['user' => $user])
        <div class="course-nav">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    @foreach ($tabs as $tab_key => $tab_value)
                        <button class="nav-link {{ $tab_key == $current_tab ? 'active' : '' }}"
                            id="nav-{{ $tab_key }}-tab" data-bs-toggle="tab" data-bs-target="#nav-{{ $tab_key }}"
                            type="button" role="tab" aria-controls="nav-home"
                            aria-selected="{{ $tab_key == $current_tab ? 'true' : 'false' }}">
                            {{ __('web/profile.' . $tab_key) }}
                        </button>
                    @endforeach
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                @foreach ($tabs as $tab_key => $tab_value)
                    <div class="tab-pane fade {{ $tab_key == $current_tab ? 'show active' : '' }}"
                        id="nav-{{ $tab_key }}" role="tabpanel" aria-labelledby="nav-{{ $tab_key }}-tab"
                        tabindex="0">
                        @include('frontend.profile.tabs.' . $tab_key, [
                            'content' => $tab_value,
                            'current_tab' => $tab_value,
                            'user' => $user,
                        ])
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection


@push('custom_js')
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            if ($('.ajax-select').length) {
                $('.ajax-select').select2();
            }

            if ($('.billing_address_check').length) {
                $('.billing_address_check').on('click', function(event) {
                    let addressElement = $('div.shipping_address');
                    if (!$(this).is(':checked')) {
                        $(addressElement).removeClass('d-none');
                    } else {
                        $(addressElement).addClass('d-none');
                    }
                })
            }
        })
    </script>
@endpush
@push('custom_css')
    <style type="text/css">
        .cvc-card>.select2-container {
            z-index: 99999999 !important;
        }

        .cvc-card>.select2-drop {
            z-index: 999999999 !important
        }

        .select2-container.select2-container--default.select2-container--open {
            z-index: 9999999999999;
        }
    </style>
@endpush
