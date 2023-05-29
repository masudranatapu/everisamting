@extends('admin.layouts.app')

@section('title')
    {{ __('Edit Event Venues') }}
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
                                        <h3>Edit Event Venues </h3>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a href="{{ route('event-venues.index') }}" type="button" class="btn btn-info">
                                            <i class="fas fa-backward mr-2"></i>
                                            Back
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('event-venues.update', $eventvenues->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label >Venues Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" placeholder="Venues Name" value="{{$eventvenues->name}}" required>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label >Phone <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="phone" placeholder="Phone" value="{{$eventvenues->phone}}" required>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label >Country <span class="text-danger">*</span></label>
                                            <select name="country" class="form-control js-example-basic-single" required>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}" @if($eventvenues->country == $country->id) selected @endif>{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label >State <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="state" placeholder="State name" value="{{$eventvenues->state}}" required>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label >City <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="city" placeholder="City name" value="{{$eventvenues->city}}" required>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label >Address <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="address" placeholder="Address" value="{{$eventvenues->address}}" required>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label >Postal Code</label>
                                            <input type="text" class="form-control" name="postal_code" value="{{$eventvenues->postal_code}}" placeholder="Postal Code">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label >Website </label>
                                            <input type="text" class="form-control" name="website" value="{{$eventvenues->website}}" placeholder="website url">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label class="col-md-4">Status <span class="text-danger">*</span></label>
                                            <select name="status" class="form-control" required>
                                                <option value="1" @if($eventvenues->status == 1) selected @endif>Active</option>
                                                <option value="0" @if($eventvenues->status == 0) selected @endif>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 text-center">
                                            <button type="submit" class="btn btn-success">Update Event Venues</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('massage/toastr/toastr.css')}}">
    <style>
        .select2-container .select2-selection--single {
            height: 38px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            margin-top: 4px !important;
        }

    </style>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
    
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
@endsection