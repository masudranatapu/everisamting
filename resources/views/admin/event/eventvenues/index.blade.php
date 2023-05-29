@extends('admin.layouts.app')

@section('title')
    {{ __('Event Venues') }}
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
                                        <h3>Event Venues List <span class="badge bg-blue">{{ $eventvenues->count() }}</span></h3>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a href="{{ route('event-venues.create') }}" type="button" class="btn btn-success">
                                            <i class="fa fa-plus"></i>
                                            Add Event venues
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>SL No</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Country</th>
                                            <th>City</th>
                                            <th>State</th>
                                            <th>Address</th>
                                            <th>Website</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($eventvenues as $key => $venues)
                                            @php
                                                $countries = DB::table('country')->where('id', $venues->country)->first();
                                            @endphp
                                            <tr>
                                                <td>{{ $key + 1}}</td>
                                                <td>{{ $venues->name }}</td>
                                                <td>
                                                    <a href="tel:{{ $venues->name }}">{{ $venues->name }}</a>
                                                </td>
                                                <td>{{ $countries->name ?? '' }}</td>
                                                <td>{{ $venues->city }}</td>
                                                <td>{{ $venues->state }}</td>
                                                <td>{{ $venues->address }}</td>
                                                <td>
                                                    <a target="__blank" href="https://{{ $venues->website }}">{{ $venues->website }}</a>
                                                </td>
                                                <td>
                                                    @if($venues->status == 1)
                                                        <span class="badge bg-success">Active</span>
                                                    @else 
                                                        <span class="badge bg-info">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a title="Edit event venues" type="button" class="btn btn-warning" href="{{ route('event-venues.edit', $venues->id) }}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button title="Delete event venues" class="btn btn-danger waves-effect" type="button" onclick="formSubmit({{ $venues->id }})">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    <form id="delete-form-{{ $venues->id }}" action="{{ route('event-venues.destroy', $venues->id) }}" method="POST" class="d-none">
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
                                        {!! $eventvenues->links() !!}
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

@section('style')
    <link rel="stylesheet" href="{{asset('massage/toastr/toastr.css')}}">
@endsection

@section('script')
    <script src="{{asset('massage/toastr/toastr.js')}}"></script>
    {!! Toastr::message() !!}
    <script>
        @if($errors->any())
            @foreach($errors->all() as $error)
                toastr.error('{{ $error }}','Error',{
                    closeButton:true,
                    progressBar:true,
                });
            @endforeach
        @endif
    </script>
    
    <script>
        function formSubmit(id) {

            if(!confirm("Do you really want to delete this?")) {
                return false;
            }

            document.getElementById('delete-form-'+id).submit();

        }
    </script>

@endsection