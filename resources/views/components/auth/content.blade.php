<div class="col-lg-6 order-2 order-lg-0">
    <div class="registration__features">
        <div class="registration__features-item">
            <span class="icon">
                <img src="frontend/images/icon/chart.png" alt="chart" />
            </span>
            <div class="registration__features-info">
                <h2 class="text--body-2-600">{{ __('manage_your_ads') }}</h2>
                <p class="text--body-3">
                    {{ $cms->manage_ads_content }}
                </p>
            </div>
        </div>
        <div class="registration__features-item">
            <span class="icon">
                <img src="frontend/images/icon/chart-circle.png" alt="chart" />
            </span>
            <div class="registration__features-info">
                <h2 class="text--body-2-600">{{ __('chat_with_anyone_anytime') }}</h2>
                <p class="text--body-3">
                    {{ $cms->chat_content }}
                </p>
            </div>
        </div>
        <div class="registration__features-item">
            <span class="icon">
                <img src="frontend/images/icon/chart.png" alt="chart" />
            </span>
            <div class="registration__features-info">
                <h2 class="text--body-2-600">{{ $verifiedusers }} {{ __('verified_user') }}</h2>
                <p class="text--body-3">
                    {{ $cms->verified_user_content }}
                </p>
            </div>
        </div>
    </div>
</div>
