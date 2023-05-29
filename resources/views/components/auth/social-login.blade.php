@if (config('zakirsoft.google_active') || config('zakirsoft.linkedin_active'))
    <div class="registration-form__sign-btns">
        @if (config('zakirsoft.google_active') && config('zakirsoft.google_id') && config('zakirsoft.google_secret'))
            <a href="/auth/google/redirect" class="btn-sign">
                <span class="icon">
                    <x-svg.google-icon />
                </span>
                {{ __('sign_in_with_google') }}
            </a>
        @endif
        @if (config('zakirsoft.linkedin_active') && config('zakirsoft.linkedin_id') && config('zakirsoft.linkedin_secret'))
            <a href="/auth/linkedin/redirect" class="btn-sign">
                <span class="icon ">
                    <x-svg.linkedin-icon fill="#0288d1" />
                </span>
                {{ __('sign_in_with_linkedin') }}
            </a>
        @endif
    </div>
@endif

@if (config('zakirsoft.facebook_active') || config('zakirsoft.twitter_active'))
    <div class="registration-form__sign-btns">
        @if (config('zakirsoft.facebook_active') && config('zakirsoft.facebook_id') && config('zakirsoft.facebook_secret'))
            <a href="{{ route('social.login', 'facebook') }}" class="btn-sign">
                <span class="icon">
                    <x-svg.facebook-icon />
                </span>
                {{ __('sign_in_with_facebook') }}
            </a>
        @endif
        @if (config('zakirsoft.twitter_active') && config('zakirsoft.twitter_id') && config('zakirsoft.twitter_secret'))
            <a href="/auth/twitter/redirect" class="btn-sign">
                <span class="icon">
                    <x-svg.twitter-icon fill="#03A9F4" />
                </span>
                {{ __('sign_in_with_twitter') }}
            </a>
        @endif
    </div>
@endif

@if (config('zakirsoft.github_active') || config('zakirsoft.gitlab_active'))
    <div class="registration-form__sign-btns">
        @if (config('zakirsoft.github_active') && config('zakirsoft.github_id') && config('zakirsoft.github_secret'))
            <a href="/auth/github/redirect" class="btn-sign">
                <span class="icon">
                    <x-svg.github-icon />
                </span>
                {{ __('sign_in_with_github') }}
            </a>
        @endif
        @if (config('zakirsoft.gitlab_active') && config('zakirsoft.gitlab_id') && config('zakirsoft.gitlab_secret'))
            <a href="/auth/gitlab/redirect" class="btn-sign">
                <span class="icon ">
                    <x-svg.gitlab-icon />
                </span>
                {{ __('sign_in_with_gitlab') }}
            </a>
        @endif
    </div>
@endif

@if (config('zakirsoft.bitbucket_active') && config('zakirsoft.bitbucket_id') && config('zakirsoft.bitbucket_secret'))
    <div class="registration-form__sign-btns">
        <a href="/auth/bitbucket/redirect" class="btn-sign">
            <span class="icon">
                <x-svg.bitbucket-icon />
            </span>
            {{ __('sign_in_with_bitbucket') }}
        </a>
    </div>
@endif

@if (config('zakirsoft.google_active') || config('zakirsoft.linkedin_active') || config('zakirsoft.facebook_active') || config('zakirsoft.twitter_active') || config('zakirsoft.github_active') || config('zakirsoft.gitlab_active') || config('zakirsoft.bitbucket_active'))
    <h2 class="registration-form__alternative-title text--body-3">{{ __('or_sign_in_with_email') }}</h2>
@endif
