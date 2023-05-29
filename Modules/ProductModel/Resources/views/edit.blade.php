@extends('admin.layouts.app')

@section('title')
    {{ __('edit_product_model') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('edit_product_model') }}</h3>
                        <a href="{{ route('module.model.index') }}"
                           class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp;{{ __('back') }}</a>
                    </div>
                    <div class="row pt-3 pb-4">
                        <div class="col-md-6 offset-md-3">
                            <form class="form-horizontal" action="{{ route('module.model.update', $model->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <x-forms.label name="brand" required="true" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <select name="brand_id" id="brand_id" class="form-control select2">
                                            <option value="" selected disabled>{{ __('select_brand') }}</option>
                                            @foreach($brands as $brand)
                                                <option value="{{ $brand->id }}" {{ $model->brand_id == $brand->id ? 'selected' : '' }} >{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('brand_id')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="name" required="true" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input value="{{ $model->name }}" name="name" type="text"
                                               class="form-control @error('name') is-invalid @enderror"
                                               placeholder="{{ __('enter_name') }}">
                                        @error('name')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="status" required="true" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <select name="status" id="status" class="form-control">
                                            <option value="1">{{ __('active') }}</option>
                                            <option value="0" {{ $model->status == '0' ? 'active' : '' }} >{{ __('inactive') }}</option>
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
                                                class="fas fa-plus"></i>&nbsp;{{ __('update') }}</button>
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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container .select2-selection--single {
            height: 38px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow{
            height: 36px !important;
        }
    </style>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $('.select2').select2();
    </script>
@endsection
