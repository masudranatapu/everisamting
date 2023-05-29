@extends('admin.layouts.app')

@section('title')
    '{{ $customer->name }}' {{ __('wise') }} {{ __('ads') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">'{{ $customer->name }}' {{ __('wise') }}
                            {{ __('ads') }}</h3>
                        <a href="{{ route('module.customer.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp; {{ __('back') }}</a>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <x-backend.ad-manage :ads="$ads" :showCustomer="false" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
