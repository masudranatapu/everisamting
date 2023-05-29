@extends('admin.layouts.app')
@section('title')
    {{ __('create_customer') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('add_user') }}</h3>
                        <a href="{{ route('module.customer.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp; {{ __('back') }}</a>
                    </div>
                    <div class="row pt-3 pb-4">
                        <div class="col-md-6 offset-md-3">
                            <div class="text-center mb-4">
                                <img width="150px" height="150px" id="image" class="img-circle"
                                    src="{{ asset('backend/image/default-user.png') }}" alt="User profile picture"
                                    style="border: 3px solid #adb5bd;margin: 0 auto;padding: 3px;">
                            </div>
                            <form class="form-horizontal" action="{{ route('module.customer.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <x-forms.label name="name" required="true" class="col-sm-3 col-form-label" />
                                    <div class="col-sm-9">
                                        <x-forms.input type="text" name="name" value="{{ old('name') }}"
                                            placeholder="enter_new_name" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="username" required="true" class="col-sm-3 col-form-label" />
                                    <div class="col-sm-9">
                                        <x-forms.input type="text" name="username" value="{{ old('username') }}"
                                            placeholder="username" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="email" required="true" class="col-sm-3 col-form-label" />
                                    <div class="col-sm-9">
                                        <x-forms.input type="email" name="email" value="{{ old('email') }}"
                                            placeholder="email" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="password" required="true" class="col-sm-3 col-form-label" />
                                    <div class="col-sm-9">
                                        <x-forms.input type="password" name="password" value="{{ old('password') }}"
                                            placeholder="password" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="image" class="col-sm-3" :required="false" />
                                    <div class="col-sm-9">
                                        <div class="custom-file">
                                            <input name="image" autocomplete="image"
                                                onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])"
                                                type="file" class="custom-file-input" id="customFile">
                                            <x-forms.label name="choose_file" for="customFile" class="custom-file-label" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-9">
                                        <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i>
                                            {{ __('create') }}
                                        </button>
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

@section('style')
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
    <script src="{{ asset('backend') }}/plugins/select2/js/select2.full.min.js"></script>
    <script>
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    </script>
@endsection
