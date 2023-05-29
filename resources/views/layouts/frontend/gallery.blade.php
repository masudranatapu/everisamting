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

    <title>@yield('title') - {{ env('APP_NAME') }}</title>

    <!-- Favicons -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset($settings->favicon_image) }}" />
    <link rel="manifest" href="{{ asset('frontend/images/favicon_io/site.webmanifest') }}" />

    {{-- Custom header css & script --}}
    @yield('adlisting_style')
    @yield('frontend_style')

    {!! $settings->header_css !!}
    {!! $settings->header_script !!}
    <link rel="stylesheet" href="{{ asset('frontend/css') }}/main.css?v=2">
</head>

<body class="overlay-view">

    @yield('content')

    <!-- Scripts goes here -->
    <script src="{{ asset('frontend') }}/js/plugins/jquery.min.js"></script>

    {{-- Custom footer script --}}
    @yield('frontend_script')
    {!! $settings->body_script !!}
    <script type="module" src="{{ asset('frontend') }}/js/plugins/app.js"></script>

</body>

</html>
