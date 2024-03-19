@php
    /** @var  \App\Plugins\Events\Http\Models\Event $event */
    $bannerImage = $event->getImage()->where('type','banner_image')->first();
    $banner_image = null;

    if ($bannerImage) {
        $banner_image = \App\Classes\Helpers\Image::getImageAsSize($bannerImage->image?->filepath, 'l');
    }
    $breadCrumb = [
        ['label' => 'Home','link' => '/'],
        ['label' => 'Refer' ,'link' => '#'],
    ];
@endphp
@php
    $jsLangFiles = [
        'full_name' =>__('web/registration/events.full-name'),
        'country' => __('web/registration/events.country'),
        'email' => __('web/registration/events.email-address'),
        'phone_number'  => __('web/registration/events.mobile-number')
]
@endphp

@extends($user_theme->frontend_layout($extends))
@section('page_title') - {{$event->event_title}} @endsection
@section('main')
    {!! $user_theme->partials('page-header',['title' => $event->event_title . ' Refer','bannerImage' => $banner_image,'breadCrumb' => $breadCrumb]) !!}
    <div class="main-wrapper container my-5">
        <div class="loading d-none" style="height: 90vh;position:absolute;z-index: 9;opacity: 0.5;width:100%;display:flex;justify-content:center;align-items: center;">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: rgb(255, 255, 255); display: block; shape-rendering: auto;" width="200px" height="200px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                <rect x="17.5" y="30" width="15" height="40" fill="#e15b64">
                    <animate attributeName="y" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="18;30;30" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.2s"></animate>
                    <animate attributeName="height" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="64;40;40" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.2s"></animate>
                </rect>
                <rect x="42.5" y="30" width="15" height="40" fill="#f8b26a">
                    <animate attributeName="y" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="20.999999999999996;30;30" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.1s"></animate>
                    <animate attributeName="height" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="58.00000000000001;40;40" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.1s"></animate>
                </rect>
                <rect x="67.5" y="30" width="15" height="40" fill="#abbd81">
                    <animate attributeName="y" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="20.999999999999996;30;30" keySplines="0 0.5 0.5 1;0 0.5 0.5 1"></animate>
                    <animate attributeName="height" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="58.00000000000001;40;40" keySplines="0 0.5 0.5 1;0 0.5 0.5 1"></animate>
                </rect>
            </svg>
        </div>
        <form action="{{route('frontend.event.refer-friend-family',['user' => $user,'event' => $event->event_slug])}}" method="post" class="ajax-form ajax-append">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="no_of_referee">{{__('web/registration/events.number-of-referral')}}</label>
                        <input type="number" value="0" onchange="populateMemberList(this)" name="no_of_referee" id="no_of_referee" class="form-control" />
                    </div>
                </div>
            </div>
            <div id="referee_info" data-language-key='{{json_encode($jsLangFiles)}}'></div>
            <div class="row">
                <div class="col-md-12 text-end">
                    <button class="btn btn-primary edu-btn">
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>

@endsection

@push('page_script')
    <style>
        label {
            font-size: 24px
        }
        .select2-selection__rendered {
            font-size: 24px !important;
            padding-top: 10px
        }
        .select2-selection {
            height: 50px !important;
        }
        .select2-results__option{
            font-size: 24px;
        }
    </style>

    <script>
        function populateMemberList(elm) {
            let _currentTotal = $(elm).val();
            if ( _currentTotal > 12 ) {
                $(elm).val(12);
                _currentTotal = 12;
            }
            let _appendRowCount = $('div#referee_info').children().length;
            let _langDataParam =  $('div#referee_info').attr('data-language-key');

            _langDataParam = JSON.parse(_langDataParam);
            let _toPopulate = `<div class='row border border-1 my-1'>
            <div class="col-md-6 col-sm-12 col-lg-3">
                <div class="form-group">
                    <label>${_langDataParam.full_name}<sup class="text-danger">*</sup></label>
                    <input type="text" name="referer_full_name[]" value="" class="form-control">
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-lg-3">
                <div class="form-group">
                    <label>${_langDataParam.country}</label>
                    <select name="referer_country[]" class="form-control ajax-select-2"  data-action="https://jagadguru.siddhamahayog.org/api/v1/countries"><option value="" selected></option></select>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-lg-3">
                <div class="form-group">
                    <label>${_langDataParam.email}</label>
                    <input type="text" name="referer_email[]" value="" class="form-control">
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-lg-3">
                <div class="form-group">
                    <label>${_langDataParam.phone_number}<sup class="text-danger">*</sup></label>
                    <input type="text" name="referer_phone_number[]" value="" class="form-control">
                </div>
            </div>
        </div>`

            let _appendHTML = '';
            if ( ! _appendRowCount ) {
                for(let i=1; i <= _currentTotal ; i++) {
                    _appendHTML += _toPopulate;
                }
                $('div#referee_info').html(_appendHTML);

            } else if (_appendRowCount > _currentTotal ) {
                $('div#referee_info').children().slice(_currentTotal).remove();
            } else {

                for (let i = 1; i <= (_currentTotal - _appendRowCount); i++) {
                    _appendHTML += _toPopulate;
                }

                $('div#referee_info').append(_appendHTML);

            }

            select2();
        }
        function select2() {
            $.each($('select'), function (index,item) {
                window.ajaxReinitalize(item);
            });
        }
    </script>
@endpush
