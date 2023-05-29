@extends('layouts.frontend.layout_one')

@section('title', __('event_details'))

@section('meta')
    <meta name="title" content="{{ $events->title }}">
    <meta name="description" content="{{ $events->short_description }}">
    <meta property="og:image"
          content="@if($events->image) {{ asset($events->image) }} @else {{ asset('images/event.jpg') }} @endif"/>
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="{{ $events->title }}">
    <meta property="og:url"
          content="{{ route('frontend.event.details', ['id' =>$events->id, 'slug' => $events->slug]) }}">
    <meta property="og:type" content="article">
    <meta property="og:description" content="{{ $events->short_description }}">
    <meta name=twitter:card content="summary_large_image"/>
    <meta name=twitter:site content="{{ config('app.name') }}"/>
    <meta name=twitter:url
          content="{{ route('frontend.event.details', ['id' =>$events->id, 'slug' => $events->slug]) }}"/>
    <meta name=twitter:title content="{{ $events->title }}"/>
    <meta name=twitter:description content="{{ $events->short_description }}"/>
    <meta name=twitter:image
          content="@if($events->image) {{ asset($events->image) }} @else {{ asset('images/event.jpg') }} @endif"/>

@endsection

@section('content')
    <!-- breedcrumb section start  -->
    <x-frontend.breedcrumb-component :background="$cms->event_background">
        <x-slot name="items">
            <li class="breedcrumb__page-item">
                <a href="{{ route('frontend.event') }}"
                   class="breedcrumb__page-link text--body-3">{{ __('event_details') }}</a>
            </li>
        </x-slot>
    </x-frontend.breedcrumb-component>
    <div class="event_list mt-5 mb-5">
        <div class="container">
            @include('frontend.event.search_form')
            <div class="row">
                <div class="col-lg-9">
                    <!-- event item -->
                    <div class="event_details event_item mb-3">
                        <div class="event_time">
                            <h4>{{ __('Posted') }}
                                : {{\Carbon\Carbon::parse($events->created_at)->format('H:i A')}}</h4>
                        </div>
                        <div class="event_wrapper">
                            <div class="event_details_status">
                                <div class="ribbon-wrapper">
                                    @if($events->status == 1)
                                        @if($events->event_status == 1)
                                            <div class="ribbon bg-success">{{ __('Scheduled') }}</div>
                                        @endif
                                        @if($events->event_status == 2)
                                            <div class="ribbon bg-warning">{{ __('Canceled') }}</div>
                                        @endif
                                        @if($events->event_status == 3)
                                            <div class="ribbon bg-info">{{ __('Postponed') }}</div>
                                        @endif
                                    @else
                                        <div class="ribbon bg-info">{{ __('Inactive') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="event_img mb-2">
                                <img
                                    src="@if($events->image) {{ asset($events->image) }} @else {{ asset('images/event.jpg') }} @endif"
                                    class="w-100 rounded" alt="image">
                            </div>
                            <div class="event_content">

                                @if($events->all_day_event_status == 1)
                                    <div class="date">
                                        <span>{{\Carbon\Carbon::parse($events->start_date)->format('d M Y')}} - {{\Carbon\Carbon::parse($events->end_date)->format('d M Y')}}</span>
                                    </div>
                                @else
                                    <div class="date">
                                        <span>{{\Carbon\Carbon::parse($events->start_date)->format('d M Y')}} @ {{\Carbon\Carbon::parse($events->start_time)->format('H:i A')}}  - {{\Carbon\Carbon::parse($events->end_date)->format('d M Y')}}  @ {{\Carbon\Carbon::parse($events->end_time)->format('H:i A')}}</span>
                                    </div>
                                @endif

                                <h6>
                                    @if($events->cost == 0)
                                        <span class="text-success">{{ __('Free') }}</span>
                                    @else
                                        {{ changeCurrency(number_format($events->cost, 0, '.', ',')) }}
                                    @endif
                                </h6>

                                <h2>{{$events->title ?? ''}}</h2>

                                <p style="text-align: justify;">
                                    {{ $events->short_description }}
                                </p>
                                @if(isset($events->venue))
                                    <h2>{{ __('venue') }}</h2>
                                    <span>{{ __('name') }}: {{ $events->venue->name }}</span> <br>
                                    <span>{{ __('address') }}: {{ $events->venue->address }}</span> <br>
                                    <span>{{ __('state') }}: {{ $events->venue->state }}</span> <br>
                                    <span>{{ __('phone') }}: {{ $events->venue->phone }}</span> <br>
                                    <span>{{ __('website') }}: {{ $events->venue->website }}</span>
                                @endif

                                @if(isset($events->event_organiser) && $events->event_organiser->count() > 0)
                                    <h2 class="mt-3">{{ __('organiser') }}</h2>
                                    <div class="row mb-2">
                                        @foreach($events->event_organiser as $org)
                                            <div class="col-md-4">
                                                <span>{{ __('name') }}: {{ $org->name }}</span> <br>
                                                <span>{{ __('email') }}: {{ $org->email }}</span> <br>
                                                <span>{{ __('phone') }}: {{ $org->phone }}</span> <br>
                                                <span>{{ __('website') }}: {{ $org->website }}</span>
                                            </div>
                                        @endforeach
                                    </div>

                                @endif


                                <p>
                                    {!! $events->details !!}
                                </p>

                                <div class="shearEvent mb-4">
                                    <a target="__blank"
                                       href="https://calendar.google.com/calendar/u/0/r/eventedit?dates={{ date('Ymd', strtotime($events->start_date)) }}@if($events->start_time)T{{ date('his', strtotime($events->start_time)) }} @endif/{{date('Ymd', strtotime($events->end_date))}}@if($events->end_time)T{{ date('his', strtotime($events->end_time)) }} @endif&text={{$events->title}}&details={{$events->short_description}}&location=Vanuatu&trp=false&ctz=Australia/Adelaide&sprop=website:https://everisamting.com/"
                                       class="btn">
                                        {{ __('add_google_calender') }}
                                    </a>
                                </div>

                                <x-frontend.ad-details.ad-share :slug="$events->slug"/>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="event_sidebar position-sticky" style="top:8rem;">
                        <div class="event_widget mb-3">
                            <div class="sidebar_heading mb-3">
                                <h3>{{ __('categories') }}</h3>
                            </div>
                            <div class="category_list">
                                <ul>
                                    @foreach($categories as $category)
                                        <li>
                                            <a href="{{route('frontend.event.category', ['id' =>$category->id, 'slug' => $category->slug])}}">{{$category->name}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @if(isset($venues) && $venues->count() > 0)
                            <div class="event_widget mb-3">
                                <div class="sidebar_heading mb-3">
                                    <h3>{{ __('venues') }}</h3>
                                </div>
                                <div class="venues_item">
                                    <form class="search_event" action="{{ route('frontend.event') }}" method="get"
                                          id="event_form">
                                        @foreach ($venues as $venue)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="venue[]"
                                                       value="{{ $venue->id }}" id="venues{{ $venue->id }}"
                                                       onchange="filterVenue()" {{ request('venue') && in_array($venue->id, request('venue')) ? 'checked' : '' }}>
                                                <label class="form-check-label"
                                                       for="venues{{ $venue->id }}">{{ $venue->name }}</label>
                                            </div>
                                        @endforeach
                                    </form>
                                </div>
                            </div>
                        @endif
                        <div class="event_widget border-0">
                            <div class="sidebar_heading mb-3">
                                <h3>{{ __('tags') }}</h3>
                            </div>
                            <div class="city_list">
                                <ul>
                                    @foreach ($tags as $tag)
                                        <li>
                                            <a href="{{route('frontend.event.tags', ['id'=>$tag->id, 'slug'=>$tag->slug])}}">{{ $tag->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($related_event)
        <section class="section related_events pt-0">
            <div class="container">
                <div class="related-post__header card-header">
                    <h2 class="text--heading-1">{{ __('Related_Events') }}</h2>
                    @if($related_event->count() > 2)
                        <div class="slider-btn">
                            <button class="slider-btn--prev">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24"
                                     fill="none" stroke="#f27319" stroke-width="1.5" stroke-linecap="round"
                                     stroke-linejoin="bevel">
                                    <circle cx="12" cy="12" r="10"/>
                                    <path d="M12 8l-4 4 4 4M16 12H9"/>
                                </svg>
                            </button>
                            <button class="slider-btn--next">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24"
                                     fill="none" stroke="#f27319" stroke-width="1.5" stroke-linecap="round"
                                     stroke-linejoin="bevel">
                                    <circle cx="12" cy="12" r="10"/>
                                    <path d="M12 8l4 4-4 4M8 12h7"/>
                                </svg>
                            </button>
                        </div>
                    @endif
                </div>
                <div class="related_event_carousel">
                    <!-- event item -->
                    @forelse ($related_event as $rele_event)
                        <div class="event_item m-1">
                            <div class="event_time">
                                <h4>{{ __('Posted') }}
                                    : {{\Carbon\Carbon::parse($rele_event->created_at)->format('H:i A')}}</h4>
                            </div>
                            <div class="event_wrapper row g-0 position-relative">
                                <div class="col-lg-5 mb-3 order-lg-2">
                                    <div class="event_details_status">
                                        <div class="ribbon-wrapper">
                                            @if($rele_event->status == 1)
                                                @if($rele_event->event_status == 1)
                                                    <div class="ribbon bg-success">{{ __('Scheduled') }}</div>
                                                @endif
                                                @if($rele_event->event_status == 2)
                                                    <div class="ribbon bg-warning">{{ __('Canceled') }}</div>
                                                @endif
                                                @if($rele_event->event_status == 3)
                                                    <div class="ribbon bg-info">{{ __("Postponed") }}</div>
                                                @endif
                                            @else
                                                <div class="ribbon bg-info">{{ __("Inactive") }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="event_img">
                                        <a href="{{ route('frontend.event.details', ['id' =>$rele_event->id, 'slug' => $rele_event->slug]) }}">
                                            <img
                                                src="@if($rele_event->image) {{ asset($rele_event->image) }} @else {{ asset('images/event.jpg') }} @endif"
                                                class="w-100 rounded" alt="image">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-7 order-lg-1">
                                    <div class="event_content mb-lg-0 pe-lg-2">
                                        @if($rele_event->all_day_event_status == 1)
                                            <div class="date">
                                                <span>{{\Carbon\Carbon::parse($rele_event->start_date)->format('d M Y')}} @ {{\Carbon\Carbon::parse($rele_event->start_time)->format('H:i A')}}  - {{\Carbon\Carbon::parse($rele_event->end_date)->format('d M Y')}}  @ {{\Carbon\Carbon::parse($rele_event->end_time)->format('H:i A')}}</span>
                                            </div>
                                        @else
                                            <div class="date">
                                                <span>{{\Carbon\Carbon::parse($rele_event->start_date)->format('d M Y')}} - {{\Carbon\Carbon::parse($rele_event->end_date)->format('d M Y')}}</span>
                                            </div>
                                        @endif
                                        <h2>
                                            <a href="{{ route('frontend.event.details', ['id' =>$rele_event->id, 'slug' => $rele_event->slug]) }}">{{$rele_event->title ?? ''}}</a>
                                        </h2>

                                        <p style="text-align: justify;">
                                            {{ $rele_event->short_description }}
                                        </p>

                                        <h6>
                                            <span>
                                                @if($rele_event->cost == 0)
                                                    <span class="text-success">{{ __('Free') }}</span>
                                                @else
                                                    $ {{ $rele_event->cost }}
                                                @endif
                                            </span>
                                            <a href="{{ route('frontend.event.details', ['id' =>$rele_event->id, 'slug' => $rele_event->slug]) }}"
                                               class="float-end">View details</a>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="event_item mb-3 text-center mt-5">
                            <h4 class="text-danger">{{ __("no_data") }}</h4>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    @endif
@endsection


@section('frontend_style')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{ asset('frontend/css') }}/slick.css"/>
    <link rel="stylesheet" href="{{ asset('frontend/css') }}/swiper-bundle.min.css"/>
    <style>
        .card-header {
            border-bottom: 0px !important;
        }

        .shearEvent {
            overflow: hidden;
        }

        .share {
            display: -webkit-box !important;
        }

        .share li {
            margin-right: 8px !important;
        }
    </style>
    @stack('c_css')
@endsection

@section('frontend_script')
    <script src="{{ asset('frontend') }}/js/plugins/slick.min.js"></script>
    <script src="{{ asset('frontend') }}/js/plugins/swiper-bundle.min.js"></script>
    <script src="{{ asset('frontend') }}/js/swiperslider.config.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $(function () {
            $('.datepicker').datepicker({
                autoclose: true,
                format: "yyyy-mm-dd",
                immediateUpdates: true,
                todayBtn: true,
                todayHighlight: true
            }).datepicker("setDate", "0");

        });

        function filterVenue() {
            $('#event_form').submit()
        }

    </script>
    <script>
        function copyToClipboard() {
            let temp = $("<input>");
            $("body").append(temp);
            temp.val(window.location).select();
            document.execCommand("copy");
            temp.remove();
            alert("Copied to clipboard!");
        }
    </script>
    @stack('c_js')
@endsection
