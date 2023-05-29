@extends('layouts.frontend.layout_one')

@section('title', __('contact'))

@section('meta')
    @php
    $data = metaData('contact');
    @endphp

    <meta name="title" content="{{ $data->title }}">
    <meta name="description" content="{{ $data->description }}">

    <meta property="og:image" content="{{ $data->image_url }}" />
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="{{ $data->title }}">
    <meta property="og:url" content="{{ route('frontend.contact') }}">
    <meta property="og:type" content="article">
    <meta property="og:description" content="{{ $data->description }}">

    <meta name=twitter:card content={{ $data->image_url }} />
    <meta name=twitter:site content="{{ config('app.name') }}" />
    <meta name=twitter:url content="{{ route('frontend.contact') }}" />
    <meta name=twitter:title content="{{ $data->title }}" />
    <meta name=twitter:description content="{{ $data->description }}" />
    <meta name=twitter:image content="{{ $data->image_url }}" />
@endsection

@section('content')
    <!-- breedcrumb section start  -->
    <x-frontend.breedcrumb-component :background="$cms->contact_background">
        {{ __('contact') }}
        <x-slot name="items">
            <li class="breedcrumb__page-item">
                <a href="#" class="breedcrumb__page-link text--body-3">{{ __('contact') }}</a>
            </li>
        </x-slot>
    </x-frontend.breedcrumb-component>
    <!-- breedcrumb section end  -->

    <!-- Contact section start  -->
    @livewire('contact-component')
    <!-- Contact section end -->

    <!-- <div class="map">
        {!! $settings->map_address !!}
    </div> -->
@endsection

@section('adlisting_style') @livewireStyles @endsection
@section('frontend_script') @livewireScripts @endsection
