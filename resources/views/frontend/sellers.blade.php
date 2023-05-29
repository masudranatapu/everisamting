@extends('layouts.frontend.layout_one')

@section('title', __('Sellers'))

@section('content')
    <x-frontend.breedcrumb-component background="{{ asset('frontend/default_images/breadcrumbs.png') }}">
        <x-slot name="items">
            <li class="breedcrumb__page-item">
                <a href="javascript:;" class="breedcrumb__page-link text--body-3">{{ __('Sellers') }}</a>
            </li>
        </x-slot>
    </x-frontend.breedcrumb-component>

    <section class="section dashboard dashboard--user">
        <div class="container">
            <div class="row">
                @foreach($sellers as $user)
                    @php
                        $ads = DB::table('ads')->where('user_id', $user->id)->count();
                        $reviews = Modules\Review\Entities\Review::where('seller_id', $user->id)->whereStatus(1)->get();

                        $rating_details = [
                            'total' => $reviews->count(),
                            'rating' => $reviews->sum('stars'),
                            'average' => number_format($reviews->avg('stars')),
                        ];

                    @endphp
                    <div class="col-xl-3 col-lg-4 col-12 mb-3">
                        <div class="seller-dashboard__navigation">
                            <div class="dashboard__navigation-top">
                                <div class="dashboard__user-proifle">
                                    <div class="dashboard__user-img">
                                        <img src="{{ asset($user->image) }}" alt="user-photo" />
                                    </div>
                                    <div class="dashboard__user-info">
                                        <h2 class="name text-center">{{ $user->username }}</h2>
                                        <p class="rating">
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9.31015 13.4109L12.8564 15.6576C13.3097 15.9448 13.8725 15.5177 13.738 14.9886L12.7134 10.9581C12.6845 10.8458 12.688 10.7277 12.7233 10.6173C12.7586 10.5069 12.8243 10.4087 12.9129 10.334L16.093 7.68719C16.5108 7.33941 16.2951 6.64595 15.7583 6.61111L11.6054 6.34158C11.4935 6.33359 11.3862 6.29399 11.296 6.22738C11.2058 6.16078 11.1363 6.06991 11.0957 5.96537L9.54688 2.06492C9.50478 1.95396 9.42992 1.85843 9.33224 1.79102C9.23456 1.7236 9.11868 1.6875 9 1.6875C8.88132 1.6875 8.76544 1.7236 8.66777 1.79102C8.57009 1.85843 8.49523 1.95396 8.45312 2.06492L6.90426 5.96537C6.86367 6.06991 6.79423 6.16078 6.70401 6.22738C6.61378 6.29399 6.5065 6.33359 6.39464 6.34158L2.24171 6.61111C1.70486 6.64595 1.4892 7.33941 1.90704 7.68719L5.08709 10.334C5.17571 10.4087 5.24145 10.5069 5.27674 10.6173C5.31204 10.7277 5.31546 10.8458 5.2866 10.9581L4.33641 14.6959C4.175 15.3309 4.85036 15.8434 5.39432 15.4988L8.68985 13.4109C8.78254 13.3519 8.89013 13.3205 9 13.3205C9.10987 13.3205 9.21747 13.3519 9.31015 13.4109V13.4109Z" fill="#FFBF00" />
                                            </svg>
                                            <span> {{ $rating_details['average'] }} {{ __('star_rating') }}</span>
                                            <br>
                                            <span>
                                                ( {{ $rating_details['total'] }} {{ __('review') }} )</span>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="dashboard__user-info">
                                        <a href="{{ route('frontend.seller.profile', $user->username) }}" class="user-btn" title="View {{ $user->name }}'s details">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection

@section('adlisting_style')
    <style>
        .user-btn {
            font-size: 16px;
            line-height: 35px;
            font-weight: 700;
            text-transform: capitalize;
            font-family: "Nunito Sans", sans-serif;
            color: #fff;
            padding: 0px 15px;
            background-color: #f27319;
        }

        .user-btn:hover {
            background: #0088cc;
            color: white;
        }

        .seller-dashboard__navigation {
            background: #FFFFFF;
            border-radius: 2px;
            padding: 32px 0px;
        }

        .seller-dashboard__navigation .dashboard__user-info .name {
            font-weight: 600;
            font-size: 22px;
            line-height: 1.4;
            color: #191F33;
            margin-bottom: 10px;
        }

        .seller-dashboard__navigation .dashboard__user-info .rating {
            justify-content: center;
        }

        .seller-dashboard__navigation .dashboard__user-info .rating span {
            font-weight: 600;
            font-size: 14px;
            line-height: 1.43;
            color: #191F33;
            margin-top: 1px;
            margin-left: 2px;
        }

        .seller-dashboard__navigation .dashboard__navigation-top {
            padding: 0px 32px;
            padding-bottom: 0px;
            border-bottom: none;
        }

        hr {
            background-color: #DADDE6;
            height: 1px;
            margin: 24px 0px;
        }

        .dashboard__user-proifle {
            flex-direction: column;
            gap: 24px;
        }

        .rating {
            display: flex;
            align-items: center;
            font-weight: 600;
            font-size: 14px;
            line-height: 1.43;
            color: #191F33;
        }

        .dashboard__navigation_social-mdeia {
            padding: 0px 32px;
            text-align: center;
        }

        .dashboard__navigation_social-mdeia p {
            margin-bottom: 10px;
            font-size: 16px;
            line-height: 1.43;
            color: #767E94;
        }

        .seller-dashboard__navigation-bottom {
            padding: 0px 32px;
        }

        .seller-dashboard__navigation-bottom p {
            font-weight: 600;
            font-size: 16px;
            line-height: 1.33;
            color: #939AAD;
            margin-bottom: 8px;
        }

        .seller-dashboard__navigation .seller-dashboard__nav-link {
            font-weight: 400;
            font-size: 16px;
            line-height: 24px;
            color: #464D61;
            margin-bottom: 16px;
            display: flex;
        }

        .new-report .seller-dashboard__nav-link {
            margin-left: 34px;
        }

        .seller-dashboard__navigation .seller-dashboard__nav-link span {
            display: block;
        }

        .seller-dashboard__navigation .seller-dashboard__nav-link span.icon {
            margin-right: 12px;
            margin-left: -4px;
        }

        .seller-dashboard__navigation .seller-dashboard__nav-link .website {
            margin-right: 6px;
        }

        .seller-dashboard__navigation .seller-dashboard__nav-link .go-to-icon {
            margin-top: 2px;
        }

        .seller-info {
            padding: 0px 32px;
        }

        .seller-info h4 {
            font-weight: 600;
            font-size: 12px;
            line-height: 1.33;
            color: #939AAD;
            margin-bottom: 8px;
        }

        .seller-info p {
            font-weight: 400;
            font-size: 16px;
            line-height: 24px;
            color: #464D61;
        }

        .dashboard__navigation-report hr {
            margin: 24px 32px;
        }

        .dashboard__navigation_social-mdeia ul {
            margin: 0px auto;
            column-count: 4;
        }

        .dashboard__navigation_social-mdeia li {
            display: inline-block;
            margin: 8px 4px;
        }
    </style>
@endsection

@section('frontend_script')

@endsection
