@extends('layouts.frontend.layout_one')

@section('title', __('home'))

@section('frontend_style')
    @livewireStyles
@endsection

@section('meta')
    @php
        $data = metaData('home');
    @endphp

    <meta name="title" content="{{ $data->title }}">
    <meta name="description" content="{{ $data->description }}">

    <meta property="og:image" content="{{ $data->image_url }}"/>
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="{{ $data->title }}">
    <meta property="og:url" content="{{ route('frontend.index') }}">
    <meta property="og:type" content="article">
    <meta property="og:description" content="{{ $data->description }}">

    <meta name=twitter:card content={{ $data->image_url }} />
    <meta name=twitter:site content="{{ config('app.name') }}"/>
    <meta name=twitter:url content="{{ route('frontend.index') }}"/>
    <meta name=twitter:title content="{{ $data->title }}"/>
    <meta name=twitter:description content="{{ $data->description }}"/>
    <meta name=twitter:image content="{{ $data->image_url }}"/>
@endsection

@section('content')
    <!-- banner section start  -->
    <div class="banner banner--two"
         style="background: url('{{ $cms->home_main_banner }}') center center/cover no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">

                    <h2 class="text--display-3 banner__title animate__animated animate__bounceInDown">
                        @if(currentLanguage()->name == "English")
                            {{ $cms->home_title }}
                        @endif

                        @if(currentLanguage()->name == "Chinese")
                            {{ $cms->home_title_chinese }}
                        @endif

                        @if(currentLanguage()->name == "French")
                            {{ $cms->home_title_french }}
                        @endif

                        @if(currentLanguage()->name == "Bislama")
                            {{ $cms->home_title_bislama }}
                        @endif
                    </h2>

                    <p class="text--body-3 banner__brief">
                        @if(currentLanguage()->name == "English")
                            {{ $cms->home_description }}
                        @endif

                        @if(currentLanguage()->name == "Chinese")
                            {{ $cms->home_description_chinese }}
                        @endif

                        @if(currentLanguage()->name == "French")
                            {{ $cms->home_description_french }}
                        @endif

                        @if(currentLanguage()->name == "Bislama")
                            {{ $cms->home_description_bislama }}
                        @endif
                    </p>

                </div>
            </div>
        </div>
    </div>
    <!-- banner section end   -->

    <!-- recent-post section start  -->
    @if ($settings->featured_ads_homepage)
        <section class="section recent-post" style="padding-bottom: 0px !important;">
            <div class="container">
                <div class="d-flex justify-content-between">
                <h2 class="text--heading-1 section__title">
                    {{ __('featured_ads') }}
                </h2>
                    <a href="{{route('frontend.adlist.search',['featured'=>"all"])}}" class="btn" style="border-radius: 48px;padding: 9px 24px;height: 46px;line-height: 27px;">{{__('view_all')}} <i class="fas fa-arrows-alt-right"></i></a>
                </div>
                <div class="row">

                    @forelse ($recommendedAds as $ad)
                        <x-frontend.single-ad :ad="$ad" :adfields="$ad->productCustomFields ?? ''"
                                              className="col-xl-3 col-md-6"/>
                    @empty
                        <x-no-data-found/>
                    @endforelse
                </div>
                @if (count($recommendedAds) > 0)
                    <!--  <div class="recent-post__btn">
                        <a href="{{ route('frontend.adlist') }}" class="btn">
                            {{ __('view_all') }}
                    <span class="icon--right">
                        <x-svg.right-arrow-icon />
                    </span>
                </a>
            </div> -->
                @endif
            </div>
        </section>
    @endif
    <!-- recent-post section end -->

    <!-- recent-post section start  -->
    @if ($settings->regular_ads_homepage)
        <section class="section regular_ads recent-post" style="padding-top: 0px !important;">
            <div class="container">
                <div class="d-flex justify-content-between">

                    <h2 class="text--heading-1 section__title">
                        {{ __('regular_ads') }}
                    </h2>
                    <a href="{{route('frontend.adlist')}}" class="btn" style="border-radius: 48px;padding: 9px 24px;height: 46px;line-height: 27px;">{{__('view_all')}} <i class="fas fa-arrows-alt-right"></i></a>
                </div>
                <div class="row">
                    @forelse ($latestAds as $ad)
                        <x-frontend.single-ad :ad="$ad" :adfields="$ad->productCustomFields ?? ''"
                                              className="col-xl-3 col-md-6"/>
                    @empty
                        <x-no-data-found/>
                    @endforelse
                </div>
                @if (count($latestAds) > 0)
                    <!-- <div class="recent-post__btn">
                        <a href="{{ route('frontend.adlist') }}" class="btn">
                            {{ __('view_all') }}
                    <span class="icon--right">
                        <x-svg.right-arrow-icon />
                    </span>
                </a>
            </div> -->
                @endif
            </div>
        </section>
    @endif
    <!-- recent-post section end -->

    <!-- top-category section start  -->
    <!-- <section class="section top-category bgcolor--gray-10">
        <div class="container">
            <h2 class="text--heading-1 section__title">
                {{ __('top_category') }}
    </h2>
    <div class="row">
@forelse ($topCategories as $category)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="categorylist-card">
                <div class="categorylist-card__top">
                    <div class="categorylist-card__top-left">
                        <h2 class="categorylist-card__title text--body-2-600">
                            <a
                                href="{{ route('frontend.adlist', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                                    </h2>
                                    <span
                                        class="categorylist-card__item-available">({{ $category->ad_count ?? 0 }})</span>
                                </div>
                                <div class="categorylist-card__top-right">
                                    <div class="categorylist-card__icon">
                                        <i class="{{ $category->icon }}" style="font-size: 55px"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="categorylist-card__bottom">
                                <ul class="categorylist-card__list">

                                    {{-- Filter Form 1 --}}
        <form method="GET" action="{{ route('frontend.adlist.search') }}" id="adFilterForm"
                                        class="d-none">
                                        <input type="hidden" name="subcategory[]" value="" id="adFilterInput">
                                    </form>
                                    @forelse ($category->subcategories as $subcategory)
            <li class="categorylist-card__list-item">
                <a href="javascript:void(0)"
                    onclick="adFilterFunction('{{ $subcategory->slug }}')"
                                                class="categorylist-card__list-link text--body-3">
                                                <span class="icon">
                                                    <x-svg.right-regular-icon />
                                                </span>
                                                {{ $subcategory->name }}
            </a>
        </li>

        @empty
            <div class="text-center">
{{ __('no_subcategory_found') }}
            </div>

        @endforelse
        </ul>
    </div>
</div>
</div>

    @empty
        <x-no-data-found />

    @endforelse
    </div>
</div>
</section> -->
    <!-- top-category section end  -->

    {{-- <!-- popular-loc section start  -->
    <section class="section popular-location">
        <div class="container">
            <h2 class="text--heading-1 section__title">
                {{ __('popular_location') }}
            </h2>
            <div class="row">
                @forelse ($topCountry as $country)
                    <div class="col-xl-3 col-md-6">
                        <x-frontend.location.single-popular-location :country="$country">
                        </x-frontend.location.single-popular-location>
                    </div>
                @empty
                    <x-no-data-found />
                @endforelse
            </div>
        </div>
    </section>
    <!-- popular-loc section end --> --}}

    <x-frontend.counter :totalAds="$totalAds" :verifiedUser="$verified_users" :proMember="$pro_members_count"
                        :country="$country_location"></x-frontend.counter>

    <!-- download section start  -->
    @if ($mobile_setting->ios_download_url || $mobile_setting->android_download_url)
        <!-- <section class="download section pb-lg-0">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <img src="{{ $cms->home_mobile_app_banner }}" class="download__img-content w-100" />
                    </div>
                    <div class="col-lg-6">
                        <div class="download__content">
                            <h2 class="download__title text--heading-1">{{ __('download_our_mobile_app') }}</h2>
                            <p class="download__brief text--body-2">
                                {{ $cms->download_app }}
        </p>
        <div class="download__apps-store">
@if ($mobile_setting->android_download_url)
            <a target="_blank" href="{{ asset($mobile_setting->android_download_url) }}"
                                        class="app">
                                        <div class="app-logo">
                                            <x-svg.google-play-icon />
                                        </div>
                                        <div class="app-info">
                                            <h5 class="text--body-5">{{ __('get_it_now') }}</h5>
                                            <h2 class="text--body-3-600">{{ __('google_play') }}</h2>
                                        </div>
                                    </a>

        @endif

        @if ($mobile_setting->ios_download_url)
            <a target="_blank" href="{{ asset($mobile_setting->ios_download_url) }}"
                                        class="app">
                                        <div class="app-logo">
                                            <x-svg.apple-icon />
                                        </div>
                                        <div class="app-info">
                                            <h5 class="text--body-5">{{ __('get_it_now') }}</h5>
                                            <h2 class="text--body-3-600">{{ __('app_store') }}</h2>
                                        </div>
                                    </a>

        @endif
        </div>
    </div>
</div>
</div>
</div>
</section> -->
    @endif
    {{-- @if ($newsletter_enable)
        @include('layouts.frontend.partials.newsletter')
    @endif --}}
@endsection

@section('frontend_script')
    <script type="module" src="{{ asset('frontend') }}/js/plugins/purecounter.js"></script>
    @stack('newslater_script')
    <script>
        // for filter form-1
        function adFilterFunction(slug) {
            $('#adFilterInput').val(slug);
            $('#adFilterForm').submit();
        }

        // for filter form-2
        function adFilterFunctionTwo(slug) {
            $('#adFilterInput2').val(slug);
            $('#adFilterForm2').submit();
        }

        // for filter form-3
        function adFilterFunctionThree(slug) {
            $('#adFilterInput3').val(slug);
            $('#adFilterForm3').submit();
        }
    </script>

@endsection
