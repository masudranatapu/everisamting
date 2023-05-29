@extends('layouts.frontend.layout_one')

@section('title', __('sign_in'))

@section('meta')
    @php
    $data = metaData('login');
    @endphp

    <meta name="title" content="{{ $data->title }}">
    <meta name="description" content="{{ $data->description }}">

    <meta property="og:image" content="{{ $data->image_url }}" />
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="{{ $data->title }}">
    <meta property="og:url" content="{{ route('users.login') }}">
    <meta property="og:type" content="article">
    <meta property="og:description" content="{{ $data->description }}">

    <meta name=twitter:card content={{ $data->image_url }} />
    <meta name=twitter:site content="{{ config('app.name') }}" />
    <meta name=twitter:url content="{{ route('users.login') }}" />
    <meta name=twitter:title content="{{ $data->title }}" />
    <meta name=twitter:description content="{{ $data->description }}" />
    <meta name=twitter:image content="{{ $data->image_url }}" />
@endsection

@section('content')
    <!-- breedcrumb section start  -->
    <x-frontend.breedcrumb-component :background="$cms->dashboard_overview_background">
        {{ __('sign_in') }}
        <x-slot name="items">
            <li class="breedcrumb__page-item">
                <a class="breedcrumb__page-link text--body-3">{{ __('sign_in') }}</a>
            </li>
        </x-slot>
    </x-frontend.breedcrumb-component>
    <!-- breedcrumb section end  -->

    <!-- registration section start   -->
    <section class="section registration">
        <div class="container">
            <div class="row d-flex justify-content-center">

                {{-- Signup Content --}}
                <!-- <x-auth.content :verifiedusers="$verified_users" /> -->

                {{-- Signing Form --}}
                <x-auth.signin-form />
            </div>
        </div>
    </section>
    <!-- registration section  end    -->
@endsection

@section('frontend_script')
    <script src="{{ asset('frontend') }}/js/plugins/passwordType.js"></script>
@endsection
