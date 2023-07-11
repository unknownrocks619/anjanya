@extends('themes.frontend.users.auth', ['class' => 'bg-light', 'id' => 'home'])

@push('title')
    :: Checkout
@endpush

@section('main_content')
    @if (empty($order))
        <div class="container d-flex mt-5 justify-content-center" style="margin-top: 8% !important">
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-10 text-center ms-5 ps-5 mt-5 pt-4 ">
                            <!-- Login -->
                            <h2 class="mb-6 text-success" style="font-weight:bold;color:#03014C !important;font-weight:700;">
                                Oops, No Item in your basket.
                            </h2>
                            <!-- Text -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container mt-5" style="margin-top:8% !important">
            <div class="row mt-5">
                <div class="col-md-6">
                    @if ($order?->first_name && $order?->last_name && $order?->email)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input readonly type="text" value="{{ $order?->first_name }}"
                                        class="py-2 form-control">
                                </div>
                            </div>
                            <div class="col-md-12 my-3">
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input readonly type="text" value="{{ $order?->last_name }}"
                                        class="py-2 form-control" />
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input readonly type="text" value="{{ $order?->email }}" class="py-2 form-control" />
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-danger py-3 px-5 my-2 already-member-button"
                                    style="display:none">Already
                                    a
                                    Member</button>
                                <button class="btn  btn-danger py-3 px-5 my-2 signout-as-guest">
                                    Continue as Guest
                                </button>
                                <div class="login_user">
                                    <form action="{{ route('frontend.users.login', ['__ref' => 'order']) }}" method="post"
                                        class="ajax-form">
                                        <div class="row">
                                            <div class="row me-5">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        @error('email')
                                                            <div class="text-danger mb-2"
                                                                style="font-weight:700;color:#B81242 !important;font-family:'Inter' !important;font-size:17px !important;">
                                                                {{ $message }}</div>
                                                        @enderror
                                                        <input value="{{ old('email') }}" type="text"
                                                            style="font-family:'Inter'" name="email"
                                                            class="py-4 form-control rounded-3 @error('email') border border-danger @enderror w-100"
                                                            id="email" placeholder="Email Address" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-1 me-5">
                                                <div class="col-md-12 mt-1">
                                                    <div class="form-group mt-3">
                                                        <input required type="password"
                                                            style="font-family:'Inter' !important"
                                                            value="{{ old('password') }}" name="password"
                                                            placeholder="Password"
                                                            class="py-4 rounded-3 form-control @error('password') border border-danger @enderror"
                                                            id="password" />
                                                        @error('password')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-4 me-5">
                                                <div class="col-md-12  d-flex justify-content-start">
                                                    <input id="remember" style="width:22px; height: 22px;" type="checkbox"
                                                        name="remember" value="1" />
                                                    <label for="remember" class="mb-2 ms-2 pt-0">
                                                        Keep me logged in until I log out
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row mt-4 text-right me-5">
                                                <div class="col-md-12 text-right d-flex justify-content-end">
                                                    <button class="w-100 btn btn-primary next py-3 px-5 login-button"
                                                        type="submit">
                                                        Sign In
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-md-6"
                                                    style="color:#03014C;font-size:17px; font-family:'Inter';font-weight:700">
                                                    <a style="color:#03014C !important;text-decoration:none"
                                                        href="{{ route('frontend.users.reset') }}">Forgot Password?</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="checkout_as_guest" style="display:none">
                                    <form action="{{ route('frontend.orders.update_basic_detail', ['order' => $order]) }}"
                                        method="post" class="ajax-form">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input value="{{ $order?->first_name }}" type="text"
                                                        style="font-family:'Inter'" name="user_first_name"
                                                        class="py-4 form-control rounded-3 w-100" id="user_first_name"
                                                        placeholder="First name" />
                                                </div>
                                            </div>
                                            <div class="col-md-12 my-2">
                                                <div class="form-group">
                                                    <input value="{{ $order?->last_name }}" type="text"
                                                        style="font-family:'Inter'" name="user_last_name"
                                                        class="py-4 form-control rounded-3 w-100" id="user_last_name"
                                                        placeholder="Last Name" />
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-2">
                                                <div class="form-group">
                                                    <input value="{{ $order?->email }}" type="text"
                                                        style="font-family:'Inter'" name="user_email"
                                                        class="py-4 form-control rounded-3 w-100" id="email"
                                                        placeholder="Email Address" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 text-right d-flex justify-content-end">
                                                <button class="w-100 btn btn-primary next py-3 px-5 login-button"
                                                    type="submit">
                                                    Validate Detail
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-md-6">
                    <div class="row">
                        @foreach ($orderLines as $orderline)
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        {{ $orderline->getProduct->product_name }}
                                        <br />
                                        Supported Project:
                                        {{ $orderline->getProject->title }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>


                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="row d-flex justify-content-between align-items-center ">
                                <div class="col-md-6 text-start">
                                    Total Amount:
                                </div>
                                <div class="col-md-6 text-end">
                                    {{ \App\Classes\Helpers\Money::AU($order->total_amount) }}
                                </div>
                            </div>
                            <div class="row d-flex justify-content-between align-items-center ">
                                <div class="col-md-6 text-start">
                                    Processing Fee:
                                </div>
                                <div class="col-md-6 text-end">
                                    {{ \App\Classes\Helpers\Money::AU(($order->total_amount * 2.9) / 100 + 0.3) }}
                                </div>
                            </div>
                            <div class="row d-flex justify-content-between align-items-center ">
                                <div class="col-md-6 text-start">
                                    Net Amount:
                                </div>
                                <div class="col-md-6 text-end">
                                    {{ \App\Classes\Helpers\Money::AU($order->total_amount + (($order->total_amount * 2.9) / 100 + 0.3)) }}
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row mt-2">
                        <div class="col-md-12">
                            <div class="card-body">
                                <p class="text-info">
                                    Please Note: We do not store any card or personal information. All payments are
                                    processed by
                                    stripe.

                                </p>
                                @if ($order->first_name && $order->last_name && $order->email)
                                    <form class="checkout-form" action="{{ route('frontend.orders.checkout') }}"
                                        method="post">
                                        <div id="card-errors" role="alert"></div>
                                        <div id="card-element"></div>
                                        <div class="row mt-2">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="hidden" name="payment_method" class="payment-method"
                                                        id="payment_method">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-success pay" disabled>
                                                    Please wait...
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@if ($order)
    @push('page_script')
        <script src="https://js.stripe.com/v3/"></script>
        <script>
            const clientSecret = "{{ $intent->client_secret }}";
            var stripe = Stripe('{{ env('STRIPE_KEY') }}')

            var elements = stripe.elements({
                clientSecret
            });
            var cardElement = elements.create('payment', {
                layout: "accordion"
            });
            cardElement.mount('#card-element')
            let paymentMethod = null;

            $(document).on('submit', '.checkout-form', function(event) {
                event.preventDefault();
                $('.pay').attr('disabled', true);
                elements.submit();
                confirmStripePayment(clientSecret).then((paymenIntent) => {
                    console.log('okay we got somehting to look at.', paymenIntent);
                }).catch((error) => {
                    console.log("let's catch an error from another.");
                    console.log('error: ', error);
                });

            })
            const confirmStripePayment = (clientSecret) => {
                return new Promise(async (resolve, reject) => {
                    try {
                        const {
                            error,
                            setupIntent
                        } = await stripe.confirmPayment({
                            elements,
                            confirmParams: {
                                return_url: "{{ route('frontend.orders.stripe_response') }}"
                            }
                        })

                        if (error) {
                            console.log('we got error:_ ', error);
                            reject(error);
                        } else {
                            resolve(paymenIntent);
                        }
                    } catch (error) {
                        console.log('we got an error to catch :D',
                            error);
                        reject(error);
                    }
                })
            }

            const createPaymentIntent = async () => {
                const paymentIntent = await stripe.paymentIntents.create({
                    amount: 1000, // The amount in cents
                    currency: 'aud', // The currency
                    // Add additional parameters as needed
                });

                return paymentIntent.client_secret;
            };

            setTimeout(() => {
                $('.pay').removeAttr('disabled', false).text('Make payment')
            }, 4000);
        </script>
    @endpush
@endif
