@extends('admin.settings.setting-layout')
@section('title')
    {{ __('cookies_settings') }}
@endsection

@section('website-settings')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title" style="line-height: 36px;">{{ __('cookies_settings') }}</h3>
        </div>
        <div class="row pt-3 pb-4">
            <div class="col-md-8 offset-md-2">
                <form class="form-horizontal" action="{{ route('settings.cookies.update') }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group row">
                        <x-forms.label for="allow_cookies" name="allow_cookies_consent" :required="false"
                            class="col-md-4 pt-2" />
                        <div class="col-md-8">
                            <input type="checkbox" id="allow_cookies" {{ $cookie->allow_cookies ? 'checked' : '' }}
                                name="allow_cookies" data-on-color="success" data-on-text="{{ __('yes') }}"
                                data-off-color="warning" data-off-text="{{ __('no') }}" data-size="large"
                                value="1">
                            <x-forms.error name="allow_cookies" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-forms.label for="cookie_name" name="{{ __('cookie_name') }}" class="col-md-4" />
                        <div class="col-md-8">
                            <select name="cookie_name" id="cookie_name" class="form-control">
                                <option value="gdpr_cookie" @if ($cookie->cookie_name == 'gdpr_cookie') selected @endif>
                                    {{ __('gdpr_cookie') }} </option>
                                <option value="ccpa_cookie" @if ($cookie->cookie_name == 'ccpa_cookie') selected @endif>
                                    {{ __('ccpa_cookie') }}</option>
                                <option value="lgpd_cookie" @if ($cookie->cookie_name == 'lgpd_cookie') selected @endif>
                                    {{ __('lgpd_cookie') }} </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-forms.label for="cookie_expiration"
                            name="{{ __('cookie_expiration') }} ({{ __('days') }})" class="col-md-4" />
                        <div class="col-md-8">
                            <x-forms.input type="number" max="365" id="cookie_expiration" name="cookie_expiration"
                                placeholder="{{ __('enter_cookie_expiration_day') }}"
                                value="{{ $cookie->cookie_expiration }}" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-forms.label for="force_consent" name="{{ __('force_consent') }}" :required="false"
                            class="col-md-4 pt-2" />
                        <div class="col-md-8">
                            <input type="checkbox" id="force_consent" {{ $cookie->force_consent ? 'checked' : '' }}
                                name="force_consent" data-on-color="success" data-on-text="{{ __('yes') }}"
                                data-off-color="warning" data-off-text="{{ __('no') }}" data-size="large"
                                value="1">
                            <x-forms.error name="force_consent" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-forms.label for="darkmode" name="{{ __('theme') }}" :required="false" class="col-md-4 pt-2" />
                        <div class="col-md-8">
                            <input type="checkbox" id="darkmode" {{ $cookie->darkmode ? 'checked' : '' }}
                                name="darkmode" data-on-color="dark" data-on-text="{{ __('Dark') }}"
                                data-off-color="light" data-off-text="{{ __('Light') }}" data-size="large"
                                value="1">
                            <x-forms.error name="darkmode" />
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <x-forms.label for="title" name="{{ __('title') }}" class="col-md-4" />
                        <div class="col-md-8">
                            <x-forms.input type="text" id="title" name="title"
                                placeholder="{{ __('enter_title') }}" value="{{ $cookie->title }}" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-forms.label for="approve_button_text" name="{{ __('approve_button_text') }}"
                            class="col-md-4" />
                        <div class="col-md-8">
                            <x-forms.input type="text" id="approve_button_text" name="approve_button_text"
                                placeholder="{{ __('enter_approve_button_text') }}"
                                value="{{ $cookie->approve_button_text }}" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-forms.label for="decline_button_text" name="{{ __('reject_button_text') }}"
                            class="col-md-4" />
                        <div class="col-md-8">
                            <x-forms.input type="text" id="decline_button_text" name="decline_button_text"
                                placeholder="{{ __('enter_reject_button_text') }}"
                                value="{{ $cookie->decline_button_text }}" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <x-forms.label for="description" name="description" class="col-md-4" />
                        <div class="col-md-8">
                            <textarea id="description" name="description">{!! $cookie->description !!}</textarea>
                        </div>
                    </div>
                    @if (userCan('setting.update'))
                        <div class="form-group row">
                            <div class="offset-sm-3 col-sm-9">
                                <button type="submit" class="btn btn-success"><i class="fas fa-sync"></i>
                                    {{ __('Update') }}</button>
                            </div>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet"
        href="{{ asset('backend/plugins/bootstrap-switch/css/bootstrap4/bootstrap-switch.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.min.css') }}">
@endsection

@section('script')
    <script src="{{ asset('backend/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $("#allow_cookies").bootstrapSwitch();
        $("#force_consent").bootstrapSwitch();
        $("#darkmode").bootstrapSwitch();
        $('#description').summernote({
            placeholder: '{{ __('Write description') }}',
            tabsize: 4,
            height: 200
        });
    </script>
@endsection
