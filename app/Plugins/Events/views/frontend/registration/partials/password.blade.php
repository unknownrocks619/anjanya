@php /** @var \App\Plugins\Events\Http\Models\Event $event */ @endphp
<div class="container checkout-page-style">
    <div class="row g-5 justify-content-center my-2">
        <div class="col-lg-8">
            <div class="login-form-box border-1">
                <h3 class="mb-30"><span class="text-danger">{{$event->event_title}}</span> Registration</h3>

                <form method="post" id="registration-form" class="ajax-form ajax-append ajax-message ajax-response login-form" action="{{route('frontend.event.event-registration-process',['event'=>$event])}}">
                    <div class="input-box mb--30 form-group">
                        <label for="email">Email
                        <sup class="text-danger">*</sup>
                        </label>
                        <input type="text" name="email" value="{{session()->get('registration-email')}}" placeholder="Email Address">
                    </div>
                    <div class="input-box mb--30 form-group">
                        <label for="email">Password
                            <sup class="text-danger">*</sup>
                        </label>
                        <input type="password" name="password" value="" placeholder="Password">
                    </div>

                    <button class="rn-btn edu-btn w-100 mb--30" onclick="window.Registration.submitForm(this)" type="button">
                        <span>Proceed</span>
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>
