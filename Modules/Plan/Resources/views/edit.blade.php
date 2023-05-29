@extends('admin.layouts.app')
@section('title')
    {{ __('edit_plan') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('edit_plan') }}</h3>
                        <a href="{{ route('module.plan.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center">
                            <i class="fas fa-arrow-left"></i>&nbsp; {{ __('back') }}
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('module.plan.update', $plan->id) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="row">
                                @if ($setting->subscription_type == 'recurring')
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <x-forms.label name="plan_type" required="true" for="ad_limit"
                                                for="plan_type" />
                                            <select name="interval" class="custom-select mr-sm-2" id="plan_type">
                                                <option {{ $plan->interval == 'monthly' ? 'selected' : '' }}
                                                    value="monthly">
                                                    {{ __('monthly') }}
                                                </option>
                                                <option {{ $plan->interval == 'yearly' ? 'selected' : '' }}
                                                    value="yearly">
                                                    {{ __('yearly') }}
                                                </option>
                                                <option {{ $plan->interval == 'custom_date' ? 'selected' : '' }}
                                                    value="custom_date">
                                                    {{ __('plan_duration') }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 {{ $plan->interval == 'custom_date' ? '' : 'd-none' }}"
                                        id="interval_date">
                                        <div class="form-group">
                                            <x-forms.label name="interval_days" required="true"
                                                for="custom_interval_days" />
                                            <input type="number" min="1" id="custom_interval_days"
                                                name="custom_interval_days"
                                                value="{{ old('custom_interval_days', $plan->custom_interval_days) }}"
                                                class="form-control @error('custom_interval_days') is-invalid @enderror"
                                                placeholder="{{ __('interval_days') }}">
                                            @error('custom_interval_days')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <x-forms.label name="label" required="true" for="label" />
                                        <input type="text" id="label" name="label" value="{{ $plan->label }}"
                                            class="form-control @error('label') is-invalid @enderror"
                                            placeholder="{{ __('basic') }} / {{ __('standard') }} / {{ __('premium') }}">
                                        @error('label')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <x-forms.label name="ad_limit" required="true" for="ad_limit" />
                                        <input type="number" id="ad_limit" name="ad_limit"
                                            value="{{ $plan->ad_limit }}"
                                            class="form-control @error('ad_limit') is-invalid @enderror">
                                        @error('ad_limit')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <x-forms.label name="price" required="true" for="price">
                                            ({{ config('zakirsoft.currency_symbol') }})
                                        </x-forms.label>
                                        <input type="number" id="price" name="price" value="{{ $plan->price }}"
                                            class="form-control @error('price') is-invalid @enderror">
                                        @error('price')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <x-forms.label name="featured_limit" required="true" for="featured_limit" />
                                        <input type="number" id="featured_limit" name="featured_limit"
                                            value="{{ $plan->featured_limit }}"
                                            class="form-control @error('featured_limit') is-invalid @enderror">
                                        @error('featured_limit')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">{{ __('business_directory_limit') }} <span class="text-danger">*</span></label>
                                        <input type="number" name="business_directory_limit"
                                            value="{{ $plan->business_directory_limit }}"
                                            class="form-control @error('business_directory_limit') is-invalid @enderror">
                                        @error('business_directory_limit')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <x-forms.label name="premium_badge" for="badge" />
                                        <select name="badge" id="badge"
                                            class="form-control @error('badge') is-invalid @enderror">
                                            <option value="1" {{ $plan->badge == true ? 'selected' : '' }}>
                                                {{ __('yes') }}</option>
                                            <option value="0" {{ $plan->badge == false ? 'selected' : '' }}>
                                                {{ __('no') }}</option>
                                        </select>
                                        @error('badge')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <button class="btn btn-success" type="submit"><i class="fas fa-sync"></i>&nbsp;
                                    {{ __('update') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        if ('{{ $plan->interval }}' == 'custom_date') {
            $('#interval_date').removeClass('d-none');
        }

        $(document).ready(function() {
            $('#plan_type').on('change', function() {
                if ($(this).val() == 'custom_date') {
                    $('#interval_date').removeClass('d-none');
                } else {
                    $('#interval_date').addClass('d-none');
                }
            });
        });
    </script>
@endsection
