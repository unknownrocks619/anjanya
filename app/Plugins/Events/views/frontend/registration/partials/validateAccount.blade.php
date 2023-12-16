@php /** @var \App\Plugins\Events\Http\Models\Event $event */ @endphp
<div class="container checkout-page-style">

    <div class="row g-5 justify-content-center my-2">
        <div class="col-lg-8">
            <div class="login-form-box border-1">
                <h3 class="mb-30"><span class="text-danger">{{$event->event_title}}</span> {{__('web/registration/events.registration')}}</h3>
                <form method="post" onsubmit="this.preventDefault()" id="registration-form" class="ajax-append ajax-message ajax-response login-form" action="{{route('frontend.event.event-registration-process',['event'=>$event])}}">
                    <div class="input-box mb--30 form-group">
                        <input type="text" name="email" placeholder="{{__('web/registration/events.email-address')}}">

                    </div>
                        <span class="text-danger text-start text-left">
                            {{__('web/registration/events.user-previous-email-for-registration')}}
                        </span>
                    <button class="rn-btn edu-btn w-100 mb--30" onclick="window.Registration.submitForm(this)" type="button">
                        <span>{{__('web/registration/events.proceed')}}</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
