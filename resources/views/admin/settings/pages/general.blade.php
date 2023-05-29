@extends('admin.settings.setting-layout')
@section('title')
    {{ __('website_setting') }}
@endsection
@section('website-settings')
    <div class="row">
        <div class="col-xl-6 col-lg-12">
            <div class="card mb-3">
                <div class="card-header">
                    {{ __('basic_setting') }}
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('settings.general.update') }}" method="POST"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row ">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="" for="site_name"> {{ __('site_name') }} </label>
                                    <input value="{{ config('app.name') }}" name="name" type="text"
                                        class="form-control " placeholder="{{ __('enter') }} {{ __('site_name') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3 col-md-3">
                                <x-forms.label name="{{ __('logo') }}" />
                                <input type="file" class="form-control dropify"
                                    data-default-file="{{ $setting->logo_image_url }}" name="logo_image"
                                    data-allowed-file-extensions='["jpg", "jpeg","png","svg"]'
                                    accept="image/png, image/jpg,image/svg image/jpeg" data-max-file-size="3M">
                            </div>
                            <div class="col-sm-3 col-md-3">
                                <x-forms.label name="{{ __('white_logo') }}" />
                                <input type="file" class="form-control dropify"
                                    data-default-file="{{ $setting->white_logo_url }}" name="white_logo"
                                    data-allowed-file-extensions='["jpg", "jpeg","png","svg"]'
                                    accept="image/png, image/jpg,image/svg image/jpeg" data-max-file-size="3M">
                            </div>
                            <div class="col-sm-3 col-md-3">
                                <x-forms.label name="{{ __('favicon') }}" />
                                <input type="file" class="form-control dropify"
                                    data-default-file="{{ $setting->favicon_image_url }}" name="favicon_image"
                                    data-allowed-file-extensions='["ico","png"]' accept="image/png, image/ico"
                                    data-max-file-size="1M">
                            </div>
                            <div class="col-sm-3 col-md-3">
                                <label for="">Website Loader Image</label>
                                <input type="file" class="form-control dropify"
                                    data-default-file="{{ asset($setting->loader_image) }}" name="loader_image"
                                    data-allowed-file-extensions='["ico","png", "gif"]' accept="image/png, image/ico, image/gif"
                                    data-max-file-size="1M">
                            </div>
                            <div class="row mt-3 mx-auto">
                                @if (userCan('setting.update'))
                                    <button type="submit" class="btn btn-success"><i class="fas fa-sync"></i>
                                        {{ __('update') }}</button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            {{-- Google recaptcha Setting --}}
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('recaptcha_configuration') }}
                        </h3>
                        <div class="form-group row">
                            <input id="recaptcha_switch" {{ config('captcha.active') ? 'checked' : '' }} type="checkbox"
                                name="status" data-bootstrap-switch value="1" data-on-text="{{ __('on') }}"
                                data-off-color="default" data-on-color="success" data-off-text="{{ __('off') }}">
                        </div>
                    </div>
                </div>
                @if (config('captcha.active'))
                    <form id="recaptchaForm" class="form-horizontal" action="{{ route('settings.recaptcha.update') }}"
                        method="POST">
                        @method('PUT')
                        @csrf
                        <div class="card-body">

                            <div class="form-group row">
                                <x-forms.label name="nocaptcha_secret" class="col-sm-5" />
                                <div class="col-sm-7">
                                    <input value="{{ env('NOCAPTCHA_SITEKEY') }}" name="nocaptcha_key" type="text"
                                        class="form-control @error('nocaptcha_key') is-invalid @enderror"
                                        autocomplete="off">
                                    @error('nocaptcha_key')
                                        <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <x-forms.label name="nocaptcha_sitekey" class="col-sm-5" />
                                <div class="col-sm-7">
                                    <input value="{{ env('NOCAPTCHA_SECRET') }}" name="nocaptcha_secret" type="text"
                                        class="form-control @error('nocaptcha_secret') is-invalid @enderror"
                                        autocomplete="off">
                                    @error('nocaptcha_secret')
                                        <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="offset-sm-5 col-sm-7">
                                    <button type="submit" class="btn btn-success"><i class="fas fa-sync"></i>
                                        {{ __('update') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
        <div class="col-xl-6 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ __('app_configuration') }}
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('settings.system.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-6">
                                <x-forms.label name="{{ __('timezone') }}" />
                                <select name="timezone"
                                    class="select2bs4 @error('timezone') is-invalid @enderror timezone-select form-control">
                                    @foreach ($timezones as $timezone)
                                        <option {{ config('app.timezone') == $timezone->value ? 'selected' : '' }}
                                            value="{{ $timezone->value }}">
                                            {{ $timezone->value }}
                                        </option>
                                    @endforeach
                                    @error('timezone')
                                        <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                                    @enderror
                                </select>
                            </div>
                            <div class="col-6">
                                <x-forms.label name="{{ __('app_debug') }}" />
                                <div>
                                    <input type="hidden" name="app_debug" value="0" />
                                    <input type="checkbox" id="app_debug" {{ env('APP_DEBUG') ? 'checked' : '' }}
                                        name="app_debug" data-bootstrap-switch data-on-color="success"
                                        data-on-text="{{ __('on') }}" data-off-color="default"
                                        data-off-text="{{ __('off') }}" data-size="small" value="1">
                                    <x-forms.error name="app_debug" />
                                </div>
                            </div>
                            <div class="col-6">
                                <x-forms.label name="{{ __('set_default_language') }}" />
                                <select class="select2bs4 form-control @error('code') is-invalid @enderror" name="code"
                                    id="default_language">
                                    @foreach ($languages as $language)
                                        <option {{ $language->code == env('APP_DEFAULT_LANGUAGE') ? 'selected' : '' }}
                                            value="{{ $language->code }}">
                                            {{ $language->name }}({{ $language->code }})
                                        </option>
                                    @endforeach
                                    @error('code')
                                        <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                                    @enderror
                                </select>
                            </div>
                            <div class="col-6">
                                <x-forms.label name="{{ __('frontend_language_switcher') }}" :required="true" />
                                <div>
                                    <input type="hidden" name="language_changing" value="0" />
                                    <input type="checkbox" id="language_changing"
                                        {{ $setting->language_changing ? 'checked' : '' }} name="language_changing"
                                        data-on-color="success" data-bootstrap-switch data-on-text="{{ __('on') }}"
                                        data-off-color="default" data-off-text="{{ __('off') }}" data-size="small"
                                        value="1">
                                    <x-forms.error name="language_changing" />
                                </div>
                            </div>
                            <div class="col-6">
                                <x-forms.label name="{{ __('set_default_currency') }}" for="inlineFormCustomSelect" />
                                <select name="currency" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                    <option value="" disabled selected>{{ __('Currency') }}
                                    </option>
                                    @foreach ($currencies as $key => $currency)
                                        <option {{ env('APP_CURRENCY') == $currency->code ? 'selected' : '' }}
                                            value="{{ $currency->id }}">
                                            {{ $currency->name }} ( {{ $currency->code }} )
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- <div class="col-6">
                                <x-forms.label name="{{ __('customer_email_verification') }}" :required="true" />
                                <div>
                                    <input type="hidden" name="email_verification" value="0" />
                                    <input type="checkbox" id="email_verification"
                                        {{ $setting->email_verification ? 'checked' : '' }} name="email_verification"
                                        data-on-color="success" data-bootstrap-switch data-on-text="{{ __('on') }}"
                                        data-off-color="default" data-off-text="{{ __('off') }}" data-size="small"
                                        value="1">
                                    <x-forms.error name="email_verification" />
                                </div>
                            </div> --}}
                        </div>

                        <div class="w-full mt-4 mb-2 ml-2 d-flex justify-content-center items-center">
                            <button type="submit" class="btn btn-success" id="setting_button">
                                <span><i class="fas fa-sync"></i> {{ __('update') }}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Watermark -->
            <div class="card">
                <form id="watermarkForm" class="form-horizontal"
                    action="{{ route('settings.website.watermark.update') }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title" style="line-height: 36px;">{{ __('watermark_on_ads_images') }}
                            </h3>
                            <div class="form-group row">
                                <input {{ setting('watermark_status') ? 'checked' : '' }} type="checkbox"
                                    name="watermark_status" data-bootstrap-switch value="1">
                            </div>
                        </div>
                    </div>
                    <!-- ============== for text =============== -->
                    <div class="{{ setting('watermark_status') ? '' : 'd-none' }}">
                        <div id="text-card" class="card-body">
                            <div class="form-group row text-center d-flex align-items-center">
                                <div class="col-sm-12 col-md-6">
                                    <x-forms.label name="watermark_type" class="" />
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <select name="watermark_type"
                                        class="form-control @error('watermark_type') is-invalid @enderror" id="">
                                        <option {{ setting('watermark_type') == 'text' ? 'selected' : '' }}
                                            value="text">
                                            {{ __('text') }}
                                        </option>
                                        <option {{ setting('watermark_type') == 'image' ? 'selected' : '' }}
                                            value="image">
                                            {{ __('image') }}
                                        </option>
                                    </select>
                                    @error('watermark_type')
                                        <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
                                    @enderror
                                </div>
                            </div>
                            <!-- text -->
                            <div id="text-div" class="{{ setting('watermark_type') == 'text' ? '' : 'd-none' }}">
                                <div class="pt-4 form-group row text-center d-flex align-items-center">
                                    <div class="col-sm-12 col-md-6">
                                        <x-forms.label name="text" class="" />
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <input value="{{ setting('watermark_text') }}" name="text" type="text"
                                            class="form-control @error('text') is-invalid @enderror" autocomplete="off">
                                        @error('text')
                                            <span class="invalid-feedback"
                                                role="alert"><span>{{ $message }}</span></span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- image -->
                            <div id="image-div" class="{{ setting('watermark_type') == 'image' ? '' : 'd-none' }}">
                                <div class="pt-4 form-group row text-center d-flex align-items-center">
                                    <div class="col-sm-12 col-md-6">
                                        <x-forms.label name="image" class="" />
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="custom-file">
                                            <input
                                                onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])"
                                                type="file" name="image"
                                                class="custom-file-input  @error('image') is-invalid @enderror"
                                                id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">
                                                {{ setting('watermark_image') }}
                                            </label>
                                        </div>
                                        @error('image')
                                            <span class="text-md text-danger text-black"
                                                role=""><span>{{ $message }}</span></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="pt-4 form-group row text-center d-flex align-items-center">
                                    <div class="offset-6 col-sm-12 col-md-6">
                                        <img id="image" width="100"
                                            src="{{ asset(setting('watermark_image')) }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row pb-3">
                            <div class="offset-sm-5 col-sm-7">
                                <button type="submit" class="btn btn-success"><i class="fas fa-sync"></i>
                                    {{ __('update') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" />
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <style>
        .custom-file-label::after {
            left: 0;
            right: auto;
            border-left-width: 0;
            border-right: inherit;
        }
    </style>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script>
        $('.dropify').dropify();
        $("input[data-bootstrap-switch]").each(function() {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });

        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })

        $('input[name="watermark_type"]').on('switchChange.bootstrapSwitch', function(event, state) {

            var value = event.target.defaultValue;
            if (value == 'text') {
                $('#text-card').addClass('d-none');
                $('#image-card').removeClass('d-none');
                $('#imageInput').bootstrapSwitch('state', false);
            } else {
                $('#textInput').bootstrapSwitch('state', true);
                $('#text-card').removeClass('d-none');
                $('#image-card').addClass('d-none');
            }
        });
        $('input[name="watermark_status"]').on('switchChange.bootstrapSwitch', function(event, state) {
            $('#watermarkForm').submit();
        });

        $('select[name="watermark_type"]').on('change', function() {

            if ($(this).val() == 'image') {
                $('#text-div').addClass('d-none');
                $('#image-div').removeClass('d-none');
            } else {
                $('#text-div').removeClass('d-none');
                $('#image-div').addClass('d-none');
            }
        })

        $("#recaptcha_switch").on('switchChange.bootstrapSwitch', function(event, state) {
            let status = state ? 1 : 0;
            $("input[name=status]").val(status);

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('settings.recaptcha.status.update') }}",
                data: {
                    'status': status
                },
                success: function(response) {
                    setTimeout(() => {
                        window.location.reload();
                    }, 500);
                }
            });
        });
    </script>
    <script>
        $('.custom-file input').change(function(e) {
            var files = [];
            for (var i = 0; i < $(this)[0].files.length; i++) {
                files.push($(this)[0].files[i].name);
            }
            $(this).next('.custom-file-label').html(files.join(', '));
        });
    </script>
    <script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
@endsection
