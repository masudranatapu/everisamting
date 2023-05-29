<div class="">
    <div class="review-text-title">{{ __('you_dont_have_account') }}</div>
    <div class="review-text-decription">
        {{ __('first_create_a_account_to_write_down_a_review_to_seller_accoount') }}
    </div>
    <div class="mt-24">
        <form action="{{ route('frontend.pre.signup') }}" class="d-flex-custom" method="post">
            @csrf
            <input name="email" type="email" placeholder="Email Address" id="email"
                class="form-control-input @error('email') border-danger @enderror" autocomplete="false" required>
            <button class="review-login-submit-button ml-12" type="submit">
                <div class="btn-text gap-2">
                    {{ Str::replace(' ', '', __('sign_up')) }}
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.75 12H20.25" stroke="white" stroke-width="1.6" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M13.5 5.25L20.25 12L13.5 18.75" stroke="white" stroke-width="1.6"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
            </button>
        </form>
        @error('email')
            <span class="invalid-feedback d-block">{{ $message }}</span>
        @enderror
    </div>
    @if (config('zakirsoft.google_active') || config('zakirsoft.linkedin_active') || config('zakirsoft.facebook_active') || config('zakirsoft.twitter_active') || config('zakirsoft.github_active') || config('zakirsoft.gitlab_active') || config('zakirsoft.bitbucket_active'))
        <div class="mt-24 d-flex-custom flex-wrap align-items-center">
            <div class="or-text">{{ __('or_sign_up_with') }}</div>
            @if (config('zakirsoft.google_active') && config('zakirsoft.google_id') && config('zakirsoft.google_secret'))
                <a href="/auth/google/redirect" class="ml-16 mt-2-custom mb-2">
                    <button type="button" class="google-btn">
                        <x-svg.google-icon />
                        <span class="button-text">Google</span>
                    </button>
                </a>
            @endif
            @if (config('zakirsoft.facebook_active') && config('zakirsoft.facebook_id') && config('zakirsoft.facebook_secret'))
                <a href="/auth/facebook/redirect" class="ml-16 mt-2-custom mb-2">
                    <button type="button" class="google-btn">
                        <x-svg.facebook-icon />
                        <span class="button-text">Facebook</span>
                    </button>
                </a>
            @endif
            @if (config('zakirsoft.twitter_active') && config('zakirsoft.twitter_id') && config('zakirsoft.twitter_secret'))
                <a href="/auth/twitter/redirect" class="ml-16 mt-2-custom mb-2">
                    <button type="button" class="google-btn">
                        <x-svg.twitter-icon fill="#03A9F4" />
                        <span class="button-text">Twitter</span>
                    </button>
                </a>
            @endif
            @if (config('zakirsoft.github_active') && config('zakirsoft.github_id') && config('zakirsoft.github_secret'))
                <a href="/auth/github/redirect" class="ml-16 mt-2-custom mb-2">
                    <button type="button" class="google-btn">
                        <x-svg.github-icon />
                        <span class="button-text">Github</span>
                    </button>
                </a>
            @endif
            @if (config('zakirsoft.gitlab_active') && config('zakirsoft.gitlab_id') && config('zakirsoft.gitlab_secret'))
                <a href="/auth/gitlab/redirect" class="ml-16 mt-2-custom mb-2">
                    <button type="button" class="google-btn">
                        <x-svg.gitlab-icon />
                        <span class="button-text">Gitlab</span>
                    </button>
                </a>
            @endif
            @if (config('zakirsoft.bitbucket_active') && config('zakirsoft.bitbucket_id') && config('zakirsoft.bitbucket_secret'))
                <a href="/auth/bitbucket/redirect" class="ml-16 mt-2-custom mb-2">
                    <button type="button" class="google-btn">
                        <x-svg.bitbucket-icon />
                        <span class="button-text">Bitbucket</span>
                    </button>
                </a>
            @endif
        </div>
    @endif
</div>

@push('component_style')
    <style>
        .review-text-title {
            font-family: 'Nunito';
            font-style: normal;
            font-weight: 600;
            font-size: 20px;
            line-height: 32px;
            color: #191F33;
            flex: none;
            order: 0;
            flex-grow: 0;
        }

        .review-text-decription {
            max-width: 400px;
            height: 40px;
            font-family: 'Nunito';
            font-style: normal;
            font-weight: 400;
            font-size: 14px;
            line-height: 1.43;
            color: #636A80;
            flex: none;
            order: 0;
            flex-grow: 0;
        }

        .d-flex-custom {
            display: flex;
        }

        @media (max-width:450px) {
            .review-text-decription {
                max-width: 300px;
                height: 30px;
            }
        }

        @media (max-width:310px) {
            .review-text-decription {
                max-width: 200px;
                height: 30px;
            }
        }

        @media (max-width:770px) {

            .d-flex-custom {
                display: block;
            }

            .ml-12 {
                margin-top: 6px;
                margin-left: 0 !important;
            }

            .form-control-input {
                margin-top: 0 !important;
            }
        }

        .form-control-input {
            padding: 18px 18px;
            box-sizing: border-box;
            width: 400px;
            max-width: 400px;
            height: 50px;
            background: #FFFFFF !important;
            border: 1px solid #EDEFF5 !important;
            border-radius: 5px;
            flex: none;
            order: 0;
            flex-grow: 0;
        }

        @media (max-width:400px) {

            .form-control-input {
                margin-top: 24px !important;
            }
        }

        @media (max-width:450px) {

            .mt-2-custom {
                margin-top: 6px !important;
            }
        }

        @media (max-width:450px) {

            .form-control-input {
                width: 100%;
                max-width: 300px;
                height: 50px;
                margin-top: 24px !important;
            }
        }

        @media (max-width:310px) {

            .form-control-input {
                max-width: 200px;
                height: 50px;
                margin-top: 24px !important;
            }
        }

        .form-control-input::placeholder {
            left: 18px;
            top: calc(50% - 24px/2);
            font-family: 'Nunito';
            font-style: normal;
            font-weight: 400;
            font-size: 16px;
            line-height: 24px;
            color: #939AAD !important;
        }

        .mt-24 {
            margin-top: 24px;
        }

        .ml-12 {
            margin-left: 12px;
        }

        .ml-16 {
            margin-left: 16px;
        }

        .review-login-submit-button {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            padding: 0px 20px;
            gap: 8px;
            width: 124px;
            height: 50px;
            background: #00AAFF;
            border-radius: 4px;
            flex: none;
            order: 1;
            flex-grow: 0;
        }

        .btn-text {
            font-family: 'Nunito Sans';
            font-style: normal;
            font-weight: 700;
            font-size: 16px;
            line-height: 50px;
            display: flex;
            align-items: center;
            text-align: center;
            text-transform: capitalize;
            color: #FFFFFF;
        }

        .or-text {
            font-family: 'Nunito';
            font-style: normal;
            font-weight: 600;
            font-size: 12px;
            line-height: 16px;
            color: #767E94;
        }

        @media (max-width:770px) {

            .or-text {
                text-align: center !important;
                margin-bottom: 12px;
            }
        }

        .google-btn {
            box-sizing: border-box;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;

            gap: 16px;
            width: 136px;
            height: 48px;
            background: #FFFFFF;
            border: 1px solid #EBEEF7;
            border-radius: 6px;
        }

        .google-btn:hover .button-text {
            color: #191F33 !important;
        }

        .button-text {
            font-family: 'Nunito';
            font-style: normal;
            font-weight: 400;
            font-size: 16px;
            line-height: 24px;
            color: #464D61;
        }
    </style>
@endpush
