<!DOCTYPE html>
<html lang="{{ app()->getLocale() ?? 'en' }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @if( env('APP_MODE') == 'DEVELOPMENT')
    <meta name="robots" content="noindex">
    @endif
    <meta name="robots" content="index,follow">
    <meta name="googlebot" content="index,follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        .category-menu__subdropdown__item {
            width: 310px !important;
        }

        .navigation-bar__buttons .user {
            margin: 0px 24px;
        }

        a.categories__link.active {
            color: #000 !important;
            transition: all 0.3s linear;
            font-weight: 800;
        }

        .subscribe__input-group.is-invalid {
            border: 1px solid red;
        }

        .margin-t-30px {
            margin-top: 30px;
        }

        .error-message-span {
            display: block;
            padding-left: 20px;
            padding-bottom: 10px;
        }

    </style>

    @stack('css')

    {!! $settings->header_css !!}
    {!! $settings->header_script !!}
    <link rel="stylesheet" href="{{ asset('frontend/css') }}/main.css?v=1">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    {{--
    <link rel="stylesheet" href="{{ asset('frontend/css/site.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('frontend/css/richtext.min.css') }}">
    <!-- Google tag (gtag.js) -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1763582500265093"
        crossorigin="anonymous"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-5WF93QH3HZ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-5WF93QH3HZ');
    </script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7726620269995586"
    crossorigin="anonymous"></script>
</head>

<body
    class="{{ auth('user')->check() && isset(session('user_plan')->ad_limit) && session('user_plan')->ad_limit < $settings->free_ad_limit ? '' : '' }}"
    dir="{{ langDirection() }}">
    @php $current_route_name=request()->route()->getName(); //

    $auth_user_gloabl = Auth::user()->id ?? ''; //
    @endphp

    <!-- Top bar start  -->
    @if (auth('user')->check() &&
    isset(session('user_plan')->ad_limit) &&
    session('user_plan')->ad_limit < $settings->free_ad_limit)
        @include('layouts.frontend.partials.top-bar')
        @endif
        <!-- Top bar end  -->

        <!-- loader start  -->
        @if (setting('website_loader'))
        @include('layouts.frontend.partials.loader')
        @endif
        <!-- loader end  -->

        @if (request()->route()->getName() === 'frontend.index')
        <x-header.home-header />
        @else
        <x-header.main-header />
        @endif

        @yield('content')

        <!-- footer section start  -->
        <x-footer.footer-top />
        <!-- footer section end -->

        <!-- Back To Top Btn Start-->
        @include('layouts.frontend.partials.back-to-top')
        <!-- Back To Top Btn End-->

        <!-- Scripts goes here -->
        @include('layouts.frontend.partials.scripts')
        @yield('srcipts')
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // toast config
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "hideMethod": "fadeOut"
        }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {
            $('#summernote').summernote({
                height: 200,
            });
        });

        </script>
@include('layouts.firebase_script');

</body>

</html>
