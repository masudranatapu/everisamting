<div class="col-lg-6 order-1 order-lg-0">
    <div class="registration-form">
        <h2 class="text-center text--heading-1 registration-form__title">{{ __('sign_up') }}</h2>
        {{-- Social Login --}}
        <x-auth.social-login />
        <div class="registration-form__wrapper">
            <form action="{{ route('customer.register') }}" method="POST">
                @csrf
                <div class="form-floating input-field mb-3">
                    <input value="{{ old('name') }}" type="text" name="name"class="form-control @error('name') is-invalid border-danger @enderror" placeholder="{{ __('full_name') }} ">
                    <label for="name">{{ __('full_name') }} {{ (__('(Private)')) }}</label>
                </div>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="form-floating input-field mb-3">
                    <input value="{{ old('username') }}" type="text" name="username" class="form-control @error('username') is-invalid border-danger @enderror" placeholder="{{ __('username') }}">
                    <label for="username">{{ __('username') }} {{ __('(Public - Visable To Others)') }}</label>
                </div>
                @error('username')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="form-floating input-field mb-3">
                    <input value="{{ old('email', request('email')) }}" type="email" name="email" class="form-control @error('email') is-invalid border-danger @enderror" placeholder="{{ __('email_address') }}">
                    <label for="username">{{ __('email_address') }}</label>
                </div>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="form-floating input-group mb-3">
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid border-danger @enderror" placeholder="{{ __('password') }}">
                     <label for="password">{{ __('password') }}</label>
                    <span class="input-group-text icon icon--eye {{ $errors->has('password') ? 'height-45' : '' }}"
                        onclick="showPassword('password',this)">
                        <x-svg.eye-icon />
                    </span>
                </div>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="form-floating input-group mb-3">
                    <input type="password" name="password_confirmation" id="cpassword" class="form-control @error('password_confirmation') is-invalid border-danger @enderror" placeholder="{{ __('confirm_password') }}">
                    <label for="password_confirmation">{{ __('confirm_password') }}</label>
                    <span class="input-group-text icon icon--eye {{ $errors->has('password_confirmation') ? 'height-45' : '' }}"
                        onclick="showPassword('cpassword',this)">
                        <x-svg.eye-icon />
                    </span>
                </div>
                 @error('password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="registration-form__option m-0">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="checkme" required/>
                        <label class="form-check-label" for="checkme">
                            I've <span  style="text-transform: lowercase"> {{ __('read_tr') }} </span> <a
                                href="{{ route('frontend.privacy') }}">{{ __('privacy_policy') }}</a>
                                <span  style="text-transform: lowercase"> {{ __('and') }} </span>
                            <a href="{{ route('frontend.terms') }}">
                                {{ __('terms_conditions') }}
                            </a>
                        </label>
                    </div>
                </div>
                <div class="registration-form__option mt-2">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="receiveemail_label" value="1" name="receive_email" {{ old('receive_email') ? 'checked' : ''}}/>
                        <label class="form-check-label" for="receiveemail_label">
                            I <span  style="text-transform: lowercase"> {{ __('recive_email') }}. </span>
                        </label>
                    </div>
                </div>
                <button class="btn btn--lg w-100 registration-form__btns" type="submit">
                    {{ __('sign_up') }}
                </button>
                <p class="text--body-3 registration-form__redirect">{{ __('have_account') }} ? <a
                        href="{{ route('users.login') }}">{{ __('sign_in') }}</a></p>
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
