@extends('admin.layouts.app')

@section('title')
    {{ __('Create Event Venues') }}
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
                                        <h3>Create Event Venues </h3>
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
                                <form action="{{ route('event-venues.store') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label >Venues Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" placeholder="Venues Name" required>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label >Phone <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="phone" placeholder="Phone" required>
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label >Country <span class="text-danger">*</span></label>
                                            <select name="country" class="form-control js-example-basic-single" required>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label >State <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="state" placeholder="State name" required>
                                            @error('state')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label >City <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="city" placeholder="City name" required>
                                            @error('city')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label >Address <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="address" placeholder="Address" required>
                                            @error('address')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label >Postal Code</label>
                                            <input type="text" class="form-control" name="postal_code" placeholder="Postal Code">
                                            @error('postal_code')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label >Website </label>
                                            <input type="text" class="form-control" name="website" placeholder="website url">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label class="col-md-4">Status <span class="text-danger">*</span></label>
                                            <select name="status" class="form-control" required>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 text-center">
                                            <button type="submit" class="btn btn-success">Create Event Venues</button>
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