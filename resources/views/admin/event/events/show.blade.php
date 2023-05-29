@extends('admin.layouts.app')

@section('title')
    {{ __('Events Details') }}
@endsection

@section('content')
    @php
        $categories = json_decode($events->category_id);
        $tags = json_decode($events->tag_id);
        $organisers = json_decode($events->organiser_id);
        $users = DB::table('users')->where('id', $events->user_id)->first();
        $updateby = DB::table('admins')->where('id', $events->updated_by)->first();
        $venues = DB::table('event_venues')->where('id', $events->venue_id)->first();
    @endphp
    <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3>Events Details</h3>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a href="{{ route('events.index') }}" type="button" class="btn btn-success" >
                                            <i class="fas fa-backward mr-2"></i>
                                            Back
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3>Event image</h3>
                                            </div>
                                            <div class="card-body">
                                                <img style="width: 100%; height:300px;" src="@if($events->image) {{ asset($events->image) }} @else {{ asset('images/event.jpg') }} @endif" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3>Event Info</h3>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-hover table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td width="25%">
                                                                Title 
                                                            </td>
                                                            <td width="75%">
                                                                {{$events->title}}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="25%">
                                                                Cost 
                                                            </td>
                                                            <td width="75%">
                                                                @if($events->cost == 0)
                                                                    <span class="text-success">Free</span>
                                                                @else
                                                                    <span>{{ $events->cost }}</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="25%">
                                                                Start Date 
                                                            </td>
                                                            <td width="75%">
                                                                {{\Carbon\Carbon::parse($events->start_date)->format('d M Y')}}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="25%">
                                                                Start Time 
                                                            </td>
                                                            <td width="75%">
                                                                @if($events->start_time)
                                                                    {{\Carbon\Carbon::parse($events->start_time)->format('H:i A')}}
                                                                @else 
                                                                    <span class="text-success">All Day Event</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="25%">
                                                                End Date
                                                            </td>
                                                            <td width="75%">
                                                                {{\Carbon\Carbon::parse($events->end_date)->format('d M Y')}}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="25%">
                                                                End Time
                                                            </td>
                                                            <td width="75%">
                                                                @if($events->end_time)
                                                                    {{\Carbon\Carbon::parse($events->end_time)->format('H:i A')}}
                                                                @else 
                                                                    <span class="text-success">All Day Event</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="25%">
                                                                Timezone 
                                                            </td>
                                                            <td width="75%">
                                                                {{$events->timezone}}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="25%">
                                                                Category 
                                                            </td>
                                                            <td width="75%">
                                                                @if($categories)
                                                                    <table class="table table-stripe">
                                                                        <tbody>
                                                                            @foreach ($categories as $cate)
                                                                                @php
                                                                                    $category = DB::table('event_categories')->where('id', $cate)->first();
                                                                                @endphp
                                                                                @if($category)
                                                                                    <tr>
                                                                                        <td>{{ $category->name }}</td>
                                                                                    </tr>
                                                                                @endif
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                @else
                                                                    <span class="text-danger">No Data</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="25%">
                                                                Tags 
                                                            </td>
                                                            <td width="75%">
                                                                @if($tags)
                                                                    <table class="table table-stripe">
                                                                        <tbody>
                                                                            @foreach ($tags as $tag)
                                                                                @php
                                                                                    $tag_name = DB::table('event_tags')->where('id', $tag)->first();
                                                                                @endphp
                                                                                @if($tag_name)
                                                                                    <tr>
                                                                                        <td>{{ $tag_name->name }}</td>
                                                                                    </tr>
                                                                                @endif
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                @else
                                                                    <span class="text-danger">No Data</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="25%">
                                                                Organiser 
                                                            </td>
                                                            <td width="75%">
                                                                @if($organisers)
                                                                    <table class="table table-stripe">
                                                                        <tbody>
                                                                            @foreach ($organisers as $organiser)
                                                                                @php
                                                                                    $organiser_name = DB::table('event_organiser')->where('id', $organiser)->first();
                                                                                @endphp
                                                                                @if($organiser_name)
                                                                                    <tr>
                                                                                        <td>{{ $organiser_name->name }}</td>
                                                                                    </tr>
                                                                                @endif
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                @else
                                                                    <span class="text-danger">No Data</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @if($events->event_info_link)
                                                            <tr>
                                                                <td width="25%">
                                                                    Event Info Link 
                                                                </td>
                                                                <td width="75%">
                                                                    <a target="__blank" href="https://{{$events->event_info_link}}">{{$events->event_info_link}}</a>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                        <tr>
                                                            <td width="25%">
                                                                Venue
                                                            </td>
                                                            <td width="75%">
                                                                @if($venues)
                                                                    {{ $venues->name }}
                                                                @else
                                                                    <span class="text-danger">No Data</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="25%">
                                                                All Day Event Status 
                                                            </td>
                                                            <td width="75%">
                                                                @if($events->all_day_event_status == 1)
                                                                    <span class="badge bg-success">Yes</span>
                                                                @else
                                                                    <span class="badge bg-danger">No</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="25%">
                                                                Wheelchair 
                                                            </td>
                                                            <td width="75%">
                                                                @if($events->wheelchair == 1)
                                                                    <span class="badge bg-success">Yes</span>
                                                                @else
                                                                    <span class="badge bg-danger">No</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="25%">
                                                                Accessible 
                                                            </td>
                                                            <td width="75%">
                                                                @if($events->accessible == 1)
                                                                    <span class="badge bg-success">Yes</span>
                                                                @else
                                                                    <span class="badge bg-danger">No</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="25%">
                                                                Event Status 
                                                            </td>
                                                            <td width="75%">
                                                                @if($events->event_status == 1)
                                                                    <span class="badge bg-success">Scheduled</span>
                                                                @endif
            
                                                                @if($events->event_status == 2)
                                                                    <span class="badge bg-danger">Canceled</span>
                                                                @endif
            
                                                                @if($events->event_status == 3)
                                                                    <span class="badge bg-info">Postponed</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @if($events->event_status == 2 || $events->event_status == 3)
                                                            @if($events->event_status_reason)
                                                                <tr>
                                                                    <td width="25%">
                                                                        Reason

                                                                        (  
                                                                            @if($events->event_status == 2)
                                                                                <span class="text-danger">For  Canceled</span>
                                                                            @endif
                        
                                                                            @if($events->event_status == 3)
                                                                                <span class="text-info">For Postponed</span>
                                                                            @endif

                                                                        )
                                                                    </td>
                                                                    <td width="75%">
                                                                        {!! $events->event_status_reason !!}
                                                                    </td>
                                                                </tr>
                                                            @else
                                                                <tr>
                                                                    <td width="25%">
                                                                        Reason
                                                                        (  
                                                                            @if($events->event_status == 2)
                                                                                <span class="text-danger">For  Canceled</span>
                                                                            @endif
                        
                                                                            @if($events->event_status == 3)
                                                                                <span class="text-info">For Postponed</span>
                                                                            @endif

                                                                        )
                                                                    </td>
                                                                    <td width="75%">
                                                                        No Reason
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endif
                                                        <tr>
                                                            <td width="25%">
                                                                Status 
                                                            </td>
                                                            <td width="75%">
                                                                @if($events->status == 1)
                                                                    <span class="badge bg-success">Active</span>
                                                                @else
                                                                    <span class="badge bg-danger">Inactive</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="25%">
                                                                Event Create By 
                                                            </td>
                                                            <td width="75%">
                                                                {{$users->name ?? ''}}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="25%">
                                                                Event Created at
                                                            </td>
                                                            <td width="75%">
                                                                {{\Carbon\Carbon::parse($events->created_at)->format('d M Y')}}
                                                            </td>
                                                        </tr>
                                                        @if($events->updated_at)
                                                            <tr>
                                                                <td width="25%">
                                                                    Event Updated at
                                                                </td>
                                                                <td width="75%">
                                                                    {{\Carbon\Carbon::parse($events->updated_at)->format('d M Y')}}
                                                                </td>
                                                            </tr>
                                                        @endif
                                                        @if($updateby)
                                                            <tr>
                                                                <td width="25%">
                                                                    Event Updated By
                                                                </td>
                                                                <td width="75%">
                                                                    {{$updateby->name ?? ''}}
                                                                </td>
                                                            </tr>
                                                        @endif
                                                        <tr>
                                                            <td width="25%">
                                                                Short Description
                                                            </td>
                                                            <td width="75%">
                                                                <p style="text-align: justify;">
                                                                    {{ $events->short_description }}
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="25%">
                                                                Details
                                                            </td>
                                                            <td width="75%" style="text-align: justify;">
                                                                {!! $events->details !!}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection