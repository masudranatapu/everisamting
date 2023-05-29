<header class="header header--home-three header--four">
    <div class="container navigation-bar">
        <div class="d-flex align-items-center ">
            <button class="toggle-icon  ">
                <span class="toggle-icon__bar"></span>
                <span class="toggle-icon__bar"></span>
                <span class="toggle-icon__bar"></span>
            </button>
            <!-- Brand Logo -->
            <a href="{{ route('frontend.index') }}" class="navigation-bar__logo d-none d-xl-block">
                <img src="{{ $settings->logo_image_url }}" alt="brand-logo" class="logo-dark">
            </a>
        </div>
        <div class="d-flex align-items-center">
            <a href="{{ route('frontend.index') }}" class="navigation-bar__logo d-block d-xl-none">
                <img src="{{ $settings->logo_image_url }}" alt="brand-logo" class="logo-dark">
            </a>
        </div>
        <!-- Menu -->
        <ul class="menu">
            <li class="menu__item">
                <a href="{{ route('frontend.index') }}" class="menu__link">{{ __('home') }}</a>
            </li>
            <li class="menu__item">
                <a href="{{ route('frontend.event') }}" class="menu__link">{{ __('events') }}</a>
            </li>
            <li class="menu__item">
                <a href="{{ route('frontend.adlist') }}" class="menu__link">{{ __('ads') }}</a>
            </li>
            @if ($blog_enable)
                <li class="menu__item">
                    <a href="{{ route('frontend.blog') }}" class="menu__link">{{ __('blog') }}</a>
                </li>
            @endif
            <li class="menu__item">
                <a href="{{ route('frontend.sellers') }}" class="menu__link">{{ __('sellers') }}</a>
            </li>
            @if ($priceplan_enable)
                <li class="menu__item">
                    <a href="{{ route('frontend.priceplan') }}" class="menu__link">{{ __('pricing') }}</a>
                </li>
            @endif
            <li class="menu__item">
                <a href="{{ route('frontend.business.directories') }}" class="menu__link">{{ __('directories') }}</a>
            </li>
        </ul>
        <!-- Action Buttons -->
        <div class="navigation-bar__buttons">
            @if (auth('user')->check())
                @php
                    $user_plan = DB::table('user_plans')->where('user_id', auth('user')->id())->first();
                @endphp
                <a href="{{ route('frontend.dashboard') }}" class="user position-relative">
                    <div class="user__img-wrapper ">
                        <img src="{{ auth('user')->user()->image_url }}" style="width: 40px; height: 40px; border-radius: 50%" alt="User Image">
                    </div>
                </a>
                @if ($user_plan->ad_limit == 0 || (isset($user_plan->expired_date) && $user_plan->expired_date < now()->format('Y-m-d')))
                    <a href="{{ route('frontend.dashboard') }}" class="btn">
                        <span class="icon--left">
                            <x-svg.image-select-icon />
                        </span>
                        {{ __('post_ads') }}
                    </a>
                @else
                    <a href="{{ route('frontend.post') }}" class="btn">
                        <span class="icon--left">
                            <x-svg.image-select-icon />
                        </span>
                        {{ __('post_ads') }}
                    </a>
                @endif
            @else
                <a href="{{ route('users.login') }}" class="btn btn--bg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="bevel"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    {{ __('sign_in') }}
                </a>
                <a href="{{ route('users.login') }}" class="btn">
                    <span class="icon--left">
                        <x-svg.image-select-icon />
                    </span>
                    {{ __('post_ads') }}
                </a>
            @endif

            <div class="d-none d-xl-block">
                <x-frontend.language-switcher />
            </div>

        </div>
        <!-- Responsive Navigation Menu  -->
        <x-frontend.responsive-menu />
    </div>
</header>
