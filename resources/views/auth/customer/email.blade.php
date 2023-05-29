@extends('layouts.frontend.layout_one')

@section('title', __('forget_password'))

@section('content')
    <!-- breedcrumb section start  -->
    <x-frontend.breedcrumb-component :background="$cms->default_background">
        {{ __('forget_password') }}
        <x-slot name="items">
            <li class="breedcrumb__page-item">
                <a class="breedcrumb__page-link text--body-3">{{ __('forget_password') }}</a>
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
                        <h2 class="text-center text--heading-1 registration-form__title">{{ __('forget_password') }}</h2>
                        <div class="registration-form__wrapper">

                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('customer.password.email') }}">
                                @csrf

                                <div class="form-floating mb-3">
                                    <input value="{{ old('email') }}" type="email" id="email" name="email" class="form-control @error('email') is-invalid border-danger @enderror" placeholder="{{ __('email_address') }}">
                                    <label for="email">{{ __('email_address') }}</label>
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                                

                                <button class="btn btn--lg w-100 registration-form__btns" type="submit">
                                    {{ __('send_password_reset_link') }}
                                    <!-- <span class="icon--right">
                                        <x-svg.right-arrow-icon stroke="#fff" />
                                    </span> -->
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
