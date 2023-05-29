@extends('layouts.frontend.layout_two')

@section('title', __('home'))

@section('content')
    <!-- Banner section start  -->
    <section class="banner banner--one section" style="background: url('') center center/cover no-repeat;">
        <div class="container">
            <h2 class="text--display-2 text-center banner__title animate__animated animate__bounceInDown">
                {{ __('browse_over') }} {{ $totalAds }} {{ __('classified_ads_listing') }}
            </h2>

            <!-- Search Box -->
            <x-frontend.adlist-search class="adlist-search" :categories="$categories" :towns="$towns" :dark="false"
                :total-ads="$total_ads" />

            <!-- Slider main container -->
            <div class="banner__feature-slider banner__feature">
                <!-- Slides -->
                @foreach ($topCategories as $category)
                    <div class="banner__feature-item">
                        <div class="category-card">
                            <div class="category-card__icon">
                                <i class="{{ $category->icon }}" style="font-size: 55px"></i>
                            </div>
                            <h5 class="text--body-2 category-card__title">{{ $category->name }}</h5>
                            <div class="category-card__view">
                                <span class="first view-number">{{ $category->ad_count ?? 0 }}</span>
                                {{-- Filter Form --}}
                                <form method="GET" action="{{ route('frontend.adlist.search') }}" id="adFilterForm"
                                    class="d-none">
                                    <input type="hidden" name="category" value="" id="adFilterInput">
                                </form>
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
    <!-- Banner section end  -->

    <!-- work section start  -->
    <x-others.how-it-work />
    <!-- work section end -->
    <!-- feature section start  -->
    @if ($settings->featured_ads_homepage)
        <section class="section feature-ads">
            <div class="container">
                <h2 class="text--heading-1 section__title">
                    {{ __('featured_ads') }}
                </h2>
                <div class="row">
                    @foreach ($featuredAds as $ad)
                        <x-frontend.single-left-image-ad :ad="$ad" classList="col-lg-6">
                        </x-frontend.single-left-image-ad>
                    @endforeach
                </div>
                @if (count($featuredAds) > 0)
                    <div class="feature-ads__btn">
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
    <!-- feature section end -->

    <!-- regular section start  -->
    @if ($settings->regular_ads_homepage)
        <section class="section feature-ads">
            <div class="container">
                <h2 class="text--heading-1 section__title">
                    {{ __('regular_ads') }}
                </h2>
                <div class="row">
                    @foreach ($latestAds as $ad)
                        <x-frontend.single-left-image-ad :ad="$ad" classList="col-lg-6">
                        </x-frontend.single-left-image-ad>
                    @endforeach
                </div>
                @if (count($latestAds) > 0)
                    <div class="feature-ads__btn">
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
    <!-- regular section end -->

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

    <!-- recent-post section start  -->
    <section class="section recent-post bgcolor--gray-10">
        <div class="container">
            <h2 class="text--heading-1 section__title">
                {{ __('recently_posted_ads') }}
            </h2>
            <div class="row">
                @foreach ($recentads as $recentad)
                    <x-frontend.single-ad :ad="$recentad" className="col-xl-3 col-sm-6"></x-frontend.single-ad>
                @endforeach
            </div>
        </div>
    </section>
    <!-- recent-post section end -->

    @if ($priceplan_enable)
        <!-- membership-call section start  -->
        <section class="section membership-call">
            <div class="container">
                <div class="membership-call__content" style="background: url('') center center/cover no-repeat;">
                    <div class="membership-call__left">
                        <h2 class="text--heading-2 membership-call__title">{{ __('get_premium_membership') }}</h2>
                        <p class="text--body-3 membership-call__description">
                            {{ $cms->membership_content }}
                        </p>
                    </div>
                    <div class="membership-call__right">
                        <a href="{{ route('frontend.priceplan') }}"
                            class="btn btn--lg">{{ __('get_membership') }}</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- membership-call section start  -->
    @endif

@endsection

@section('adlisting_style')
    <link rel="stylesheet" href="{{ asset('frontend/css') }}/select2.min.css" />
    <link rel="stylesheet" href="{{ asset('frontend/css') }}/select2-bootstrap-5-theme.css" />
    <link rel="stylesheet" href="{{ asset('frontend/css') }}/slick.css" />
@endsection

@section('frontend_script')
    <script src="{{ asset('frontend') }}/js/plugins/slick.min.js"></script>
    <script type="module" src="{{ asset('frontend') }}/js/plugins/select2.min.js"></script>

    <script>
        function adFilterFunction(slug) {
            $('#adFilterInput').val(slug);
            $('#adFilterForm').submit();
        }
        $(document).ready(function() {
            // ===== Select2 ===== \\
            $('#town').select2({
                theme: 'bootstrap-5',
                width: $(this).data('width') ?
                    $(this).data('width') : $(this).hasClass('w-100') ?
                    '100%' : 'style',
                placeholder: 'Select town',
                allowClear: Boolean($(this).data('allow-clear')),
                closeOnSelect: !$(this).attr('multiple'),
            });
        });
    </script>
@endsection
