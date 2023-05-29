@extends('layouts.frontend.layout_one')
@section('title', 'Seller Page')
@section('content')
<!-- breedcrumb section start  -->
<x-frontend.breedcrumb-component background="{{ asset('frontend/default_images/breadcrumbs.png') }}">
    {{ $user->username }}
    <x-slot name="items">
        <li class="breedcrumb__page-item">
            <a href="{{ route('frontend.dashboard') }}"
                class="breedcrumb__page-link text--body-3">{{ __('seller') }}</a>
        </li>
        <li class="breedcrumb__page-item">
            <a class="breedcrumb__page-link text--body-3">/</a>
        </li>
        <li class="breedcrumb__page-item">
            <a class="breedcrumb__page-link text--body-3">{{ $user->username }}</a>
        </li>
    </x-slot>
</x-frontend.breedcrumb-component>
<!-- breedcrumb section end  -->
<!-- dashboard section start  -->
<section class="section dashboard dashboard--user">
    <div class="container">
        @include('frontend.dashboard-alert')
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-12">
                @include('layouts.frontend.partials.seller-dashboard-sidebar')
            </div>
            <div class="col-xl-9 col-lg-8 col-12">
                @include('frontend.seller.hero')


                <div class="dashboard-post2">
                    @php
                    $current_tab = session('seller_tab') ?? 'ads';
                    @endphp
                    <ul class="nav dashboard-post__nav2">
                        <li class="nav-item dashboard-post__item2" role="presentation">
                            <button class="fw-bolder dashboard-post__link2 {{ $current_tab == 'ads' ? 'active' : '' }}"
                                id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab"
                                aria-controls="home" aria-selected="true">
                                <div class="tab-title">{{ __('recent_ads') }}</div>
                            </button>
                        </li>
                        <li class="nav-item dashboard-post__item2" role="presentation">
                            <button
                                class="fw-bolder dashboard-post__link2 {{ $current_tab == 'review_list' ? 'active' : '' }}"
                                id="seller-review-tab" data-bs-toggle="tab" data-bs-target="#seller-review"
                                type="button" role="tab" aria-controls="seller-review" aria-selected="true">
                                <div class="tab-title">{{ __('seller_review') }}</div>
                            </button>
                        </li>
                        @if ($user->id != auth()->id())
                        @if (auth()->check())
                        <li class="nav-item dashboard-post__item2" role="presentation">
                            <button
                                class="fw-bolder dashboard-post__link2 {{ $current_tab == 'review_store' ? 'active' : '' }}"
                                id="review-tab" data-bs-toggle="tab" data-bs-target="#review" type="button" role="tab"
                                aria-controls="review" aria-selected="true">
                                <div class="tab-title">{{ __('write_review') }}</div>
                            </button>
                        </li>
                        @else
                        <li class="nav-item dashboard-post__item2" role="presentation">
                            <button
                                class="fw-bolder dashboard-post__link2 {{ $current_tab == 'review_store' ? 'active' : '' }}"
                                id="review-tab" data-bs-toggle="tab" data-bs-target="#review" type="button" role="tab"
                                aria-controls="review" aria-selected="true">
                                <div class="tab-title">{{ __('write_review') }}</div>
                            </button>
                        </li>
                        @endif
                        @endif
                    </ul>
                    <div class="tab-content dashboard-post__content" id="myTabContent">
                        <div class="tab-pane fade  {{ $current_tab == 'ads' ? 'show active' : '' }}" id="home"
                            role="tabpanel" aria-labelledby="home-tab">
                            <div class="ad-list__content row">
                                @forelse ($recent_ads as $ad)
                                <x-frontend.single-ad :ad="$ad" :adfields="$ad->productCustomFields"
                                    className="col-xl-4 col-md-6">
                                </x-frontend.single-ad>
                                @empty
                                <x-not-found2 message="No ads found" />
                                @endforelse
                            </div>
                            <div class="page-navigation mb-4">
                                {{ $recent_ads->links() }}
                            </div>
                        </div>

                        <div class="tab-pane fade {{ $current_tab == 'review_list' ? 'show active' : '' }}"
                            id="seller-review" role="tabpanel" aria-labelledby="seller-review-tab">
                            @include('frontend.seller.review-list')
                        </div>

                        @if ($user->id != auth()->id())
                        @if (!auth()->check())
                        <div class="tab-pane fade {{ $current_tab == 'review_store' ? 'show active' : '' }}" id="review"
                            role="tabpanel" aria-labelledby="review-tab">
                            @include('frontend.seller.review')
                        </div>
                        @else
                        <div class="tab-pane fade {{ $current_tab == 'review_store' ? 'show active' : '' }}" id="review"
                            role="tabpanel" aria-labelledby="review-tab">
                            @include('frontend.seller.review2')
                        </div>
                        @endif
                        @endif
                    </div>
                    <div class="tab-pane fade" id="seller-review" role="tabpanel" aria-labelledby="seller-review-tab">
                        @include('frontend.seller.review-list')
                    </div>
                    <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                        @include('frontend.seller.review')
                    </div>
                    <div class="tab-pane fade" id="review1" role="tabpanel" aria-labelledby="review1-tab">
                        @include('frontend.seller.review2')
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<!-- dashboard section end  -->
@endsection
@section('adlisting_style')
@livewireStyles

<style>
    @media(max-width: 1199px) {
        .dashboard__navigation {
            top: 68% !important;
        }
    }

    @media (max-width: 360px) {
        .dashboard__navigation {
            border-radius: 12px !important;
        }
    }



    .dashboard-post__content {
        padding: 24px !important;
    }

    .dashboard__navigation-toggle-btn {
        top: 100px !important;
    }

    .dashboard-card--recent__activity-item {
        align-items: center !important;
    }

    .title h2 {
        font-weight: 700;
        font-size: 16px;
        line-height: 1.5;
        text-transform: capitalize;
        color: #00AAFF;
        position: relative;
    }

    .title h2::after {
        content: '';
        display: block;
        position: absolute;
        top: 36px;
        width: 120px;
        height: 2px;
        z-index: 1000;
        background-color: #00AAFF;
    }

    .main-bar {
        padding: 24px;
        background: #FFFFFF;
        border: 1px solid #EBEEF7;
        box-shadow: 0px 12px 48px rgba(0, 34, 51, 0.06);
        border-radius: 12px;
    }

    .border {
        background: #EBEEF7;
        height: 1px;
        margin: 12px 0px 20px;
    }

    .dashboard-post2 {
    border-radius: 2px;
    background-color: #fff;
}

    .dashboard-post__nav2 {
        margin-right: 0;
        /* margin-bottom: 2px !important; */
        border-bottom: 1px solid #ebeef7;
    }

    @media (max-width: 767px) {
        .dashboard-post__nav2 {
            padding: 0 16px;
        }
    }

    .dashboard-post__item2 {
        margin-left: 32px;
    }

    @media (max-width: 767px) {
        .dashboard-post__item2 {
            margin-bottom: 16px;
            margin-right: 0;
            width: 100%;
        }
    }

    .dashboard-post__link2 {
        display: flex;
        align-items: center;
        cursor: pointer;
        padding: 24px !important;
        border-radius: 0 !important;
        margin: 0 !important;
        border-bottom: 2px solid transparent !important;
        color: #636A80;
    }

    @media (max-width: 767px) {
        .dashboard-post__link2 {
            width: inherit;
        }
    }

    .dashboard-post__link2:nth-last-child(1) {
        margin-right: 0;
    }

    .dashboard-post__link2.active {
        background-color: transparent !important;
        border-bottom: 2px solid #f27319 !important;
        color: #f27319;
    }

    .tab-title {
        font-family: Nunito Sans;
        font-weight: 700;
        font-size: 16px;
        line-height: 24px;
        line-height: 110%;
        text-align: Left Vertical;
    }

    .fade:not(.show) {
        opacity: 0;
        display: none !important;
    }

</style>

@endsection

@section('frontend_script')
@livewireScripts

@endsection
