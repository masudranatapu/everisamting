@extends('layouts.frontend.layout_one')

@section('title', __('reset_password'))

@section('content')
    <!-- breedcrumb section start  -->
    <x-frontend.breedcrumb-component :background="$cms->default_background">
        {{ __('reset_password') }}
        <x-slot name="items">
            <li class="breedcrumb__page-item">
                <a class="breedcrumb__page-link text--body-3">{{ __('reset_password') }}</a>
            </li>
        </x-slot>
    </x-frontend.breedcrumb-component>
    <!-- breedcrumb section end  -->

    <!-- registration section start   -->
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 order-1 order-lg-0">
                    <div class="registration-form">
                        <h2 class="text-center text--heading-1 registration-form__title">{{ __('reset_password') }}</h2>
                        <div class="registration-form__wrapper">
                            <form method="POST" action="{{ route('customer.password.update') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="input-field d-none">
                                    <input type="email" placeholder="{{ __('email_address') }}" name="email"
                                        value="{{ request('email', '') }}"
                                        class="@error('email') is-invalid border-danger @enderror" />
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="input-field">
                                    <input type="password" placeholder="{{ __('new_password') }}" id="password"
                                        name="password" class="@error('password') is-invalid border-danger @enderror" />
                                    <span class="icon icon--eye" onclick="showPassword('password',this)">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                            @error('password') style="margin-top: -25px;" @enderror>
                                            <path d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12C23 12 19 20 12 20C5 20 1 12 1 12Z"
                                                stroke="#191F33" stroke-width="1.3" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path
                                                d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z"
                                                stroke="#191F33" stroke-width="1.3" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <span class="icon icon--success">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                            @error('password') style="margin-top: -25px;" @enderror>
                                            <rect width="20" height="20" rx="10" fill="#27C200" />
                                            <path d="M14 7L8.5 12.5L6 10" stroke="white" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    <span class="icon icon--alart">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                            @error('password') style="margin-top: -25px;" @enderror>
                                            <path
                                                d="M10.29 3.86L1.82002 18C1.64539 18.3024 1.55299 18.6453 1.55201 18.9945C1.55103 19.3437 1.64151 19.6871 1.81445 19.9905C1.98738 20.2939 2.23675 20.5467 2.53773 20.7239C2.83871 20.901 3.18082 20.9962 3.53002 21H20.47C20.8192 20.9962 21.1613 20.901 21.4623 20.7239C21.7633 20.5467 22.0127 20.2939 22.1856 19.9905C22.3585 19.6871 22.449 19.3437 22.448 18.9945C22.4471 18.6453 22.3547 18.3024 22.18 18L13.71 3.86C13.5318 3.56611 13.2807 3.32312 12.9812 3.15448C12.6817 2.98585 12.3438 2.89725 12 2.89725C11.6563 2.89725 11.3184 2.98585 11.0188 3.15448C10.7193 3.32312 10.4683 3.56611 10.29 3.86Z"
                                                fill="#FF4F4F" />
                                            <path d="M12 9V13" stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M12 17H12.01" stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </div>
                                <div class="input-field">
                                    <input type="password" placeholder="{{ __('confirm_password') }}"
                                        id="confirmPassword" name="password_confirmation"
                                        class="@error('password_confirmation') is-invalid border-danger @enderror" />
                                    <span class="icon icon--eye" onclick="showPassword('confirmPassword',this)">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                            @error('password_confirmation') style="margin-top: -25px;" @enderror>
                                            <path d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12C23 12 19 20 12 20C5 20 1 12 1 12Z"
                                                stroke="#191F33" stroke-width="1.3" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path
                                                d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z"
                                                stroke="#191F33" stroke-width="1.3" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    @error('password_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <span class="icon icon--success">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                            @error('password_confirmation') style="margin-top: -25px;" @enderror>
                                            <rect width="20" height="20" rx="10" fill="#27C200" />
                                            <path d="M14 7L8.5 12.5L6 10" stroke="white" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    <span class="icon icon--alart">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                            @error('password_confirmation') style="margin-top: -25px;" @enderror>
                                            <path
                                                d="M10.29 3.86L1.82002 18C1.64539 18.3024 1.55299 18.6453 1.55201 18.9945C1.55103 19.3437 1.64151 19.6871 1.81445 19.9905C1.98738 20.2939 2.23675 20.5467 2.53773 20.7239C2.83871 20.901 3.18082 20.9962 3.53002 21H20.47C20.8192 20.9962 21.1613 20.901 21.4623 20.7239C21.7633 20.5467 22.0127 20.2939 22.1856 19.9905C22.3585 19.6871 22.449 19.3437 22.448 18.9945C22.4471 18.6453 22.3547 18.3024 22.18 18L13.71 3.86C13.5318 3.56611 13.2807 3.32312 12.9812 3.15448C12.6817 2.98585 12.3438 2.89725 12 2.89725C11.6563 2.89725 11.3184 2.98585 11.0188 3.15448C10.7193 3.32312 10.4683 3.56611 10.29 3.86Z"
                                                fill="#FF4F4F" />
                                            <path d="M12 9V13" stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                            <path d="M12 17H12.01" stroke="white" stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </div>
                                <button class="btn btn--lg w-100 registration-form__btns" type="submit">
                                    {{ __('reset_password') }}
                                    <span class="icon--right">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3.75 12H20.25" stroke="white" stroke-width="1.6"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M13.5 5.25L20.25 12L13.5 18.75" stroke="white" stroke-width="1.6"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- registration section  end    -->
@endsection

@section('frontend_script')
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="{{ asset('frontend') }}/js/pages/reg.js"></script>
    <script type="module" src="{{ asset('frontend') }}/main.js"></script>
@endsection
