<!-- Favicons -->
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset($settings->favicon_image) }}" />
<link rel="manifest" href="{{ asset('frontend/images/favicon_io/site.webmanifest') }}" />
<link rel="stylesheet" href="{{ asset('frontend/css') }}/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}" />
<link rel="stylesheet" href="{{ asset('backend') }}/plugins/flag-icon-css/css/flag-icon.min.css" />
{{-- toastr notification --}}
<link rel="stylesheet" href="{{ asset('backend') }}/plugins/toastr/toastr.min.css" />
<link rel="stylesheet" href="{{ asset('frontend/css/zakirsoft.css') }}" />
<link rel="stylesheet" href="{{ asset('frontend/css/rtl.css') }}" />
<link rel="stylesheet" href="{{ asset('frontend/css/sweet-alert.css') }}">
{{-- @include('layouts.frontend.partials.overwritecss') --}}

{{-- Custom header css & script --}}
@yield('adlisting_style')
@yield('frontend_style')
@stack('component_style')
