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
            <h3 class="card-title" style="line-height: 36px;">{{ __('module_settings') }}</h3>
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-12 col-xl-10 col-xxl-8">
                    <form action="{{ route('settings.module.update') }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-12 col-md-6 col-lg-6 col-xl-3 col-xxl-4 mb-3">
                                <div class="form-label">
                                    <h5>{{ __('blog') }}
                                        <span data-toggle="tooltip"
                                            title="It may disable/enable blog module from application">
                                            <x-svg.info-icon />
                                        </span>
                                    </h5>
                                </div>
                                <div>
                                    <input type="checkbox" name="blog" {{ $modulesetting->blog ? 'checked' : '' }}
                                        data-bootstrap-switch value="1">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 col-xl-3 col-xxl-4 mb-3">
                                <div class="form-label">
                                    <h5>
                                        {{ __('newsletter') }}
                                        <span data-toggle="tooltip"
                                            title="It may disable/enable newsletter and subcription from application">
                                            <x-svg.info-icon />
                                        </span>
                                    </h5>
                                </div>
                                <div>
                                    <input type="checkbox" name="newsletter"
                                        {{ $modulesetting->newsletter ? 'checked' : '' }} data-bootstrap-switch
                                        value="1">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 col-xl-3 col-xxl-4 mb-3">
                                <div class="form-label">
                                    <h5>
                                        {{ __('language') }}
                                        <span data-toggle="tooltip"
                                            title="It may disable/enable language module from application">
                                            <x-svg.info-icon />
                                        </span>
                                    </h5>
                                </div>
                                <div>
                                    <input type="checkbox" name="language"
                                        {{ $modulesetting->language ? 'checked' : '' }} data-bootstrap-switch value="1">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 col-xl-3 col-xxl-4 mb-3">
                                <div class="form-label">
                                    <h5>
                                        {{ __('pricing_plan') }}
                                        <span data-toggle="tooltip"
                                            title="It may disable/enable pricing plan module from application">
                                            <x-svg.info-icon />
                                        </span>
                                    </h5>
                                </div>
                                <div>
                                    <input type="checkbox" name="price_plan"
                                        {{ $modulesetting->price_plan ? 'checked' : '' }} data-bootstrap-switch
                                        value="1">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 col-xl-3 col-xxl-4 mb-3">
                                <div class="form-label">
                                    <h5>
                                        {{ __('testimonial') }}
                                        <span data-toggle="tooltip"
                                            title="It may disable/enable testimonial module from application">
                                            <x-svg.info-icon />
                                        </span>
                                    </h5>
                                </div>
                                <div>
                                    <input type="checkbox" name="testimonial"
                                        {{ $modulesetting->testimonial ? 'checked' : '' }} data-bootstrap-switch
                                        value="1">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 col-xl-3 col-xxl-4 mb-3">
                                <div class="form-label">
                                    <h5>
                                        {{ __('faq') }}
                                        <span data-toggle="tooltip"
                                            title="It may disable/enable faq module from application">
                                            <x-svg.info-icon />
                                        </span>
                                    </h5>
                                </div>
                                <div>
                                    <input type="checkbox" name="faq" {{ $modulesetting->faq ? 'checked' : '' }}
                                        data-bootstrap-switch value="1">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 col-xl-3 col-xxl-4 mb-3">
                                <div class="form-label">
                                    <h5>
                                        {{ __('contact') }}
                                        <span data-toggle="tooltip"
                                            title="It may disable/enable contact module from application">
                                            <x-svg.info-icon />
                                        </span>
                                    </h5>
                                </div>
                                <div>
                                    <input type="checkbox" name="contact" {{ $modulesetting->contact ? 'checked' : '' }}
                                        data-bootstrap-switch value="1">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6 col-xl-3 col-xxl-4 mb-3">
                                <div class="form-label">
                                    <h5>
                                        {{ __('appearance') }}
                                        <span data-toggle="tooltip"
                                            title="It may disable/enable light/dark mode part from application">
                                            <x-svg.info-icon />
                                        </span>
                                    </h5>
                                </div>
                                <div>
                                    <input type="checkbox" name="appearance"
                                        {{ $modulesetting->appearance ? 'checked' : '' }} data-bootstrap-switch
                                        value="1">
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-4 text-center">
                                <button type="submit" class="btn btn-primary mt-3" style="width: 200px; height: 50px;">
                                    <x-svg.check-icon height="24px" width="24px" />
                                    {{ __('save') }}
                                </button>
                            </div>
                        </div>
                    </form>
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

        $('[data-toggle="tooltip"]').tooltip()
    </script>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
@endsection
