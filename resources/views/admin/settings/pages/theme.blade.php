@extends('admin.settings.setting-layout')
@section('title')
    {{ __('theme_setting') }}
@endsection

@section('website-settings')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title" style="line-height: 36px;">{{ __('website_theme_style') }}</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-3">
                    <div class="card">
                        <div class="card-header">{{ __('primary_color') }}</div>
                        <div class="card-body">
                            <div class="frontend-primary-color"></div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-header">{{ __('secondary_color') }}</div>
                        <div class="card-body">
                            <div class="frontend-secondary-color"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (userCan('setting.update'))
            <div class="card-footer text-center">
                <button style="width: 250px;" onclick="$('#color_picker_form').submit()" type="submit"
                    class="btn btn-primary">{{ __('update') }}</button>
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="line-height: 36px;">{{ __('admin_theme_style') }}</h3>
                </div>
                <div class="px-4 pt-3 pb-4">
                    <form id="color_picker_form" action="{{ route('settings.theme.update') }}" method="post">
                        @csrf
                        @method('PUT')
                        <input id="sidebar_color_id" type="hidden" name="sidebar_color"
                            value="{{ $setting->sidebar_color }}">
                        <input id="nav_color_id" type="hidden" name="nav_color" value="{{ $setting->nav_color }}">
                        <input id="sidebar_txt_color_id" type="hidden" name="sidebar_txt_color"
                            value="{{ $setting->sidebar_txt_color }}">
                        <input id="nav_txt_color_id" type="hidden" name="nav_txt_color"
                            value="{{ $setting->nav_txt_color }}">
                        <input id="main_color_id" type="hidden" name="main_color" value="{{ $setting->main_color }}">
                        <input id="accent_color_id" type="hidden" name="accent_color"
                            value="{{ $setting->accent_color }}">
                        <input id="frontend_primary_id" type="hidden" name="frontend_primary_color"
                            value="{{ $setting->frontend_primary_color }}">
                        <input id="frontend_secondary_id" type="hidden" name="frontend_secondary_color"
                            value="{{ $setting->frontend_secondary_color }}">
                    </form>
                    <div class="row">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">{{ __('left_sidebar_background_color') }}</div>
                                <div class="card-body">
                                    <div class="sidebar-bg-color-picker"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">{{ __('left_sidebar_text_color') }}</div>
                                <div class="card-body">
                                    <div class="sidebar-text-color-picker"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">{{ __('top_nav_background_color') }}</div>
                                <div class="card-body">
                                    <div class="navbar-bg-color-picker"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">{{ __('top_nav_text_color') }}</div>
                                <div class="card-body">
                                    <div class="navbar-text-color-picker"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">{{ __('main_color') }}</div>
                                <div class="card-body">
                                    <div class="main-color-picker"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">{{ __('accent_color') }}</div>
                                <div class="card-body">
                                    <div class="accent-color-picker"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if (userCan('setting.update'))
                    <div class="card-footer text-center">
                        <button style="width: 250px;" onclick="$('#color_picker_form').submit()" type="submit"
                            class="btn btn-primary">{{ __('update') }}</button>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title" style="line-height: 36px;">{{ __('layout_setting') }} </h3>
                </div>
                <div class="px-4">
                    <div class="row pt-3 pb-4">
                        <form action="{{ route('settings.layout.update') }}" method="post" id="layout_form">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="default_layout" id="layout_mode">
                        </form>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title m-0">{{ __('left_navigation_layout') }}</h5>
                                </div>
                                <img style="width: 250px; height: auto"
                                    src="{{ asset('backend/image/setting/left-sidebarlayout.png') }}"
                                    class="card-img-top img-fluid" alt="top nav">

                                @if (userCan('setting.update'))
                                    <div class="card-body">
                                        @if ($setting->default_layout)
                                            <a href="javascript:void(0)" onclick="layoutChange(0)"
                                                class="btn btn-danger">{{ __('inactivate') }}</a>
                                        @else
                                            <a href="javascript:void(0)" onclick="layoutChange(1)"
                                                class="btn btn-primary">{{ __('activate') }}</a>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title m-0">{{ __('top_navigation_layout') }}</h5>
                                </div>
                                <img style="width: 250px; height: auto"
                                    src="{{ asset('backend/image/setting/top-sidebarlayout.png') }}"
                                    class="card-img-top img-fluid" alt="top nav">
                                @if (userCan('setting.update'))
                                    <div class="card-body">
                                        @if ($setting->default_layout)
                                            <a href="javascript:void(0)" onclick="layoutChange(0)"
                                                class="btn btn-primary">{{ __('activate') }}</a>
                                        @else
                                            <a href="javascript:void(0)" onclick="layoutChange(1)"
                                                class="btn btn-danger">{{ __('inactivate') }}</a>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend/plugins/pickr') }}/classic.min.css" />
@endsection

@section('script')
    <script src="{{ asset('backend/plugins/pickr') }}/pickr.min.js"></script>
    <script>
        function layoutChange(value) {
            $('#layout_mode').val(value)
            $('#layout_form').submit()
        }
        const colorPickers = [{
                default: '{{ $setting->sidebar_color }}',
                el: ".sidebar-bg-color-picker",
                input: '#sidebar_color_id',
                variable: '--sidebar-bg-color',
            },
            {
                default: '{{ $setting->sidebar_txt_color }}',
                el: ".sidebar-text-color-picker",
                input: '#sidebar_txt_color_id',
                variable: '--sidebar-txt-color',
            },
            {
                el: ".navbar-bg-color-picker",
                default: '{{ $setting->nav_color }}',
                variable: '--top-nav-bg-color',
                input: "#nav_color_id",
            },
            {
                el: ".navbar-text-color-picker",
                default: '{{ $setting->nav_txt_color }}',
                variable: '--top-nav-txt-color',
                input: "#nav_txt_color_id",
            },
            {
                el: ".accent-color-picker",
                default: '{{ $setting->accent_color }}',
                variable: '--accent-color',
                input: "#accent_color_id",
            },
            {
                el: ".main-color-picker",
                default: '{{ $setting->main_color }}',
                variable: '--main-color',
                input: "#main_color_id",
            },
            {
                el: ".frontend-primary-color",
                default: '{{ $setting->frontend_primary_color }}',
                variable: '--frontend-primary-color',
                input: "#frontend_primary_id",
            },
            {
                el: ".frontend-secondary-color",
                default: '{{ $setting->frontend_secondary_color }}',
                variable: '--frontend-secondary-color',
                input: "#frontend_secondary_id",
            },
        ]

        let root = document.documentElement;
        const defaultComponents = {
            preview: true,
            opacity: true,
            hue: true,

            interaction: {
                hex: true,
                rgba: true,
                cmyk: true,
                input: true,
                save: true,
                clear: true,
            }
        }

        colorPickers.forEach(element => {
            const colorPicker = Pickr.create({
                el: element.el,
                theme: "classic",
                default: element.default,
                components: defaultComponents
            });

            colorPicker.on('change', (color, source, instance) => {
                setColor(color.toRGBA().toString(0), null, element.variable, element.input);
            }).on('save', (color, instance) => {
                let colorVal = color ? color.toRGBA().toString(0) : $(element.input).val();
                setColor(colorVal, true, element.variable, element.input);
            });

            function setColor(color, instance, variable, input) {
                root.style.setProperty(variable, color);

                if (instance) {
                    $(input).val(color);
                    colorPicker.hide();
                }
            }
        });
    </script>
@endsection
