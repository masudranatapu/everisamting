@extends('layouts.frontend.layout_one')

@section('title', __('events'))

@section('content')
    <!-- breedcrumb section start  -->
    <x-frontend.breedcrumb-component :background="$cms->dashboard_my_ads_background">
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
                <a class="breedcrumb__page-link text--body-3">{{ __('events') }}</a>
            </li>
        </x-slot>
    </x-frontend.breedcrumb-component>
    <!-- breedcrumb section end  -->
    <!-- dashboard section start  -->
    <section class="section dashboard">
        <div class="container">
            <div class="row">
                <div class="col-xl-3">
                    @include('layouts.frontend.partials.dashboard-sidebar')
                </div>
                <div class="col-xl-9">
                    <div class="card">
                        <div class="card-header">
                            <div class="dashboard__posted-ads">
                                <div class="dashboard__section-info">
                                    <h2 class="dashboard-card__title">{{ __('events') }}</h2>
                                    <a href="{{ route('frontend.event.create') }}" class="btn">
                                        {{ __('create_my_event') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if($events->count() > 0)
                                <div class="row user_events">
                                    @foreach ($events as $event)
                                        <div class="col-md-4 mb-3">
                                            <div class="cards cards--one">
                                                <div class="ribbon-wrapper">
                                                    @if($event->status == 1)
                                                        @if($event->event_status == 1)
                                                            <div class="ribbon bg-success">{{ __('Scheduled') }}</div>
                                                        @endif
                                                        @if($event->event_status == 2)
                                                            <div class="ribbon bg-warning">{{ __('Canceled') }}</div>
                                                        @endif
                                                        @if($event->event_status == 3)
                                                            <div class="ribbon bg-info">{{ __('Postponed') }}</div>
                                                        @endif
                                                    @else
                                                        <div class="ribbon bg-info">{{ __('Inactive') }}</div>
                                                    @endif
                                                </div>
                                                <a href="{{ route('frontend.event.details', ['id' =>$event->id, 'slug' => $event->slug]) }}" class="cards__img-wrapper">
                                                    <img src="@if($event->image) {{ asset($event->image) }} @else {{ asset('images/event.jpg') }} @endif" alt="card-img" class="img-fluid" />
                                                </a>
                                                <div class="cards__info">
                                                    <div class="cards__info-top">
                                                        <a href="{{ route('frontend.event.details', ['id' =>$event->id, 'slug' => $event->slug]) }}" class="text--body-3-600 cards__caption-title">
                                                            {{ \Illuminate\Support\Str::limit($event->title, 25, $end = '...') }}
                                                        </a>
                                                    </div>
                                                    <div class="cards__info-bottom">
                                                        <span class="cards__price-title text--body-3-600">
                                                            @if($event->cost == 0)
                                                                {{ __('Free') }}
                                                            @else
                                                                 {{ changeCurrency(number_format($event->cost, 0, '.', ',')) }}
                                                            @endif
                                                        </span>
                                                        <ul class="edit">
                                                            <li class="edit-icon">
                                                                <span class="icon-toggle">
                                                                    <x-svg.three-dots-icon />
                                                                </span>
                                                                <ul class="edit-dropdown">
                                                                    <li class="edit-dropdown__item">
                                                                        <a href="{{ route('frontend.myevent.edit', $event->id) }}" class="edit-dropdown__link">
                                                                            <span class="icon">
                                                                                <x-svg.edit-icon />
                                                                            </span>
                                                                            <h5 class="text--body-4">{{ __('edit') }}</h5>
                                                                        </a>
                                                                    </li>
                                                                    <li class="edit-dropdown__item">
                                                                        <a href="{{ route('frontend.event.details', ['id' =>$event->id, 'slug' => $event->slug]) }}" class="edit-dropdown__link">
                                                                            <span class="icon">
                                                                                <x-svg.eye-icon stroke="currentColor" width="20" height="20" />
                                                                            </span>
                                                                            <h5 class="text--body-4">{{ __('View_details') }}</h5>
                                                                        </a>
                                                                    </li>
                                                                    <li class="edit-dropdown__item">
                                                                        <a href="{{ route('frontend.myevent.delete', $event->id) }}" class="edit-dropdown__link" onclick="return confirm('Are you sure, you want to delete this event ? ')">
                                                                            <span class="icon">
                                                                                <x-svg.delete-icon />
                                                                            </span>
                                                                            <h5 class="text--body-4">{{ __('delete') }}</h5>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <h4>{{ __('no_data') }}</h4>
                                        <br>
                                        <a href="{{ route('frontend.event.create') }}"class="btn">{{ __('Create_first_event') }}</a>
                                    </div>
                                </div>
                            @endif
                            <br>
                            {{ $events->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- dashboard section end  -->
@endsection

@section('adlisting_style')
    <link rel="stylesheet" href="{{ asset('frontend/css') }}/slick.css" />
    <style>
        .dashboard-card--recent__activity-item {
            align-items: center !important;
        }
    </style>
@endsection

@section('frontend_script')
    <script src="{{ asset('frontend') }}/js/plugins/slick.min.js"></script>
    <script>

        var editBtn = document.querySelectorAll('#edit');
        if (editBtn) {
            editBtn.forEach((item) => {
                item.addEventListener('click', () => {
                    item.classList.toggle('active');
                });
            });
        }

    </script>
@endsection
