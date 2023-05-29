<div class="col-xl-4 col-lg-4">
    @if ($mobile_setting->ios_download_url || $mobile_setting->android_download_url)
        <h2 class="footer__title text--body-2-600">{{ __('download_our_app') }}</h2>
    @endif
    <div class="footer__mobile-app">
        @if ($mobile_setting->android_download_url)
            <a target="_blank" href="{{ asset($mobile_setting->android_download_url) }}" class="app">
                <div class="app-logo">
                    <x-svg.google-play-icon />
                </div>
                <div class="app-info">
                    <h5 class="text--body-5">{{ __('get_it_now') }}</h5>
                    <h2 class="text--body-3-600">{{ __('google_play') }}</h2>
                </div>
            </a>
        @endif

        @if ($mobile_setting->ios_download_url)
            <a target="_blank" href="{{ asset($mobile_setting->ios_download_url) }}" class="app">
                <div class="app-logo">
                    <x-svg.apple-icon />
                </div>
                <div class="app-info">
                    <h5 class="text--body-5">{{ __('get_it_now') }}</h5>
                    <h2 class="text--body-3-600">{{ __('app_store') }}</h2>
                </div>
            </a>
        @endif
    </div>
    
</div>
