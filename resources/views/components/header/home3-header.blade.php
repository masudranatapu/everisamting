<header class="header header--one header--home-three" id="sticky-menu">
    <div class="container navigation-bar">
        <div class="d-flex align-items-center ">
            <button class="toggle-icon  ">
                <span class="toggle-icon__bar"></span>
                <span class="toggle-icon__bar"></span>
                <span class="toggle-icon__bar"></span>
            </button>
            <!-- Brand Logo -->
            <a href="{{ route('frontend.index') }}" class="navigation-bar__logo d-none d-xl-block">
                <img height="48px" width="180" src="{{ $settings->logo2_image_url }}" alt="brand-logo" class="logo-white " />
                <img height="48px" width="180" src="{{ $settings->logo_image_url }}" alt="brand-logo" class="logo-dark">
            </a>
        </div>
        <div class="d-flex align-items-center">
            <a href="{{ route('frontend.index') }}" class="navigation-bar__logo d-block d-xl-none">
                <img src="{{ $settings->logo_image_url }}" alt="brand-logo" class="logo-dark">
            </a>
        </div>
        <!-- Menu -->
        @include('layouts.frontend.partials.menu')

        <!-- Action Buttons -->
        <div class="navigation-bar__buttons">
            @if (auth('user')->check())
            <a href="{{ route('frontend.dashboard') }}" class="user">
                <div class="user__img-wrapper">
                    <img src="{{ auth('user')->user()->image_url }}" style="width: 40px; height: 40px; border-radius: 50%" alt="User Image">
                </div>
            </a>
            <a href="{{ route('frontend.post') }}" class="btn">
                <span class="icon--left">
                   <x-svg.image-select-icon />
                </span>
                {{ __('post_ads') }}
            </a>
            @else
            <a href="{{ route('users.login') }}" class="btn tg">
                <span class="icon--left">
                    <x-svg.user-login-icon />
                </span>
                {{ __('login') }} / {{ __('register') }}
            </a>
            <a href="{{ route('users.login') }}" class="btn">
                <span class="icon--left">
                    <x-svg.image-select-icon />
                </span>
                {{ __('post_ads') }}
            </a>

            @endif

            <x-frontend.language-switcher/>
        </div>
        <!-- Responsive Navigation Menu -->
        <x-frontend.responsive-menu/>
    </div>
</header>
