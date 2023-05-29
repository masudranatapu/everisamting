@extends('layouts.frontend.layout_one')

@section('title', __('edit_ad'))

@section('content')
    <!-- breedcrumb section start  -->
    <x-frontend.breedcrumb-component :background="$cms->dashboard_post_ads_background">
        {{ __('overview') }}
        <x-slot name="items">
            <li class="breedcrumb__page-item">
                <a href="{{ route('frontend.dashboard') }}"
                    class="breedcrumb__page-link text--body-3">{{ __('dashboard') }}</a>
            </li>
            <li class="breedcrumb__page-item">
                <a class="breedcrumb__page-link text--body-3">/</a>
            </li>
            <li class="breedcrumb__page-item">
                <a class="breedcrumb__page-link text--body-3">{{ __('post_ads') }}</a>
            </li>
        </x-slot>
    </x-frontend.breedcrumb-component>
    <!-- breedcrumb section end  -->

    <!-- dashboard section start  -->
    <section class="section dashboard">
        <div class="container">
            <div class="row">
                <div class="col-xl-3">
                    @include('layouts.frontend.partials.dashboard-sidebar')
                </div>
                <div class="col-xl-9">
                    @livewire('edit-ad', ['ad' => $ad])
                </div>
            </div>
        </div>
    </section>
    <!-- dashboard section end  -->
@endsection

@section('frontend_style')
    @livewireStyles
    <link rel="manifest" href="{{ asset('frontend') }}/images/favicon_io/site.webmanifest" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="{{ asset('frontend') }}/js/plugins/css/intlTelInput.css" />
    <link rel="stylesheet" href="{{ asset('backend/css/select2.min.css') }}">
@endsection

@section('frontend_script')
    @livewireScripts
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="{{ asset('frontend') }}/js/plugins/bvselect.js"></script>
    <script src="{{ asset('frontend') }}/js/plugins/intlTelInput.min.js"></script>
    <script type="module" src="{{ asset('frontend') }}/main.js"></script>
    <script src="{{ asset('frontend') }}/js/app.js"></script>
    <script src="{{ asset('frontend') }}/js/pages/dashboard.js"></script>
    <script src="{{ asset('backend/js/select2.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.tag').select2({
                tags: true,
                tokenSeparators: [',', ' ']
            });
            $('.features').select2({
                tags: true,
                tokenSeparators: [',', ' ']
            });
        });
    </script>
@endsection
