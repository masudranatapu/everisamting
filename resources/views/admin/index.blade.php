@extends('admin.layouts.app')
@section('title')
    {{ __('dashboard') }}
@endsection
@section('breadcrumbs')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">{{ __('dashboard') }}</h1>
        </div>
    </div>
@endsection
@section('content')
    <x-setup-guide />
    <div class="row">
        <div class="col-sm-6 col-lg-4 col-xl-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-money-bill"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ __('earnings') }}</span>
                    <span class="info-box-number">
                        @if ($total_earning)
                            {{ changeCurrency($total_earning) }}
                        @else
                        {{ changeCurrency('0') }}
                        @endif
                    </span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4 col-xl-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ __('total_customers') }}</span>
                    <span class="info-box-number"> {{ $customer }} </span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4 col-xl-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ __('verified_user') }}</span>
                    <span class="info-box-number"> {{ $verified_customers }} </span>
                </div>
            </div>
        </div>
        @if (enableModule('blog'))
            <div class="col-sm-6 col-lg-4 col-xl-3">
                <div class="info-box">
                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-book"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">{{ __('total_blog_posts') }}</span>
                        <span class="info-box-number">
                            {{ $blogpostCount }}
                        </span>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-sm-6 col-lg-4 col-xl-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-photo-video"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ __('total_ads') }}</span>
                    <span class="info-box-number"> {{ $adcount }} </span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4 col-xl-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-clock"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ __('pending_ads') }}</span>
                    <span class="info-box-number"> {{ $adcountPending }} </span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4 col-xl-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-ad" width="44"
                        height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <rect x="3" y="5" width="18" height="14" rx="2" />
                        <path d="M7 15v-4a2 2 0 0 1 4 0v4" />
                        <line x1="7" y1="13" x2="11" y2="13" />
                        <path d="M17 9v6h-1.5a1.5 1.5 0 1 1 1.5 -1.5" />
                    </svg>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ __('active_ads') }}</span>
                    <span class="info-box-number"> {{ $adcountActive }} </span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4 col-xl-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-ad-2" width="44"
                        height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M11.933 5h-6.933v16h13v-8" />
                        <path d="M14 17h-5" />
                        <path d="M9 13h5v-4h-5z" />
                        <path d="M15 5v-2" />
                        <path d="M18 6l2 -2" />
                        <path d="M19 9h2" />
                    </svg>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ __('sold_ads') }}</span>
                    <span class="info-box-number"> {{ $adcountExpired }} </span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4 col-xl-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-photo-video"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ __('featured_ads') }}</span>
                    <span class="info-box-number"> {{ $adcountFeatured }} </span>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4 col-xl-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-money-check"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{ __('total_plan') }}</span>
                    <span class="info-box-number"> {{ $total_plan }} </span>
                </div>
            </div>
        </div>

        <div class="clearfix hidden-md-up"></div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('latest_ads') }}</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('title') }}</th>
                                <th>{{ __('price') }}</th>
                                <th>{{ __('status') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($latestAds as $ad)
                                <tr>
                                    <td>
                                        <a href="{{ route('frontend.addetails', $ad->slug) }}" class="ms-1"
                                            aria-label="Open website">{{ $ad->title }}</a>
                                    </td>
                                    <td class="text-muted">{{ changeCurrency(number_format($ad->price, 2, '.', ',')) }}</td>
                                    <td class="text-muted">
                                        @if ($ad->status === 'sold')
                                            <span class="text-danger">{{ ucfirst($ad->status) }}</span>
                                        @else
                                            <span class="text-success">{{ ucfirst($ad->status) }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">
                                        <span class="">{{ __('no_ads_found') }}...</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    {{ __('latest_registered_users') }}
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('name') }}</th>
                                <th>{{ __('email') }}</th>
                                <th>{{ __('since') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($latestusers as $user)
                                <tr>
                                    <td>
                                        <a href="{{ route('module.customer.show', $user->username) }}">
                                            {{ $user->name }}
                                        </a>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ date('M d, Y', strtotime($user->created_at)) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">
                                        <span class="">{{ __('no_users_found') }}...</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('latest_transaction') }}</h3>
                    <a href="{{ route('transactions') }}"
                        class="btn bg-primary float-right d-flex align-items-center justify-content-center">
                        {{ __('view_all') }}
                    </a>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('customer') }}</th>
                                <th>{{ __('amount') }}</th>
                                <th>{{ __('plan_name') }}</th>
                                <th>{{ __('payment_provider') }}</th>
                                <th>{{ __('created_time') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($latestTransactionUsers as $transaction)
                            @if($transaction->customer)
                                <tr>
                                    <td>
                                        <a href="{{ route('module.customer.show', $transaction->customer->username ) }}">
                                            {{ $transaction->customer->name }}
                                        </a>
                                    </td>
                                    <td class="text-muted">
                                        {{ $transaction->currency_symbol }}{{ $transaction->amount }}
                                    </td>
                                    <td class="text-muted">
                                        <span class="badge badge-primary">
                                            {{ $transaction->plan->label }}
                                        </span>
                                    </td>
                                    <td class="text-muted">{{ ucfirst($transaction->payment_provider) }}</td>
                                    <td class="text-muted">
                                        {{ date('M d, Y', strtotime($transaction->created_at)) }}</td>
                                </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">
                                        <span class="">{{ __('no_transactions_found') }}...</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('backend') }}/plugins/chart.js/Chart.min.js"></script>

    <script>
        var areaChartData = {
            labels: {!! json_encode($earnings['months']) !!},
            datasets: [{
                label: 'Earnings',
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,0.8)',
                pointRadius: false,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: {!! json_encode($earnings['amount']) !!}
            }, ]
        }

        //-------------
        //- BAR CHART -
        //-------------
        var barChartCanvas = $('#barChart').get(0).getContext('2d')
        var barChartData = jQuery.extend(true, {}, areaChartData)
        var temp = areaChartData.datasets
        barChartData.datasets = temp

        var barChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            datasetFill: false,
            display: false
        }

        var barChart = new Chart(barChartCanvas, {
            type: 'bar',
            data: barChartData,
            options: barChartOptions
        })

        //-------------
        //- DONUT CHART -
        //-------------
        var locationChart = $('#locationChart').get(0).getContext('2d')
        var locationData = {
            labels: {!! json_encode($topLocations->pluck('country')->all()) !!},
            datasets: [{
                data: {!! json_encode($topLocations->pluck('total')->all()) !!},
                backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#AE4CCF',
                    '#FF5F7E', '#99FEFF', '#000000', '#FB3640'
                ],
            }]
        }
        var locationChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        var donutChart = new Chart(locationChart, {
            type: 'pie',
            data: locationData,
            options: locationChartOptions
        })
    </script>
@endsection
