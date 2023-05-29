@extends('layouts.frontend.layout_one')

@section('content')
    <x-frontend.breedcrumb-component :background="$cms->default_background">
        {{ __('verification') }}
        <x-slot name="items">
            <li class="breedcrumb__page-item">
                <a class="breedcrumb__page-link text--body-3">{{ __('verification') }}</a>
            </li>
        </x-slot>
    </x-frontend.breedcrumb-component>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-5">
                    <div class="card-header">{{ __('verify_your_email_address') }}</div>

                    <div class="card-body text-center">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('a_fresh_verification_link_has_been_sent_to_your_email_address') }}
                            </div>
                        @endif

                        {{ __('before_proceeding_please_check_your_email_for_a_verification_link') }}
                        {{ __('if_you_did_not_receive_the_email') }},
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit"
                                    class="btn mt-3 align-baseline">{{ __('click_here_to_request_another') }}</button>
                        </form>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-sm btn-danger mt-3 align-baseline">{{ __('sign_out') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
