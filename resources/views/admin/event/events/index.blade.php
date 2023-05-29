@extends('admin.layouts.app')

@section('title')
    {{ __('Events List') }}
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3>Events List <span class="badge bg-blue">{{ $events->count() }}</span></h3>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a href="{{ route('events.create') }}" type="button" class="btn btn-success" >
                                            <i class="fa fa-plus"></i>
                                            Add Event
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Image</th>
                                            <th>Cost</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Event Status</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($events as $event)
                                            <tr>
                                                <td>
                                                    {{$event->title}}
                                                </td>
                                                <td>
                                                    <img width="50" height="50" src="@if($event->image) {{ asset($event->image) }} @else {{ asset('images/event.jpg') }} @endif" alt="">
                                                </td>
                                                <td>
                                                    @if($event->cost == 0)
                                                        <span class="text-success">Free</span>
                                                    @else
                                                        {{ $event->cost }}
                                                    @endif
                                                </td>
                                                <td>
                                                    {{\Carbon\Carbon::parse($event->start_date)->format('d M Y')}}
                                                </td>
                                                <td>
                                                    {{\Carbon\Carbon::parse($event->end_date)->format('d M Y')}}
                                                </td>
                                                <td>
                                                    @if($event->event_status == 1)
                                                        <span class="badge bg-success">Scheduled</span>
                                                    @endif

                                                    @if($event->event_status == 2)
                                                        <span class="badge bg-danger">Canceled</span>
                                                    @endif

                                                    @if($event->event_status == 3)
                                                        <span class="badge bg-info">Postponed</span>
                                                    @endif

                                                </td>
                                                <td>
                                                    @if($event->status == 1)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-Info">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('events.show', $event->id) }}" title="Edit event show" type="button" title="View Events Details" class="btn btn-info" >
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('events.edit', $event->id) }}" title="Edit event edit" type="button" title="Edit Event" class="btn btn-warning">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="javascript:;" title="Edit event edit" type="button" title="Delete Events" class="btn btn-danger" onclick="formSubmit({{ $event->id }})">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <form id="delete-form-{{ $event->id }}" action="{{ route('events.destroy', $event->id) }}" method="POST" class="d-none">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-12">
                                        {!! $events->links() !!}
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

@section('script')
    <script>
        function formSubmit(id) {

            if(!confirm("Do you really want to delete this?")) {
                return false;
            }

            document.getElementById('delete-form-'+id).submit();

        }
    </script>
@endsection