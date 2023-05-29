@extends('admin.settings.setting-layout')
@section('title')
    {{ __('mobile_app_settings') }}
@endsection
@section('website-settings')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('mobile_app_settings') }}</h3>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('mobile-config.update') }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <x-forms.label name="Android Download URL" :required="false" />
                                        <div class="w-full">
                                            <input type="text" name="android_download_url" id="name"
                                                class="form-control @error('android_download_url') is-invalid @enderror"
                                                value="{{ old('android_download_url', $config->android_download_url) }}"
                                                placeholder="{{ __('Android Download Link') }}">
                                            @error('android_download_url')
                                                <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <x-forms.label name="IOS Download URL" :required="false" />
                                        <div class="w-full">
                                            <input type="text" name="ios_download_url" id="name"
                                                class="form-control @error('ios_download_url') is-invalid @enderror"
                                                value="{{ old('ios_download_url', $config->ios_download_url) }}"
                                                placeholder="{{ __('IOS Download URL') }}">
                                            @error('ios_download_url')
                                                <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-6">
                                    <div class="form-group">
                                        <x-forms.label name="Privacy URL" />
                                        <div class="w-full">
                                            <input type="text" name="privacy_url" id="code"
                                                class="form-control @error('privacy_url') is-invalid @enderror"
                                                value="{{ old('privacy_url', $config->privacy_url) }}"
                                                placeholder="{{ __('Privacy URL') }}">
                                            @error('privacy_url')
                                                <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <x-forms.label name="Terms and Condition URL" />
                                        <div class="w-full">
                                            <input type="text" name="terms_and_condition_url" id="code"
                                                class="form-control @error('terms_and_condition_url') is-invalid @enderror"
                                                value="{{ old('terms_and_condition_url', $config->terms_and_condition_url) }}"
                                                placeholder="{{ __('Terms and condition') }}">
                                            @error('terms_and_condition_url')
                                                <span class="invalid-feedback" role="alert">{{ __($message) }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div> --}}
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-success" style="width: 10rem">
                                    <i class="fas fa-plus"></i>
                                    {{ __('update') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('style')
    <link rel="stylesheet"
        href="{{ asset('backend') }}/plugins/bootstrap-iconpicker/dist/css/bootstrap-iconpicker.min.css" />
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <style>
        .select2-results__option[aria-selected=true] {
            display: none;
        }

        .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice {
            color: #fff;
            border: 1px solid #fff;
            background: #007bff;
            border-radius: 30px;
        }

        .select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice__remove {
            color: #fff;
        }
    </style>
@endsection

@section('script')
    <script type="text/javascript"
        src="{{ asset('backend') }}/plugins/bootstrap-iconpicker/dist/js/bootstrap-iconpicker.bundle.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/select2/js/select2.full.min.js"></script>
    <script>
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })


        $('#target').iconpicker({
            align: 'left', // Only in div tag
            arrowClass: 'btn-danger',
            arrowPrevIconClass: 'fas fa-angle-left',
            arrowNextIconClass: 'fas fa-angle-right',
            cols: 15,
            footer: true,
            header: true,
            icon: 'flag-icon-gb',
            iconset: 'flagicon',
            labelHeader: '{0} of {1} pages',
            labelFooter: '{0} - {1} of {2} icons',
            placement: 'bottom', // Only in button tag
            rows: 5,
            search: true,
            searchText: 'Search',
            selectedClass: 'btn-success',
            unselectedClass: ''
        });

        $('#target').on('change', function(e) {
            $('#icon').val(e.icon)
        });
    </script>
@endsection
