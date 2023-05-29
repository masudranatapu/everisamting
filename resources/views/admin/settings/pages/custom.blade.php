@extends('admin.settings.setting-layout')
@section('title')
    {{ __('custom_css_and_JS') }}
@endsection

@section('website-settings')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title" style="line-height: 36px;">{{ __('custom_css_and_JS') }}</h3>
        </div>
        <div class="row pt-3 pb-4">
            <div class="col-12">
                <div class="">
                    <div class="card-body">
                        <form action="{{ route('settings.custom.update') }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <x-forms.label name="{{ __('header_custom_style') }} ({{ __('before_head_end') }})" />
                                <textarea name="header_css" id="headerCss" class="form-control @error('name') is-invalid @enderror"
                                    rows="5">{{ $setting->header_css }}</textarea>
                                @error('name')
                                    <span class="invalid-feedback d-block" role="alert"> <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <span>{{ __('write_style_with_style_tag_like') }},&nbsp;&nbsp;</span>
                                <span>
                                    <code>
                                        &lt;style&gt;
                                        .header-custom-style {
                                        color: red;
                                        }
                                        &lt;/style&gt;
                                    </code>
                                </span>
                            </div>
                            <div class="form-group">
                                <x-forms.label name="{{ __('header_custom_script') }} ({{ __('before_head_end') }})" />
                                <textarea name="header_script" id="headerScript" class="form-control @error('name') is-invalid @enderror"
                                    rows="5">{{ $setting->header_script }}</textarea>
                                @error('name')
                                    <span class="invalid-feedback d-block" role="alert"> <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <span>{{ __('write_script_with_script_tag_like') }},&nbsp;&nbsp;</span>
                                <span>
                                    <code>
                                        &lt;script&gt;
                                        console.log('Hello World');
                                        &lt;/script&gt;
                                    </code>
                                </span>
                            </div>
                            <div class="form-group">
                                <x-forms.label name="{{ __('footer_custom_script') }} ({{ __('before_body_end') }})" />
                                <textarea name="body_script" id="bodyScript" class="form-control @error('name') is-invalid @enderror"
                                    rows="5">{{ $setting->body_script }}</textarea>
                                @error('name')
                                    <span class="invalid-feedback d-block" role="alert"> <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <span>{{ __('write_script_with_script_tag') }},&nbsp;&nbsp;</span>
                                <span>
                                    <code>
                                        &lt;script&gt;
                                        console.log('Hello World');
                                        &lt;/script&gt;
                                    </code>
                                </span>
                            </div>
                            @if (userCan('setting.update'))
                                <div class="form-group">
                                    <button class="btn btn-primary">{{ __('update') }}</button>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <!-- Create a simple CodeMirror instance -->
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/codemirror/codemirror.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/codemirror/addon/foldgutter.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/codemirror/theme/monokai.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/codemirror/theme/material.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/codemirror/theme/material-ocean.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/codemirror/theme/yonce.css">
@endsection
@section('script')
    <!-- Create a simple CodeMirror instance -->
    <script src="{{ asset('backend') }}/plugins/codemirror/codemirror.js"></script>
    <script src="{{ asset('backend') }}/plugins/codemirror/mode/javascript/javascript.js"></script>
    <script src="{{ asset('backend') }}/plugins/codemirror/mode/css/css.js"></script>
    <script src="{{ asset('backend') }}/plugins/codemirror/addon/active-line.js"></script>
    <script src="{{ asset('backend') }}/plugins/codemirror/addon/closebrackets.js"></script>
    <script>
        let headerCss = document.getElementById('headerCss');
        let headerScript = document.getElementById('headerScript');
        let bodyScript = document.getElementById('bodyScript');

        var editor = CodeMirror.fromTextArea(headerCss, {
            lineNumbers: true,
            styleActiveLine: true,
            lineWrapping: true,
            autoCloseBrackets: true,
            // theme: "material",
            mode: "css",
        });
        var editor = CodeMirror.fromTextArea(headerScript, {
            lineNumbers: true,
            styleActiveLine: true,
            lineWrapping: true,
            autoCloseBrackets: true,
            // theme: "material",
            mode: "javascript",
        });
        var editor = CodeMirror.fromTextArea(bodyScript, {
            lineNumbers: true,
            styleActiveLine: true,
            lineWrapping: true,
            autoCloseBrackets: true,
            // theme: "material",
            mode: "javascript",
        });
    </script>
@endsection
