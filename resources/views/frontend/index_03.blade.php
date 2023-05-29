@extends('layouts.frontend.layout_three')

@section('title', __('home'))

@section('frontend_style')
    <link rel="stylesheet" href="{{ asset('frontend/css') }}/select2.min.css" />
    <link rel="stylesheet" href="{{ asset('frontend/css') }}/select2-bootstrap-5-theme.css" />
    <link rel="stylesheet" href="{{ asset('frontend/css') }}/slick.css" />

    @if (auth('user')->check() && isset(session('user_plan')->ad_limit) && session('user_plan')->ad_limit < $settings->free_ad_limit)
        <style>
            .header--one {
                top: 50px !important;
            }

            .header--fixed {
                top: 0 !important;
            }
        </style>
    @endif
@endsection

@section('content')
    <!-- Banner section start  -->
    <div class="banner banner--three" style="background:url('') center center/cover no-repeat;">
        <div class="container">
            <span class="banner__tag text--body-2-600">{{ __('over') }} {{ $totalAds }} {{ __('live_ads') }}</span>
            <div class="banner__title text--display-2 animate__animated animate__bounceInDown">
                TItle
            </div>
            <!-- Search Box -->
            <x-frontend.adlist-search class="adlist-search" :categories="$categories" :towns="11" :dark="true"
                :total-ads="$total_ads" />
        </div>
    </div>
    <!-- Banner section end   -->

    <!-- Poupular category Section start  -->
    <section class="section popular-category">
        <div class="container">
            <h2 class="text--heading-1 section__title">{{ __('popular_category') }}</h2>
            <div class="row">
                @foreach ($topCategories as $category)
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="category-card">
                            <div class="category-card__icon">
                                <i class="{{ $category->icon }}" style="font-size: 40px"></i>
                            </div>
                            {{-- Filter Form --}}
                            <form method="GET" action="{{ route('frontend.adlist.search') }}" id="adFilterForm"
                                class="d-none">
                                <input type="hidden" name="category" value="" id="adFilterInput">
                            </form>
                            <a href="javascript:void(0)" onclick="adFilterFunction('{{ $category->slug }}')">
                                <h5 class="text--body-2 category-card__title"> {{ $category->name }} </h5>
                            </a>
                            <div class="category-card__view">
                                <span class="first view-number"> {{ $category->ad_count ?? 0 }}
                                    {{ __('ads') }}</span>
                                <a href="javascript:void(0)" onclick="adFilterFunction('{{ $category->slug }}')"
                                    class="second view-btn">
                                    {{ __('view_ads') }}
                                    <span class="icon">
                                        <x-svg.right-arrow-icon stroke="#00AAFF" />
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Poupular category Section end  -->

    <!-- featured post Section start  -->
    @if ($settings->featured_ads_homepage)
        <section class="section recent-post">
            <div class="container">
                <h2 class="text--heading-1 section__title">{{ __('featured_ads') }}</h2>
                <div class="row">
                    @foreach ($featuredAds as $ad)
                        <x-frontend.single-ad :ad="$ad" className="col-xl-3 col-sm-6"></x-frontend.single-ad>
                    @endforeach
                </div>
                @if (count($featuredAds) > 0)
                    <div class="recent-post__btn">
                        <a href="{{ route('frontend.adlist') }}" class="btn">
                            {{ __('view_all') }}
                            <span class="icon--right">
                                <x-svg.right-arrow-icon />
                            </span>
                        </a>
                    </div>
                @endif
            </div>
        </section>
    @endif
    <!-- featured post Section end  -->

    <!-- recent post Section start  -->
    @if ($settings->regular_ads_homepage)
        <section class="section recent-post">
            <div class="container">
                <h2 class="text--heading-1 section__title">{{ __('regular_ads') }}</h2>
                <div class="row">
                    @foreach ($latestAds as $ad)
                        <x-frontend.single-ad :ad="$ad" className="col-xl-3 col-sm-6"></x-frontend.single-ad>
                    @endforeach
                </div>
                @if (count($latestAds) > 0)
                    <div class="recent-post__btn">
                        <a href="{{ route('frontend.adlist') }}" class="btn">
                            {{ __('view_all') }}
                            <span class="icon--right">
                                <x-svg.right-arrow-icon />
                            </span>
                        </a>
                    </div>
                @endif
            </div>
        </section>
    @endif
    <!-- recent post Section end  -->

    <!-- How to work Section start  -->
    <x-others.how-it-work />
    <!-- How to work Section end  -->

    {{-- <!-- popular-loc section start  -->
    <section class="section popular-location">
        <div class="container">
            <h2 class="text--heading-1 section__title">
                {{ __('popular_location') }}
            </h2>
            <div class="row">
                @foreach ($topCities as $city)
                    <div class="col-xl-3 col-md-6">
                        <x-frontend.location.single-popular-location :city="$city">
                        </x-frontend.location.single-popular-location>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- popular-loc section end --> --}}

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

    <!-- newsletter subscription  -->
    @if ($newsletter_enable)
        @include('layouts.frontend.partials.newsletter')
    @endif

@endsection


@section('frontend_script')
    <script src="{{ asset('frontend') }}/js/plugins/select2.min.js"></script>

    <script>
        function adFilterFunction(slug) {
            $('#adFilterInput').val(slug);
            $('#adFilterForm').submit();
        }
    </script>
    @stack('newslater_script')
@endsection
