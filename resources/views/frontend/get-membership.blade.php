@extends('layouts.frontend.layout_one')

@section('title', __('get_membership'))

@section('content')
    <!-- breedcrumb section start  -->
    <x-frontend.breedcrumb-component :background="$cms->get_membership_background">
        {{ __('get_membership') }}
        <x-slot name="items">
            <li class="breedcrumb__page-item">
                <a class="breedcrumb__page-link text--body-3">{{ __('get_membership') }}</a>
            </li>
        </x-slot>
    </x-frontend.breedcrumb-component>
    <!-- breedcrumb section end  -->
    <section class="section about">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 order-lg-0 order-2">
                    <h2 class="about__title text--display-3">{{ __('get_membership') }}</h2>
                    <p class="about__brief text--body-2">
                        {{ __('get_membership_description') }}
                    </p>

                    <a href="#" class="btn btn--lg">
                        {{ __('get_membership') }}
                        <span class="icon--right">
                            <x-svg.right-arrow-icon />
                        </span>
                    </a>
                </div>
                <div class="col-lg-5 order-lg-0 order-1">
                    <div class="about__img-wrapper">
                        <img src="{{ asset('frontend') }}/images/bg/membership.png" alt="membership">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section benefits bgcolor--gray-10">
        <div class="container">
            <h2 class="text--heading-1 section__title">{{ __('benefits_and_feature_membership') }}</h2>
            <div class="row">
                <div class="col-xl-6">
                    <div class="membership-card">
                        <div class="membership-card__icon">
                            <x-svg.star2-icon />
                        </div>
                        <div class="membership-card__info">
                            <h2 class="membership-card__title text--body-1">{{ __('special_badges_for_your_ads') }}</h2>
                            <p class="membership-card__description">{{ __('special_badges_for_your_ads_description') }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="membership-card">
                        <div class="membership-card__icon">
                            <x-svg.support-icon />
                        </div>
                        <div class="membership-card__info">
                            <h2 class="membership-card__title text--body-1">{{ __('dedicated_customer_support') }}</h2>
                            <p class="membership-card__description">{{ __('dedicated_customer_support_description') }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="membership-card">
                        <div class="membership-card__icon">
                            <x-svg.ad-icon />
                        </div>
                        <div class="membership-card__info">
                            <h2 class="membership-card__title text--body-1">{{ __('advertise_your_brand_on_adlisting') }}
                            </h2>
                            <p class="membership-card__description">
                                {{ __('advertise_your_brand_on_adlisting_description') }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="membership-card">
                        <div class="membership-card__icon">
                            <x-svg.image-icon />
                        </div>
                        <div class="membership-card__info">
                            <h2 class="membership-card__title text--body-1">{{ __('add_video_and_more_images') }}</h2>
                            <p class="membership-card__description">
                                {{ __('add_video_and_more_images_description') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- price-plan section start  -->
    <section class="section price-plan">
        <div class="container">
            <h2 class="price-plan__title text--heading-1">{{ __('get_membership_right_now') }}</h2>
            <p class="price-plan__brief text--body-3">{{ __('get_membership_right_now_description') }}</p>
            <div class="tab-content" id="nav-tabContent">
                <!-- Monthly -->
                <div class="tab-pane fade show active" id="nav-monthly" role="tabpanel" aria-labelledby="nav-monthly-tab">
                    <div class="row">
                        @foreach ($plans as $plan)
                            <x-others.single-plan :plan="$plan" />
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- price-plan section end  -->

    <section class="section service pt-0 text-center">
        <div class="container">
            <h2 class="service__title text--heading-1">{{ __('get_customer_services') }}</h2>
            <p class="service__brief text--body-3">{{ __('get_customer_services_description') }}</p>

            <div class="contact-info">
                <div class="contact-info__item">
                    <div class="contact-info__icon text--body-4">
                        <span class="icon">
                            <x-svg.call-icon />
                        </span>
                        {{ __('call_us') }}
                    </div>
                    <h2 class="text--body-3">{{ $settings->phone }}</h2>
                </div>
                <div class="contact-info__item">
                    <div class="contact-info__icon text--body-4">
                        <span class="icon">
                            <x-svg.mail-icon />
                        </span>
                        {{ __('email_us') }}
                    </div>
                    <h2 class="text--body-3"> {{ $settings->email }} </h2>
                </div>
            </div>
        </div>
    </section>
@endsection
