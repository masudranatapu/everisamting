@extends('layouts.frontend.layout_one')

@section('title', __('Event_List'))


@section('content')
    <!-- breedcrumb section start  -->
    <x-frontend.breedcrumb-component :background="$cms->event_background">
        <x-slot name="items">
            <li class="breedcrumb__page-item">
                <a href="{{ route('frontend.event') }}" class="breedcrumb__page-link text--body-3">{{ __('Event_List')
                }}</a>
            </li>
        </x-slot>
    </x-frontend.breedcrumb-component>
    <div class="event_list mt-5 mb-5">
        <div class="container">
            @include('frontend.event.search_form')
            <div class="row g-4">
                <div class="col-lg-9">
                    <div class="event_list_wrapper">
                        <div id='calendar'></div>
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
                                    @foreach ($categories as $category)
                                        <li><a
                                                href="{{ route('frontend.event.category', ['id' => $category->id, 'slug' => $category->slug]) }}">{{
                                        $category->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
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
                                                   onchange="filterVenue()" {{
                                        request('venue') && in_array($venue->id, request('venue')) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="venues{{ $venue->id }}">{{ $venue->name
                                        }}</label>
                                        </div>
                                    @endforeach
                                </form>
                            </div>
                        </div>
                        <div class="event_widget border-0">
                            <div class="sidebar_heading mb-3">
                                <h3>{{ __('tags') }}</h3>
                            </div>
                            <div class="city_list">
                                <ul>
                                    @foreach ($tags as $tag)
                                        <li><a
                                                href="{{ route('frontend.event.tags', ['id' => $tag->id, 'slug' => $tag->slug]) }}">{{
                                        $tag->name }}</a>
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
@endsection

@section('frontend_style')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <style>
        .tooltipevent {
            width: 200px;
            /*
                height:100px;*/
            background: #ccc;
            position: absolute;
            z-index: 10001;
            transform: translate3d(-50%, -100%, 0);
            font-size: 0.8rem;
            box-shadow: 1px 1px 3px 0px #888888;
            line-height: 1rem;
        }

        .tooltipevent div {
            padding: 10px;
        }

        .tooltipevent div:first-child {
            font-weight: bold;
            color: White;
            background-color: #888888;
            border: solid 1px black;
        }

        .tooltipevent div:last-child {
            background-color: whitesmoke;
            position: relative;
        }

        .tooltipevent div:last-child::after,
        .tooltipevent div:last-child::before {
            width: 0;
            height: 0;
            border: solid 5px transparent;
            /*
                box-shadow: 1px 1px 2px 0px #888888;*/
            border-bottom: 0;
            border-top-color: whitesmoke;
            position: absolute;
            display: block;
            content: "";
            bottom: -4px;
            left: 50%;
            transform: translateX(-50%);
        }

        .tooltipevent div:last-child::before {
            border-top-color: #888888;
            bottom: -5px;
        }


    </style>
    @stack('c_css')
@endsection

@php
    if (request()->date) {
    $date = date('Y-m-d', strtotime(request()->date));
    // dd($date);
    } else {
    $date = date('Y-m-d');
    }
@endphp


@section('frontend_script')
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $(function () {
            $('.datepicker').datepicker({
                autoclose: true,
                format: "yyyy-mm-dd",
                immediateUpdates: true,
                todayBtn: true,
                todayHighlight: true
            });

        });

        function filterVenue() {
            $('#event_form').submit()
        }


    </script>
    <script src="{{ asset('frontend/js/index.global.min.js') }}"></script>
    <script>
        let events = [
                @foreach ($events as $event)
            {
                title: "{{ $event->title }}",
                id: "{{ $event->id }}",
                url: "{{ route('frontend.event.details', ['id' => $event->id, 'slug' => $event->slug]) }}",
                start: "{{ $event->start }}",
                end: "{{ $event->end }}",
                des: "{{ Str::limit(strip_tags($event->details), 30) }}",
            },
            @endforeach
        ];
        console.log(events);

        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                customButtons: {
                    createBtn: {
                        text: 'Create_Event',
                        click: function () {
                            window.location.href = "{{ route('frontend.event.create') }}";
                        }
                    }
                },
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,listDay'
                },
                buttonText: {
                    today: 'Today',
                    listDay: 'Day',
                    dayGridMonth: 'Month',
                },
                initialDate: '{{ $date }}',
                navLinks: true, // can click day/week names to navigate views
                selectable: true,
                selectMirror: true,
                editable: true,
                dayMaxEvents: true, // allow "more" link when too many events
                timeZone: 'pacific/efate',
                events: events,
                // eventMouseEnter: function(info) {
                //     // $.ajax({
                //     //     type: "GET",
                //     //     url: "{{ route('frontend.event.tooltip') }}",
                //     //     data: {
                //     //         id: info.event.id
                //     //     },
                //     //     success: function(data) {
                //             console.log(info.event.des);
                //             // $(data.html).appendTo('body');
                //             var tis = info.el;
                //             var tooltip = '<div class="tooltipevent" style="top:' + ($(tis)
                //                     .offset().top - 5) + 'px;left:' + ($(tis).offset()
                //                     .left + ($(tis).width()) / 2) + 'px"><div>' + info.event
                //                 .title + '</div><div>' + info.event.des +
                //                 '</div></div>';
                //             $('body').append(tooltip);

                //     //     }
                //     // });
                // },
                // eventMouseLeave: function(info) {
                //     console.log('eventMouseLeave');
                //     $(info.el).css('z-index', 8);
                //     $('.tooltipevent').remove();
                // },
            });

            calendar.render();
        });
    </script>
    @stack('c_js')
@endsection
