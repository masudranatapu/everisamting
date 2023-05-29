@extends('layouts.frontend.layout_one')

@section('title', __('price_and_plan'))

@section('meta')
    @php
    $data = metaData('pricing');
    @endphp

    <meta name="title" content="{{ $data->title }}">
    <meta name="description" content="{{ $data->description }}">

    <meta property="og:image" content="{{ $data->image_url }}" />
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="{{ $data->title }}">
    <meta property="og:url" content="{{ route('frontend.priceplan') }}">
    <meta property="og:type" content="article">
    <meta property="og:description" content="{{ $data->description }}">

    <meta name=twitter:card content={{ $data->image_url }} />
    <meta name=twitter:site content="{{ config('app.name') }}" />
    <meta name=twitter:url content="{{ route('frontend.priceplan') }}" />
    <meta name=twitter:title content="{{ $data->title }}" />
    <meta name=twitter:description content="{{ $data->description }}" />
    <meta name=twitter:image content="{{ $data->image_url }}" />
@endsection

@section('content')
    <!-- breedcrumb section start  -->
    <x-frontend.breedcrumb-component :background="$cms->pricing_plan_background">
        {{ __('price_plan') }}
        <x-slot name="items">
            <li class="breedcrumb__page-item">
                <a class="breedcrumb__page-link text--body-3">{{ __('price_plan') }}</a>
            </li>
        </x-slot>
    </x-frontend.breedcrumb-component>
    <!-- breedcrumb section end  -->

    <!-- price-plan section start  -->
    <section class="section price-plan">
        <div class="container">
            <h2 class="price-plan__title text--heading-1">{{ __('get_membership_right_now') }}</h2>
            <p class="price-plan__brief text--body-3">
                {{ $cms->membership_content }}
            </p>
            <div class="tab-content" id="nav-tabContent">
                <!-- Monthly -->
                <div class="tab-pane fade show active" id="nav-monthly" role="tabpanel" aria-labelledby="nav-monthly-tab">
                    <div class="row">
                        @forelse ($plans as $plan)
                            <x-others.single-plan :plan="$plan" />
                        @empty
                            <x-no-data-found />
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- price-plan section end  -->
@endsection

@section('frontend_script')
    <script type="module" src="{{ asset('frontend') }}/js/plugins/bvselect.js"></script>
@endsection
