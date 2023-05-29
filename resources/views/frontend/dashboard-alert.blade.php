{{--@if (auth('user')->check() &&
    !auth()->user()->hasVerifiedEmail() &&
    $settings->customer_email_verification)
    <div class="row">
        <div class="col-12 mb-2">
            <div class="alert alert-warning mb-0" role="alert">
                <strong>{{ __('verify_account_now') }}</strong> <a href="{{ route('verification.notice') }}"
                    class="text-dark text-decoration-underline">
                    {{ __('click_here') }}
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
@endif
@if (auth('user')->check() && isset(session('user_plan')->ad_limit) && session('user_plan')->ad_limit < $settings->free_ad_limit)
    <div class="alert alert-warning mb-2" role="alert">
        <strong>{{ __('upgrade_plan') }}!</strong> {{ __('limited_ads') }} <a
            href="{{ route('frontend.priceplan') }}"
            class="text-dark text-decoration-underline">{{ __('go_to_details') }}</a>
    </div>
@endif  --}}
