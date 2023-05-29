@extends('layouts.frontend.layout_one')

@section('title')
    {{ __('plan_details') }} ({{ $plan->label }})
@endsection

@section('meta')
    @php
    $data = metaData('pricing');
    @endphp

    <meta name="title" content="{{ $data->title }}">
    <meta name="description" content="{{ $data->description }}">

    <meta property="og:image" content="{{ $data->image_url }}" />
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="{{ $data->title }}">
    <meta property="og:url" content="{{ route('frontend.priceplan') }}">
    <meta property="og:type" content="article">
    <meta property="og:description" content="{{ $data->description }}">

    <meta name=twitter:card content={{ $data->image_url }} />
    <meta name=twitter:site content="{{ config('app.name') }}" />
    <meta name=twitter:url content="{{ route('frontend.priceplan') }}" />
    <meta name=twitter:title content="{{ $data->title }}" />
    <meta name=twitter:description content="{{ $data->description }}" />
    <meta name=twitter:image content="{{ $data->image_url }}" />
@endsection

@section('content')
    <!-- breedcrumb section start  -->
    <x-frontend.breedcrumb-component :background="$cms->pricing_plan_background">
        {{ __('overview') }}
        <x-slot name="items">
            <li class="breedcrumb__page-item">
                <a href="{{ route('frontend.priceplan') }}"
                    class="breedcrumb__page-link text--body-3">{{ __('plan_details') }}</a>
            </li>
            <li class="breedcrumb__page-item">
                <a class="breedcrumb__page-link text--body-3">/</a>
            </li>
            <li class="breedcrumb__page-item">
                <a class="breedcrumb__page-link text--body-3">{{ __('plan_details') }}</a>
            </li>
        </x-slot>
    </x-frontend.breedcrumb-component>
    <!-- breedcrumb section end  -->
    <section class="section benefits bgcolor--gray-10">
        <div class="container">
            <h2 class="text--heading-1 section__title">{{ __('plan_details_and_benefits') }} </h2>
            <div class="row justify-content-center my-3">
                <div class="col-lg-12">
                    <div class="dashboard-card dashboard-card--benefits">
                        <h2 class="dashboard-card__title">{{ __('current_plan_benefits') }}</h2>
                        <ul class="dashboard__benefits">
                            <li class="dashboard__benefits-left">
                                <ul>
                                    <li class="dashboard__benefits-item">
                                        <span class="icon">
                                            <x-svg.check-icon width="12" height="12" stroke="#00AAFF" />
                                        </span>
                                        <p class="text--body-4">{{ __('post') }} {{ $plan->ad_limit }}
                                            {{ __('ads') }}</p>
                                    </li>
                                    @if (isset($plan->featured_limit))
                                        <li class="dashboard__benefits-item">
                                            <span class="icon">
                                                <x-svg.check-icon width="12" height="12" stroke="#00AAFF" />
                                            </span>
                                            <p class="text--body-4">{{ __('featured_on_homepage') }}
                                                {{ $plan->featured_limit }} {{ __('ads') }}</p>
                                        </li>
                                    @endif
                                    @if (isset($plan->badge))
                                        <li class="dashboard__benefits-item">
                                            <span class="icon">
                                                <x-svg.check-icon width="12" height="12" stroke="#00AAFF" />
                                            </span>
                                            <p class="text--body-4">{{ __('special_membership_badge') }}</p>
                                        </li>
                                    @endif
                                    @if (isset($plan->business_directory_limit))
                                        <li class="dashboard__benefits-item">
                                            <span class="icon">
                                                <x-svg.check-icon width="12" height="12" stroke="#00AAFF" />
                                            </span>
                                            <p class="text--body-4">{{ $plan->business_directory_limit }}  {{ __('business_directory') }}</p>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                {{-- Paypal payment --}}
                @if (config('paypal.mode') == 'sandbox')
                    @if (config('paypal.active') && config('paypal.sandbox.client_id') && config('paypal.sandbox.client_id'))
                        <div class="col-xl-6">
                            <div class="membership-card">
                                <div class="membership-card__icon" style="background-color: #e8f7ff">
                                    <x-svg.paypal-icon />
                                </div>
                                <div class="membership-card__info">
                                    <h2 class="membership-card__title text--body-1">{{ __('paypal_payment') }}</h2>
                                    <button id="paypal_btn" class="mt-3 btn btn--lg price-plan__checkout-btn">
                                        {{ __('pay_now') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    @if (config('paypal.active') && config('paypal.live.client_id') && config('paypal.live.client_secret'))
                        <div class="col-xl-6">
                            <div class="membership-card">
                                <div class="membership-card__icon" style="background-color: #e8f7ff">
                                    <x-svg.paypal-icon />
                                </div>
                                <div class="membership-card__info">
                                    <h2 class="membership-card__title text--body-1">{{ __('paypal_payment') }}</h2>
                                    <button id="paypal_btn" class="mt-3 btn btn--lg price-plan__checkout-btn">
                                        {{ __('pay_now') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif

                {{-- Stripe payment --}}
                @if (config('zakirsoft.stripe_active') && config('zakirsoft.stripe_key') && config('zakirsoft.stripe_secret'))
                    <div class="col-xl-6">
                        <div class="membership-card">
                            <div class="membership-card__icon" style="background-color: #e8f7ff">
                                <x-svg.stripe-icon />
                            </div>
                            <div class="membership-card__info">
                                <h2 class="membership-card__title text--body-1">{{ __('stripe_payment') }}</h2>
                                <button id="stripe_btn" class="mt-3 btn btn--lg price-plan__checkout-btn">
                                    {{ __('pay_now') }}
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Razorpay payment --}}
                @if (config('zakirsoft.razorpay_active') &&
                    config('zakirsoft.razorpay_key') &&
                    config('zakirsoft.razorpay_secret'))
                    <div class="col-xl-6">
                        <div class="membership-card">
                            <div class="membership-card__icon" style="background-color: #e8f7ff">
                                <img src="{{ asset('frontend/images/payment/razorpay.svg') }}" alt="">
                            </div>
                            <div class="membership-card__info">
                                <h2 class="membership-card__title text--body-1">{{ __('razor_payment') }}</h2>
                                <button id="razorpay_btn" class="mt-3 btn btn--lg price-plan__checkout-btn">
                                    {{ __('pay_now') }}
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- SSl Commerz payment --}}
                @if (config('zakirsoft.ssl_active') && config('zakirsoft.ssl_id') && config('zakirsoft.ssl_pass'))
                    <div class="col-xl-6">
                        <div class="membership-card">
                            <div class="membership-card__icon" style="background-color: #e8f7ff">
                                <img src="{{ asset('frontend/images/payment/ssl.jpeg') }}" alt="">
                            </div>
                            <div class="membership-card__info">
                                <h2 class="membership-card__title text--body-1">{{ __('sslcommerz_payment') }}</h2>
                                <button type="button" id="ssl_btn" class="mt-3 btn btn--lg price-plan__checkout-btn">
                                    {{ __('pay_now') }}
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Paystack payment --}}
                @if (config('zakirsoft.paystack_active') &&
                    config('zakirsoft.paystack_key') &&
                    config('zakirsoft.paystack_secret'))
                    <div class="col-xl-6">
                        <div class="membership-card">
                            <div class="membership-card__icon" style="background-color: #e8f7ff">
                                <img src="{{ asset('frontend/images/payment/paystack.png') }}" alt="">
                            </div>
                            <div class="membership-card__info">
                                <h2 class="membership-card__title text--body-1">{{ __('paystack_payment') }}</h2>
                                @if (config('adlisting.currency') == 'USD')
                                    <button id="paystack_btn" class="mt-3 btn btn--lg price-plan__checkout-btn">
                                        {{ __('pay_now') }}
                                    </button>
                                @else
                                    <p class="text-danger">{{ __('paystack_does_not_support') }}
                                        {{ config('adlisting.currency') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Flutterwave payment --}}
                @if (config('zakirsoft.flw_active') &&
                    config('zakirsoft.flw_public_key') &&
                    config('zakirsoft.flw_secret') &&
                    config('zakirsoft.flw_secret_hash'))
                    <div class="col-xl-6">
                        <div class="membership-card">
                            <div class="membership-card__icon" style="background-color: #e8f7ff">
                                <img height="80px" width="80px"
                                    src="{{ asset('frontend/images/payment/Flutterwave-logo.png') }}" alt="">
                            </div>
                            <div class="membership-card__info">
                                <h2 class="membership-card__title text--body-1">{{ __('flutterwave_payment') }}</h2>
                                <button id="flutterwave_btn" class="mt-3 btn btn--lg price-plan__checkout-btn">
                                    {{ __('pay_now') }}
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Instamojo payment --}}
                @if (config('zakirsoft.im_active') &&
                    config('zakirsoft.im_key') &&
                    config('zakirsoft.im_secret') &&
                    config('zakirsoft.im_url'))
                    <div class="col-xl-6">
                        <div class="membership-card">
                            <div class="membership-card__icon" style="background-color: #e8f7ff">
                                <img height="20px" width="20px"
                                    src="{{ asset('frontend/images/payment/insta.png') }}" alt="">
                            </div>
                            <div class="membership-card__info">
                                <h2 class="membership-card__title text--body-1">{{ __('instamojo_payment') }}</h2>
                                <button id="instamojo_btn" class="mt-3 btn btn--lg price-plan__checkout-btn">
                                    {{ __('pay_now') }}
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Midtrans payment --}}
                @if (config('zakirsoft.midtrans_active') &&
                    config('zakirsoft.midtrans_id') &&
                    config('zakirsoft.midtrans_key') &&
                    config('zakirsoft.midtrans_secret'))
                    <div class="col-xl-6">
                        <div class="membership-card">
                            <div class="membership-card__icon" style="background-color: #e8f7ff">
                                <img height="20px" width="20px"
                                    src="{{ asset('frontend/images/payment/midtrans.jpeg') }}" alt="">
                            </div>
                            <div class="membership-card__info">
                                <h2 class="membership-card__title text--body-1">{{ __('midtrans_payment') }}</h2>
                                <button id="midtrans_btn" class="mt-3 btn btn--lg price-plan__checkout-btn">
                                    {{ __('pay_now') }}
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Mollie payment --}}
                @if (config('zakirsoft.mollie_key') && config('zakirsoft.mollie_active'))
                    <div class="col-xl-6">
                        <div class="membership-card">
                            <div class="membership-card__icon" style="background-color: #e8f7ff">
                                <img height="20px" width="20px"
                                    src="{{ asset('frontend/images/payment/mollie.png') }}" alt="">
                            </div>
                            <div class="membership-card__info">
                                <h2 class="membership-card__title text--body-1">{{ __('mollie_payment') }}</h2>
                                <button id="mollie_btn" class="mt-3 btn btn--lg price-plan__checkout-btn">
                                    {{ __('pay_now') }}
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        {{-- Paypal Form --}}
        <form action="{{ route('paypal.post') }}" method="POST" class="d-none" id="paypal-form">
            @csrf
        </form>

        {{-- Stripe Form --}}
        <form action="{{ route('stripe.post') }}" method="POST" class="d-none">
            @csrf
            <script id="stripe_script" src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="{{ config('zakirsoft.stripe_key') }}" data-amount="{{ session('stripe_amount') }}"
                data-name="{{ config('app.name') }}" data-description="Money pay with stripe"
                data-locale="{{ app()->getLocale() == 'default' ? 'en' : app()->getLocale() }}" data-currency="USD"></script>
        </form>

        {{-- Razorpay Form --}}
        <form action="{{ route('razorpay.post') }}" method="POST" class="d-none">
            @csrf
            <script id="razor_script" src="https://checkout.razorpay.com/v1/checkout.js"
                data-key="{{ config('zakirsoft.razorpay_key') }}" data-amount="{{ session('razor_amount') }}"
                data-buttontext="Pay with Razorpay" data-name="{{ config('app.name') }}" data-description="Money pay with razorpay"
                data-prefill.name="{{ auth('user')->user()->name }}" data-prefill.email="{{ auth('user')->user()->email }}"
                data-theme.color="#2980b9" data-currency="INR"></script>
        </form>

        {{-- paystack_btn Form --}}
        <form action="{{ route('paystack.post') }}" method="POST" class="d-none" id="paystack-form">
            @csrf
        </form>

        {{-- SSL Form --}}
        <form method="POST" class="needs-validation d-none" novalidate>
            <input type="hidden" value="{{ session('ssl_amount') }}" name="amount" id="total_amount" />
            <input id="ssl_plan_id" type="hidden" name="plan_id" value="{{ $plan->id }}">
            <button class="btn btn-primary" id="sslczPayBtn" token="if you have any token validation"
                postdata="your javascript arrays or objects which requires in backend"
                order="If you already have the transaction generated for current order"
                endpoint="{{ route('ssl.pay') }}"> {{ __('pay_now') }}
            </button>
        </form>

        {{-- flutterwave Form --}}
        <form action="{{ route('flutterwave.pay') }}" method="POST" class="d-none" id="flutter-form">
            @csrf
        </form>

        {{-- instamojo Form --}}
        <form action="{{ route('instamojo.pay') }}" method="POST" class="d-none" id="instamojo-form">
            @csrf
        </form>

        {{-- mollie Form --}}
        <form action="{{ route('mollie.payment') }}" method="POST" class="d-none" id="mollie-form">
            @csrf
        </form>
    </section>
@endsection

@section('frontend_script')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('zakirsoft.midtrans_key') }}">
    </script>
    <script>
        $('#paypal_btn').on('click', function(e) {
            e.preventDefault();
            $('#paypal-form').submit();
        });

        $('#stripe_btn').on('click', function(e) {
            e.preventDefault();
            $('.stripe-button-el').click();
        });

        $('#razorpay_btn').on('click', function(e) {
            e.preventDefault();
            $('.razorpay-payment-button').click();
        });

        $('#paystack_btn').on('click', function(e) {
            e.preventDefault();
            $('#paystack-form').submit();
        });
        $('#ssl_btn').on('click', function(e) {
            e.preventDefault();
            $('#sslczPayBtn').click();
        });
        $('#flutterwave_btn').on('click', function(e) {
            e.preventDefault();
            $('#flutter-form').submit();
        });
        $('#instamojo_btn').on('click', function(e) {
            e.preventDefault();
            $('#instamojo-form').submit();
        });
        $('#mollie_btn').on('click', function(e) {
            e.preventDefault();
            $('#mollie-form').submit();
        });

        // ssl commerz
        var obj = {};
        obj.amount = $('#total_amount').val();
        obj.plan_id = $('#ssl_plan_id').val();

        $('#sslczPayBtn').prop('postdata', obj);

        (function(window, document) {
            var loader = function() {
                var script = document.createElement("script"),
                    tag = document.getElementsByTagName("script")[0];
                // script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR LIVE
                script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(
                    7); // USE THIS FOR SANDBOX
                tag.parentNode.insertBefore(script, tag);
            };

            window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload",
                loader);
        })(window, document);


        // Midtrans
        if (
            '{{ config('zakirsoft.midtrans_active') && config('zakirsoft.midtrans_id') && config('zakirsoft.midtrans_key') && config('zakirsoft.midtrans_secret') }}'
        ) {

            const payButton = document.querySelector('#midtrans_btn');
            payButton.addEventListener('click', function(e) {
                e.preventDefault();

                snap.pay('{{ $mid_token }}', {
                    // Optional
                    onSuccess: function(result) {
                        // console.log(result);
                        successMidtransPayment();
                    },
                    // Optional
                    onPending: function(result) {
                        alert('Transaction is in pending state');
                    },
                    // Optional
                    onError: function(result) {
                        alert('Transaction is failed. Try again.');
                    }
                });
            });

            function successMidtransPayment() {
                $.ajax({
                    type: "post",
                    url: "{{ route('midtrans.success') }}",
                    data: {
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        window.location.href = response.redirect_url;
                    }
                });
            }
        }
    </script>
@endsection
