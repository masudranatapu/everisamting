@extends('admin.settings.setting-layout')
@section('title')
    {{ __('Create Currency') }}
@endsection
@section('website-settings')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('create_currency') }}</h3>
                        <a href="{{ route('module.currency.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center   justify-content-center"><i
                                class="fas fa-arrow-left"></i>
                            &nbsp; {{ __('back') }}
                        </a>
                    </div>
                    <div class="row pt-3 pb-4">
                        <div class="col-md-6 offset-md-3">
                            <form class="form-horizontal" action="{{ route('module.currency.store') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <x-forms.label name="name" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input type="text" name="name" id="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name') }}" placeholder="{{ __('E.g - Dollar') }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="code" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input type="text" name="code" id="code"
                                            class="form-control @error('code') is-invalid @enderror"
                                            value="{{ old('code') }}" placeholder="{{ __('E.g - USD') }}">
                                        @error('code')
                                            <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="symbol" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input type="text" name="symbol" id="symbol"
                                            class="form-control @error('symbol') is-invalid @enderror"
                                            value="{{ old('symbol') }}" placeholder="E.g - $">
                                        @error('symbol')
                                            <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="position" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <x-forms.switch-input button="buttonOne" oldvalue="oldalue" name="symbol_position" onText="{{ __('left') }}" offText="{{ __('right') }}" value="left" :checked="0" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-4">
                                        <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i>&nbsp;
                                            {{ __('create') }}</button>
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

@section('script')
    <script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script>

        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })

        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })

        $("input[name=symbol_position]").on('switchChange.bootstrapSwitch', function (event, state) {
            let val = event.currentTarget.checked ? 'left' : 'right';
            $('input[name=symbol_position]').val(val);
        });
    </script>
@endsection
