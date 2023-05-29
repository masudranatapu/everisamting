@extends('layouts.frontend.layout_one')

@section('title', __('favorite_ads'))

@section('content')
    <!-- breedcrumb section start  -->
    <x-frontend.breedcrumb-component :background="$cms->dashboard_favorite_ads_background">
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
                <a class="breedcrumb__page-link text--body-3">{{ __('favorite_ads') }}</a>
            </li>
        </x-slot>
    </x-frontend.breedcrumb-component>
    <!-- breedcrumb section end  -->

    <!-- dashboard section start  -->
    <section class="section dashboard">
        <div class="container">
            @include('frontend.dashboard-alert')
            <div class="row">
                <div class="col-xl-3">
                    @include('layouts.frontend.partials.dashboard-sidebar')
                </div>
                <div class="col-xl-9">
                    @include('layouts.frontend.partials.dashboard-myads-filter', [
                        'routeName' => 'frontend.favourites',
                    ])
                    <div class="dashboard__myads">
                        @if ($wishlists->count() > 0)
                            {{-- <div class="header-table">
                                <div class="header-item">
                                    <h6 class="text--body-4-600">
                                        {{ __('ads') }}
                                    </h6>
                                </div>
                                <div class="header-item">
                                    <h6 class="text--body-4-600">
                                        {{ __('date') }}
                                    </h6>
                                </div>
                                <div class="header-item">
                                    <h6 class="text--body-4-600">
                                        {{ __('prices') }}
                                    </h6>
                                </div>
                                <div class="header-item">
                                    <h6 class="text--body-4-600">
                                        {{ __('category') }}
                                    </h6>
                                </div>
                                <div class="header-item">
                                    <h6 class="text--body-4-600">
                                        {{ __('action') }}
                                    </h6>
                                </div>
                            </div> --}}

                            <table class="table">
                                <tr>
                                    <th>{{ __('Ads Image') }}</th>
                                    <th>{{ __('ads') }}</th>
                                    <th>{{ __('date') }}</th>
                                    <th>{{ __('prices') }}</th>
                                    <th> {{ __('category') }}</th>
                                    <th>{{ __('action') }}</th>
                                </tr>
                            </table>
                        @endif
                        <div class="body">
                            @forelse ($wishlists as $ad)
                                <x-dashboard.ads-lg :ad="$ad" showstatue="no">
                                    <form action="{{ route('frontend.add.wishlist') }}" method="POST">
                                        @csrf
                                        @if (auth('user')->check())
                                            <input type="hidden" name="ad_id" value="{{ $ad->id }}">
                                            <input type="hidden" name="user_id" value="{{ auth('user')->user()->id }}">
                                        @endif
                                        <button type="submit" class="btn btn--bg btn--fav">
                                            <span class="icon">
                                                <x-svg.heart-icon fill="#00AAFF" strokeWidth="0.5" />
                                            </span>
                                        </button>
                                    </form>
                                </x-dashboard.ads-lg>
                                <x-dashboard.ads-sm :ad="$ad" showstatue="no">
                                    <form action="{{ route('frontend.add.wishlist') }}" method="POST">
                                        @csrf
                                        @if (auth('user')->check())
                                            <input type="hidden" name="ad_id" value="{{ $ad->id }}">
                                            <input type="hidden" name="user_id" value="{{ auth('user')->user()->id }}">
                                        @endif
                                        <button type="submit" class="btn btn--bg btn--fav">
                                            <span class="icon">
                                                <x-svg.heart-icon fill="#00AAFF" strokeWidth="0.5" />
                                            </span>
                                        </button>
                                    </form>
                                </x-dashboard.ads-sm>
                            @empty
                                <x-not-found2 />
                            @endforelse
                        </div>
                        <div class="page-navigation">
                            {{ $wishlists->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- dashboard section end  -->
@endsection

@section('frontend_style')
    <link rel="manifest" href="{{ asset('frontend') }}/images/favicon_io/site.webmanifest" />
    <link rel="stylesheet" href="{{ asset('frontend') }}/js/plugins/css/slick.css" />
{{--    <link rel="stylesheet" href="{{ asset('frontend/style.css') }}">--}}

    <style>
        .header-table {
            position: relative;
            min-height: 45px;
            -webkit-transition: all 0.4s ease-in-out;
            transition: all 0.4s ease-in-out;
        }

        .dashboard__myads .header-table {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            background-color: #fff;
            padding: 13px;
        }
    </style>

    <link rel="stylesheet" href="{{ asset('frontend/css/select2.min.css') }}" />
    <style>
        .select2-selection__rendered {
            line-height: 38px !important;
        }

        .select2-container .select2-selection--single {
            height: 48px !important;
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            padding-top: 4px !important;
            padding-left: 10px !important;
        }

        .select2-selection__arrow {
            height: 45px !important;
        }

        #addon-wrapping {
            cursor: pointer;
        }
    </style>
@endsection

@section('frontend_script')
    <script src="{{ asset('frontend') }}/js/plugins/select2.min.js"></script>
    <script src="{{ asset('frontend') }}/js/plugins/bvselect.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var sortBy = new BVSelect({
                selector: '#sortByFilter',
                searchbox: false,
                offset: false,
                placeholder: 'Sort By',
                search_autofocus: true,
                breakpoint: 450,
            });
            var category = new BVSelect({
                selector: '#myadFilterCategory',
                searchbox: false,
                offset: false,
                placeholder: 'All category',
                search_autofocus: true,
                breakpoint: 450,
            });
        });
    </script>
    <script>
        $('.category').select2({
            // theme: 'bootstrap-5',
            allowClear: Boolean($(this).data('allow-clear')),
            closeOnSelect: !$(this).attr('multiple'),
        });
    </script>
@endsection
