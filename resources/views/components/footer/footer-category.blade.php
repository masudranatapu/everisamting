<div class="col-xl-4 col-lg-7 col-md-6">
    <h2 class="footer__title text--body-2-600">{{ __('newsletter') }}</h2>


    <form action="{{ route('newsletter.subscribe') }}" method="POST">
        @csrf
        <div class="input-group">
            <input type="email" class="form-control" placeholder="{{ __('email_address') }}" name="email" id="email" required />
            <button class="btn" class="input-type-text" type="submit">{{ __('subscribe') }}</button>
        </div>
        {{-- <span class="error" style="color:red"></span> --}}
    </form>

    <div class="footer__mobile-app mt-3">
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


  <!--   <ul class="footer-menu">
        @foreach ($top_categories as $category)
        <li class="footer-menu__item">
            <a href="{{ route('frontend.adlist.category.show', $category->slug) }}" class="footer-menu__link text--body-3"> {{ $category->name }} </a>
        </li>
        @endforeach
    </ul> -->
</div>
