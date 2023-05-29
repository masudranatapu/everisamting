@extends('layouts.frontend.layout_one')

@section('title', __('price_and_billing'))

@section('content')
    <!-- breedcrumb section start  -->
    <x-frontend.breedcrumb-component :background="$cms->dashboard_plan_background">
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
                <a class="breedcrumb__page-link text--body-3">{{ __('plans_billing') }}</a>
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
                    @if ($user_plan->subscription_type == 'recurring' && isset($current_plan))
                        <div class="dashboard-card dashboard__upgrade">
                            <h2 class="dashboard-card__title">{{ __('current_plan') }}</h2>
                            <div class="dashboard__upgrade-content">
                                <div class="info">
                                    <h2 class="text--heading-1">{{ $current_plan->label }}</h2>
                                    <p
                                        class="text--body-3 {{ formatDateTime($user_plan->expired_date)->isPast() ? 'text-danger' : 'text-success' }}">
                                        {{ __('expired_date') }}:
                                        {{ formatDate($user_plan->expired_date, 'M d, Y') }}
                                    </p>
                                </div>
                                <div class="action">
                                    @if (!formatDateTime($user_plan->expired_date)->isPast())
                                        <a onclick="return confirm('{{ __('are_you_sure_to_cancel_plan') }} ? {{ __('it_will_restore_current_plan_benefits') }}.')"
                                            class="btn text-white"
                                            href="{{ route('frontend.cancel-plan') }}">{{ __('cancel_plan') }}</a>
                                    @endif
                                    <a href="{{ route('frontend.priceplan') }}"
                                        class="btn text-light">{{ __('upgrade_plan') }}</a>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="row dashboard__bill-two">
                        <div class="col-lg-{{ $setting->subscription_type == 'one_time' ? '7' : '12' }}">
                            <div class="dashboard-card dashboard-card--benefits">
                                <h2 class="dashboard-card__title">{{ __('plan_benefits') }}</h2>
                                <ul class="dashboard__benefits">
                                    <li class="dashboard__benefits-left">
                                        <ul>
                                            <li class="dashboard__benefits-item">
                                                <span class="icon">
                                                    <x-svg.check-icon width="12" height="12" stroke="#00AAFF" />
                                                </span>
                                                <p class="text--body-4">{{ __('ads_remaining') }}
                                                    <span
                                                        class="{{ $plan_info->ad_limit <= 5 ? 'text-danger' : 'text-success' }}">{{ $plan_info->ad_limit }}</span>
                                                </p>
                                            </li>
                                            @if (isset($plan_info->business_directory_limit))

                                            <li class="dashboard__benefits-item">
                                                <span class="icon">
                                                    <x-svg.check-icon width="12" height="12" stroke="#00AAFF" />
                                                </span>
                                                <p class="text--body-4">{{ __('business_directory_remaning') }}
                                                    <span
                                                        class="{{ $plan_info->business_directory_limit <= 5 ? 'text-danger' : 'text-success' }}">{{ $plan_info->business_directory_limit }} </span>
                                                </p>
                                            </li>
                                            @endif
                                        </ul>
                                    </li>
                                    <li class="dashboard__benefits-right">
                                        <ul>
                                            <li class="dashboard__benefits-item">
                                                <span class="icon">
                                                    <x-svg.check-icon width="12" height="12" stroke="#00AAFF" />
                                                </span>
                                                <p class="text--body-4">{{ __('featured_ads_remaining') }}
                                                    <span
                                                        class="{{ $plan_info->featured_limit <= 2 ? 'text-danger' : 'text-success' }}">{{ $plan_info->featured_limit }}</span>
                                                </p>
                                            </li>
                                            @if ($plan_info->badge)
                                                <li class="dashboard__benefits-item">
                                                    <span class="icon">
                                                        <x-svg.check-icon width="12" height="12" stroke="#00AAFF" />
                                                    </span>
                                                    <p class="text--body-4">{{ __('special_membership_badge') }}</p>
                                                </li>
                                            @endif
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        @if ($setting->subscription_type == 'one_time')
                            <div class="col-lg-5">
                                <div class="dashboard-card dashboard-card--invoice">
                                    <h2 class="dashboard-card__title">{{ __('upgrade_plan') }}</h2>
                                    <div class="dashboard-card--invoice-info">
                                        <div class="action">
                                            <a href="{{ route('frontend.priceplan') }}"
                                                class="btn">{{ __('upgrade_plan') }}</a>
                                        </div>
                                    </div>
                                    <span class="dashboard-card--invoice__icon">
                                        <x-svg.invoice-icon />
                                    </span>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="row dashboard__bill-three">
                        <div class="col-lg-12">
                            <div class="invoice-table">
                                <h4>{{ __('recent_invoice') }}</h4>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>{{ __('order_id') }}</th>
                                            <th>{{ __('plan_type') }}</th>
                                            <th>{{ __('payment_provider') }}</th>
                                            <th>{{ __('amount') }}</th>
                                            <th>{{ __('date') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($transactions as $transaction)
                                            <tr>
                                                <td>{{ $transaction->order_id }}</td>
                                                <td>{{ $transaction->plan->label }}</td>
                                                <td>{{ ucfirst($transaction->payment_provider) }}</td>
                                                <td>
                                                    {{ $transaction->currency_symbol }}{{ $transaction->amount }}
                                                </td>
                                                <td>{{ Carbon\Carbon::parse($transaction->created_at)->format('M d, Y g:i A') }}
                                                </td>
                                            </tr>
                                        @empty
                                            <x-not-found2 message="{{ __('no_recent_invoice_found') }}" />
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- dashboard section end  -->
@endsection


@section('frontend_style')
    <style>
        .header-table {
            position: relative;
            min-height: 45px;
            -webkit-transition: all 0.4s ease-in-out;
            transition: all 0.4s ease-in-out;
        }

        .dashboard-card--recentvoice__history .header-table {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
        }
    </style>
@endsection
