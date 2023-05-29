@extends('admin.layouts.app')

@section('title')
    {{ __('edit_service_type') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('edit_service_type') }}</h3>
                        <a href="{{ route('module.serviceType.index') }}"
                           class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp;{{ __('back') }}</a>
                    </div>
                    <div class="row pt-3 pb-4">
                        <div class="col-md-6 offset-md-3">
                            <form class="form-horizontal" action="{{ route('module.serviceType.update', $service_type->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <x-forms.label name="service_type" required="true" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input value="{{ $service_type->name }}" name="service_type" type="text"
                                               class="form-control @error('service_type') is-invalid @enderror"
                                               placeholder="{{ __('enter_service_type') }}">
                                        @error('service_type')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="status" required="true" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <select name="status" id="status" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="0" {{ $service_type->status == '0' ? 'active' : '' }} >Inactive</option>
                                        </select>
                                        @error('status')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-4">
                                        <button type="submit" class="btn btn-success"><i
                                                class="fas fa-plus"></i>&nbsp;{{ __('add_service_type') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
@endsection

@section('script')
@endsection
