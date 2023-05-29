@extends('admin.settings.setting-layout')
@section('title')
    {{ __('preferences') }}
@endsection

@section('breadcrumbs')
    <div class="row mb-2 mt-4">
        <div class="col-sm-6">
            <h1 class="m-0">{{ __('settings') }}</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('home') }}</a></li>
                <li class="breadcrumb-item">{{ __('settings') }}</li>
                <li class="breadcrumb-item active">{{ __('preferences') }}</li>
            </ol>
        </div>
    </div>
@endsection

@section('website-settings')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                {{ __('website_configuration') }}
            </h3>
        </div>
        <div class="card-body">
            <form class="form-horizontal" action="{{ route('settings.website.configuration.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <x-forms.label name="website_loader" required="true" class="d-block"/>
                                    <input type="checkbox" name="website_loader"
                                           {{ $setting->website_loader ? 'checked' : '' }} data-bootstrap-switch
                                           value="1">
                                </div>
                                <div class="form-group">
                                    <x-forms.label name="show_featured_ads_on_homepage" required="true"
                                                   class="d-block"/>
                                    <input type="checkbox" name="featured_ads_homepage"
                                           {{ $setting->featured_ads_homepage ? 'checked' : '' }} data-bootstrap-switch
                                           value="1">
                                </div>
                                <div class="form-group">
                                    <x-forms.label name="show_regular_ads_on_homepage" required="true" class="d-block"/>
                                    <input type="checkbox" name="regular_ads_homepage"
                                           {{ $setting->regular_ads_homepage ? 'checked' : '' }} data-bootstrap-switch
                                           value="1">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <x-forms.label name="customer_email_verification" required="true" class="d-block"/>
                                    <input type="checkbox" name="customer_email_verification"
                                           {{ $setting->customer_email_verification == 1 ? 'checked' : '' }} data-bootstrap-switch
                                           value="1">
                                </div>
                                <div class="form-group">
                                    <x-forms.label name="ads_admin_approval" required="true" class="d-block"/>
                                    <input type="checkbox" name="ads_admin_approval"
                                           {{ $setting->ads_admin_approval ? 'checked' : '' }} data-bootstrap-switch
                                           value="1">
                                </div>
                            </div>
                        </div>
                        <div class="mt-5">
                            <div class="form-group">
                                <x-forms.label name="Facebook page ID" :required="false"/>
                                <input type="text" name="fb_app_id" class="form-control"
                                       value="{{ $settings->fb_app_id }}" placeholder="Facebook page ID">
                            </div>
                            <div class="form-group">
                                <x-forms.label name="Facebook access token" :required="false"/>
                                <input type="text" name="fb_access_token" class="form-control"
                                       value="{{ $settings->fb_access_token }}" placeholder="Facebook access token">
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <x-forms.label name="facebook" :required="false"/>
                                    <input type="text" name="facebook" class="form-control"
                                           value="{{ $settings->facebook }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <x-forms.label name="twitter" :required="false"/>
                                    <input type="text" name="twitter" class="form-control"
                                           value="{{ $settings->twitter }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <x-forms.label name="instagram" :required="false"/>
                                    <input type="text" name="instagram" class="form-control"
                                           value="{{ $settings->instagram }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <x-forms.label name="youtube" :required="false"/>
                                    <input type="text" name="youtube" class="form-control"
                                           value="{{ $settings->youtube }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <x-forms.label name="linkdin" :required="false"/>
                                    <input type="text" name="linkdin" class="form-control"
                                           value="{{ $settings->linkdin }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <x-forms.label name="Whatsapp" :required="false"/>
                                    <input type="text" name="whatsapp" class="form-control"
                                           value="{{ $settings->whatsapp }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <x-forms.label name="free_ad_limit" required="true"/>
                            <x-forms.input type="number" name="free_ad_limit" value="{{ $setting->free_ad_limit }}"
                                           placeholder="{{ __('free_ad_limit') }}"/>
                        </div>
                        <div class="form-group">
                            <x-forms.label name="free_ad_featured_limit" required="true"/>
                            <x-forms.input type="number" name="free_featured_ad_limit"
                                           value="{{ $setting->free_featured_ad_limit }}"
                                           placeholder="{{ __('free_ad_featured_limit') }}"/>
                        </div>
                        <div class="form-group">
                            <label for="">Free Business Directory Limit <span class="text-danger">*</span></label>
                            <x-forms.input type="number" name="free_business_directory_limit"
                                           value="{{ $setting->free_business_directory_limit }}"
                                           placeholder="{{ __('Free Business Directory Limit') }}"/>
                        </div>
                        <div class="form-group">
                            <x-forms.label name="maximum_ad_image_limit" required="true"/>
                            <x-forms.input type="number" name="maximum_ad_image_limit"
                                           value="{{ $setting->maximum_ad_image_limit }}"
                                           placeholder="{{ __('maximum_ad_image_limit') }}"/>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    @if (userCan('setting.update'))
                        <div class="form-group row text-center justify-content-center">
                            <button type="submit" class="btn btn-success" id="setting_button">
                                <i class="fas fa-sync"></i>
                                {{ __('update') }}
                            </button>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <!-- <div class="col-lg-6 col-12">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            {{ __('application_mode') }}
        </h3>
    </div>
    <div class="card-body">
        <form class="form-horizontal" action="{{ route('settings.system.update') }}" method="POST">
                            @csrf
        @method('PUT')
        <div class="row">
            <div class="form-group col-sm-12 col-md-6">
                <x-forms.label name="maintenance_mode" />
                <div class="col-sm-7">
                    <input type="hidden" name="maintenance_mode" value="0" />
                    <input type="checkbox" id="maintenance_mode" name="maintenance_mode"
                        data-on-color="success" data-on-text="{{ __('on') }}"
                                            data-off-color="default" data-off-text="{{ __('off') }}" data-size="small"
                                            value="1" {{ config('app.mode') == 'maintenance' ? 'checked' : '' }}>
                                    </div>
                                </div>
                                <div class="form-group col-sm-12 col-md-6">
                                    <x-forms.label name="coming_soon_mode" />
                                    <div class="col-sm-7">
                                        <input type="hidden" name="commingsoon_mode" value="0" />
                                        <input {{ config('app.mode') == 'comingsoon' ? 'checked' : '' }} type="checkbox"
                                            id="commingsoon_mode" name="commingsoon_mode" data-on-color="success"
                                            data-on-text="{{ __('on') }}" data-off-color="default"
                                            data-off-text="{{ __('off') }}" data-size="small" value="1">
                                    </div>
                                </div>
                                <div class="col-sm-12 mt-2">
                                    @if (userCan('setting.update'))
            <div class="form-group">
                                                    <button type="submit" class="btn btn-success" id="setting_button">
                                                        <i class="fas fa-sync"></i>
{{ __('update') }}
            </button>
        </div>

        @endif
        </div>
    </div>
</form>
</div>
</div> -->

    </div>
    <div class="card">
        <form class="form-horizontal" action="{{ route('admin.push.notification.setting.update') }}" method="POST">
            @method('PUT')
            @csrf
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title" style="line-height: 36px;">
                        {{ __('firebase_push_notification_configuration') }}
                        <span class="red-tooltip" data-toggle="tooltip"
                              title="Firebase Cloud Messaging gives you infrastructure to send messages across devices. Easily send messages and notifications across multiple platforms to engage your app users.
                                    You can get your credentials in https://console.firebase.google.com/">
                                        <x-svg.info-icon/>
                                    </span>
                    </h3>
                    <h3>
                        <input type="checkbox" name="push_notification_status" data-on-color="success"
                               class="form-control" data-on-text="{{ __('on') }}" data-off-color="default"
                               data-off-text="{{ __('off') }}" data-bootstrap-switch value="1"
                            {{ setting('push_notification_status') ? 'checked' : '' }}>
                    </h3>
                </div>
            </div>
            @if (setting('push_notification_status'))
                <div class="card-body card-body-pt">
                    <div class="justify-content-center">
                        <div id="text-card" class="card-body">
                            <div class="">
                                <x-forms.label name="server_key" class=""/>
                                <input value="{{ setting('server_key') }}" name="server_key" type="text"
                                       class="form-control @error('server_key') is-invalid @enderror"
                                       autocomplete="off" placeholder="{{ __('server_key') }}">
                                @error('server_key')
                                <span class="text-left invalid-feedback"
                                      role="alert"><span>{{ $message }}</span></span>
                                @enderror
                            </div>
                            <div class="pt-2">
                                <x-forms.label name="api_key" class=""/>
                                <input value="{{ setting('api_key') }}" name="api_key" type="text"
                                       class="form-control @error('api_key') is-invalid @enderror" autocomplete="off"
                                       placeholder="{{ __('api_key') }}">
                                @error('api_key')
                                <span class="text-left invalid-feedback"
                                      role="alert"><span>{{ $message }}</span></span>
                                @enderror
                            </div>
                            <div class="pt-2">
                                <x-forms.label name="auth_domain" class=""/>
                                <input value="{{ setting('auth_domain') }}" name="auth_domain" type="text"
                                       class="form-control @error('auth_domain') is-invalid @enderror"
                                       autocomplete="off" placeholder="{{ __('auth_domain') }}">
                                @error('auth_domain')
                                <span class="text-left invalid-feedback"
                                      role="alert"><span>{{ $message }}</span></span>
                                @enderror
                            </div>
                            <div class="pt-2">
                                <x-forms.label name="project_id" class=""/>
                                <input value="{{ setting('project_id') }}" name="project_id" type="text"
                                       class="form-control @error('project_id') is-invalid @enderror"
                                       autocomplete="off" placeholder="{{ __('project_id') }}">
                                @error('project_id')
                                <span class="text-left invalid-feedback"
                                      role="alert"><span>{{ $message }}</span></span>
                                @enderror
                            </div>
                            <div class="pt-2">
                                <x-forms.label name="storage_bucket" class=""/>
                                <input value="{{ setting('storage_bucket') }}" name="storage_bucket"
                                       type="text"
                                       class="form-control @error('storage_bucket') is-invalid @enderror"
                                       autocomplete="off" placeholder="{{ __('storage_bucket') }}">
                                @error('storage_bucket')
                                <span class="text-left invalid-feedback"
                                      role="alert"><span>{{ $message }}</span></span>
                                @enderror
                            </div>
                            <div class="pt-2">
                                <x-forms.label name="messaging_sender_id" class=""/>
                                <input value="{{ setting('messaging_sender_id') }}" name="messaging_sender_id"
                                       type="text"
                                       class="form-control @error('messaging_sender_id') is-invalid @enderror"
                                       autocomplete="off" placeholder="{{ __('messaging_sender_id') }}">
                                @error('messaging_sender_id')
                                <span class="text-left invalid-feedback"
                                      role="alert"><span>{{ $message }}</span></span>
                                @enderror
                            </div>
                            <div class="pt-2">
                                <x-forms.label name="app_id" class=""/>
                                <input value="{{ setting('app_id') }}" name="app_id" type="text"
                                       class="form-control @error('app_id') is-invalid @enderror" autocomplete="off"
                                       placeholder="{{ __('app_id') }}">
                                @error('app_id')
                                <span class="text-left invalid-feedback"
                                      role="alert"><span>{{ $message }}</span></span>
                                @enderror
                            </div>
                            <div class="pt-2">
                                <x-forms.label name="measurement_id" class=""/>
                                <input value="{{ setting('measurement_id') }}" name="measurement_id"
                                       type="text"
                                       class="form-control @error('measurement_id') is-invalid @enderror"
                                       autocomplete="off" placeholder="{{ __('measurement_id') }}">
                                @error('measurement_id')
                                <span class="text-left invalid-feedback"
                                      role="alert"><span>{{ $message }}</span></span>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-success"><i class="fas fa-sync"></i>
                                    {{ __('update') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </form>
    </div>
    <div class="col-lg-6 col-12">

        {{--            <div class="card">--}}
        {{--                <form id="" class="form-horizontal"--}}
        {{--                    action="{{ route('settings.pusher.configuration.update') }}" method="POST">--}}
        {{--                    @method('PUT')--}}
        {{--                    @csrf--}}
        {{--                    <div class="card-header">--}}
        {{--                        <div class="d-flex justify-content-between">--}}
        {{--                            <h3 class="card-title" style="line-height: 36px;">{{ __('pusher_configuration') }}--}}
        {{--                            </h3>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}

        {{--                    <div class="card-body card-body-pt">--}}
        {{--                        <div class="justify-content-center">--}}
        {{--                            <div class="card-body">--}}
        {{--                                <div class="form-group">--}}
        {{--                                    <x-forms.label name="pusher_app_id" class="" />--}}
        {{--                                    <input value="{{ config('zakirsoft.pusher_app_id') }}" name="pusher_app_id"--}}
        {{--                                        type="text" class="form-control @error('pusher_app_id') is-invalid @enderror"--}}
        {{--                                        autocomplete="off" placeholder="{{ __('pusher_app_id') }}">--}}
        {{--                                    @error('pusher_app_id')--}}
        {{--                                        <span class="text-left invalid-feedback"--}}
        {{--                                            role="alert"><span>{{ $message }}</span></span>--}}
        {{--                                    @enderror--}}
        {{--                                </div>--}}
        {{--                                <div class="form-group">--}}
        {{--                                    <div class="pt-2">--}}
        {{--                                        <x-forms.label name="pusher_app_key" class="" />--}}
        {{--                                        <input value="{{ config('zakirsoft.pusher_app_key') }}" name="pusher_app_key"--}}
        {{--                                            type="text"--}}
        {{--                                            class="form-control @error('pusher_app_key') is-invalid @enderror"--}}
        {{--                                            autocomplete="off" placeholder="{{ __('pusher_app_key') }}">--}}
        {{--                                        @error('pusher_app_key')--}}
        {{--                                            <span class="text-left invalid-feedback"--}}
        {{--                                                role="alert"><span>{{ $message }}</span></span>--}}
        {{--                                        @enderror--}}
        {{--                                    </div>--}}
        {{--                                </div>--}}
        {{--                                <div class="form-group">--}}
        {{--                                    <div class="pt-2">--}}
        {{--                                        <x-forms.label name="pusher_app_secret" class="" />--}}
        {{--                                        <input value="{{ config('zakirsoft.pusher_app_secret') }}"--}}
        {{--                                            name="pusher_app_secret" type="text"--}}
        {{--                                            class="form-control @error('pusher_app_secret') is-invalid @enderror"--}}
        {{--                                            autocomplete="off" placeholder="{{ __('pusher_app_secret') }}">--}}
        {{--                                        @error('pusher_app_secret')--}}
        {{--                                            <span class="text-left invalid-feedback"--}}
        {{--                                                role="alert"><span>{{ $message }}</span></span>--}}
        {{--                                        @enderror--}}
        {{--                                    </div>--}}
        {{--                                </div>--}}
        {{--                                <div class="form-group">--}}
        {{--                                    <div class="pt-2">--}}
        {{--                                        <x-forms.label name="pusher_app_cluster" class="" />--}}
        {{--                                        <input value="{{ config('zakirsoft.pusher_app_cluster') }}"--}}
        {{--                                            name="pusher_app_cluster" type="text"--}}
        {{--                                            class="form-control @error('pusher_app_cluster') is-invalid @enderror"--}}
        {{--                                            autocomplete="off" placeholder="{{ __('pusher_app_cluster') }}">--}}
        {{--                                        @error('pusher_app_cluster')--}}
        {{--                                            <span class="text-left invalid-feedback"--}}
        {{--                                                role="alert"><span>{{ $message }}</span></span>--}}
        {{--                                        @enderror--}}
        {{--                                    </div>--}}
        {{--                                </div>--}}
        {{--                                <div class="form-group mt-3">--}}
        {{--                                    <button type="submit" class="btn btn-success"><i class="fas fa-sync"></i>--}}
        {{--                                        {{ __('update') }}--}}
        {{--                                    </button>--}}
        {{--                                </div>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </form>--}}
        {{--            </div>--}}

        <!-- <div class="card">
                    <form id="" class="form-horizontal" action="{{ route('module.map.update') }}" method="POST">
                        @method('PUT')
        @csrf
        <input type="hidden" name="from_preference" value="true">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h3 class="card-title" style="line-height: 36px;">{{ __('map_configuration') }}
        </h3>
    </div>
</div>

<div class="card-body card-body-pt">
    <div class="justify-content-center">
        <div id="text-card" class="card-body">
            <div class="form-group">
                <x-forms.label name="map_type" class="" />
                <select name="map_type"
                    class="form-control @error('watermark_type') is-invalid @enderror"
                                            id="">
                                            <option {{ setting('default_map') == 'map-box' ? 'selected' : '' }}
        value="map-box">
{{ __('map-box') }}
        </option>
        <option {{ setting('default_map') == 'google-map' ? 'selected' : '' }}
        value="google-map">
{{ __('google-map') }}
        </option>
    </select>
@error('map_type')
        <span class="invalid-feedback" role="alert"><span>{{ $message }}</span></span>
    @enderror
        </div>

        <div id="mapbox_key"
            class="form-group {{ setting('default_map') == 'map-box' ? '' : 'd-none' }} ">
                                        <div class="pt-2">
                                            <x-forms.label name="map_box_key" class="" />
                                            <input value="{{ setting('map_box_key') }}" name="map_box_key" type="text"
                                                class="form-control @error('map_box_key') is-invalid @enderror"
                                                autocomplete="off" placeholder="{{ __('map_box_key') }}">
                                            @error('map_box_key')
        <span class="text-left invalid-feedback"
                                                        role="alert"><span>{{ $message }}</span></span>
    @enderror
        </div>
    </div>

    <div id="googlemap_key"
        class="form-group {{ setting('default_map') == 'google-map' ? '' : 'd-none' }}">
                                        <div class="pt-2">
                                            <x-forms.label name="google_map_key" class="" />
                                            <input value="{{ setting('google_map_key') }}" name="google_map_key"
                                                type="text"
                                                class="form-control @error('google_map_key') is-invalid @enderror"
                                                autocomplete="off" placeholder="{{ __('google_map_key') }}">
                                            @error('google_map_key')
        <span class="text-left invalid-feedback"
                                                        role="alert"><span>{{ $message }}</span></span>
    @enderror
        </div>
    </div>
    <div class="form-group mt-3">
        <button type="submit" class="btn btn-success"><i class="fas fa-sync"></i>
{{ __('update') }}
        </button>
    </div>
</div>
</div>
</div>
</form>
</div> -->
    </div>
    </div>
@endsection


@section('script')
    <script src="{{ asset('backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $("input[data-bootstrap-switch]").each(function () {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })
        $('[data-toggle="tooltip"]').tooltip()

        $("#app_debug").bootstrapSwitch();
        $("#facebook_pixel").bootstrapSwitch();
        $("#google_analytics").bootstrapSwitch();
        $("#language_changing").bootstrapSwitch();
        $("#search_engine_indexing").bootstrapSwitch();
        $("#maintenance_mode").bootstrapSwitch();
        $("#commingsoon_mode").bootstrapSwitch();
        $("input[data-bootstrap-switch]").each(function () {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })
    </script>
    <script>
        $('select[name="map_type"]').on('change', function () {
            var value = $(this).val();
            if (value == 'google-map') {
                $('#googlemap_key').removeClass('d-none');
                $('#mapbox_key').addClass('d-none');
            } else {
                $('#mapbox_key').removeClass('d-none');
                $('#googlemap_key').addClass('d-none');
            }
        })
    </script>
    <script>
        $('input[name="push_notification_status"]').on('switchChange.bootstrapSwitch', function (event, state) {

            var value = state ? 1 : 0;

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('admin.push.notification.status.update') }}",
                data: {
                    status: value,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    location.reload();
                },
                error: function (error) {
                    location.reload();
                }
            });
        });
    </script>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <style>
        .card-body-pt {
            padding-top: 0 !important;
        }

        #searchInput {
            font-family: 'Roboto';
            background-color: #fff;
            font-size: 16px;
            text-overflow: ellipsis;
            margin-left: 16px;
            font-weight: 400;
            width: 30%;
            padding: 0 11px 0 13px;
        }

        #searchInput:focus {
            border-color: #4d90fe;
        }

        .tooltip-inner {
            background: #2a2626;
            max-width: 350px;
            width: 350px;
        }
    </style>
    <!-- >=>Mapbox<=< -->
@endsection
