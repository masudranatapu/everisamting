<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @hasSection('meta')
    @yield('meta')
    @else
    <meta name="title" content="{{ $settings->seo__meta_title }}">
    <meta name="description" content="{{ $settings->seo_meta_description }}">
    <meta name="keywords" content="{{ $settings->seo_meta_keywords }}">
    @endif

    <title>@yield('title') - {{ config('app.name') }}</title>

    <!-- Styles goes here -->
    @include('layouts.frontend.partials.links')
    <style>
        .navigation-bar__logo {
            margin-right: 32px;
        }

        .navigation-bar .menu {
            margin-left: 32px;
        }

        .navigation-bar__buttons .user {
            margin: 0px 24px;
        }

        .search.search-no-borders {
            border: none;
        }
    </style>

    {!! $settings->header_css !!}
    {!! $settings->header_script !!}
    <link rel="stylesheet" href="{{ asset('frontend/css') }}/main.css?v=1">
</head>

<body class="{{ auth('user')->check() && isset(session('user_plan')->ad_limit) && session('user_plan')->ad_limit < $settings->free_ad_limit ? 'wraning-show_hide':'' }}" dir="{{ langDirection() }}">
    <!-- Top bar start  -->
    @if (auth('user')->check() && isset(session('user_plan')->ad_limit) && session('user_plan')->ad_limit < $settings->free_ad_limit)
        @include('layouts.frontend.partials.top-bar')
    @endif

    <!-- loader start  -->
    @if (setting('website_loader'))
        @include('layouts.frontend.partials.loader')
    @endif
    <!-- loader end  -->

    <!-- Top bar end  -->
    <x-header.home3-header />

    @yield('content')

    <!-- footer section start  -->
    <x-footer.footer-top />
    <!-- footer section end -->

    <!-- Back To Top Btn Start-->
    @include('layouts.frontend.partials.back-to-top')
    <!-- Back To Top Btn End-->

    <!-- Scripts goes here -->
    @include('layouts.frontend.partials.scripts')
</body>

</html>
