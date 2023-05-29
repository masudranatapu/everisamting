<div class="col-lg-6 order-1 order-lg-0">
    <div class="registration-form">
        <h2 class="text-center text--heading-1 registration-form__title">{{ __('sign_in') }}</h2>
        {{-- Social Login --}}
        <x-auth.social-login />
        <div class="registration-form__wrapper">
            <form action="{{ route('frontend.login') }}" method="POST">
                @csrf
                <div class="form-floating mb-3">
                    <input value="{{ old('email') }}" type="text" id="email" name="login_data"class="form-control @error('email') is-invalid border-danger @enderror @error('username') is-invalid border-danger @enderror" placeholder="{{ __('username_or_email_address') }}">
                    <label for="email">{{ __('username_or_email_address') }}</label>
                </div>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                @error('username')
                    <span class="text-danger">{{ $message }}</span>
                @enderror


                <div class="form-floating input-group mb-3">
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid border-danger @enderror @error('password') is-invalid border-danger @enderror" placeholder="{{ __('password') }}">
                     <label for="password">{{ __('password') }}</label>
                    <span class="input-group-text icon icon--eye {{ $errors->has('password') ? 'height-45' : '' }}"
                        onclick="showPassword('password',this)">
                        <x-svg.eye-icon />
                    </span>
                </div>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror


                <div class="registration-form__option">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="checkme" />
                        <x-forms.label name="keep_me_logged" class="form-check-label" for="checkme" />
                    </div>

                    <div class="registration-form__forget-pass text--body-4">
                        <a href="{{ route('customer.forgot.password') }}">{{ __('forget_password') }}</a>
                    </div>
                </div>

                <button class="btn btn--lg w-100 registration-form__btns" type="submit">
                    {{ __('sign_in') }}
                   <!--  <span class="icon--right">
                        <x-svg.right-arrow-icon stroke="#fff" />
                    </span> -->
                </button>

                <p class="text--body-3 registration-form__redirect">{{ __('dont_have_account') }} ? <a
                        href="{{ route('frontend.signup') }}">{{ __('sign_up') }}</a></p>
            </form>
        </div>
    </div>
</div>

@push('component_style')
    <style>
        .height-45 {
            height: 45px !important;
        }
    </style>
@endpush
