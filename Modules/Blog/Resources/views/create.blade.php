@extends('admin.layouts.app')
@section('title')
    {{ __('create_post') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('create_post') }}</h3>
                        <a href="{{ route('module.post.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp;{{ __('back') }}</a>
                    </div>
                    <div class="row pt-3 pb-4">
                        <div class="col-md-12">
                            <form class="form-horizontal" action="{{ route('module.post.store') }}" method="POST"
                                enctype="multipart/form-data">
                                <input type="hidden" name="author_id" value="{{ auth()->id() }}">
                                <div class="row justify-content-center pt-3 pb-4">
                                    <div class="col-md-9 px-5">
                                        @csrf
                                        <div class="form-group row">
                                            <x-forms.label name="title" required="true" class="col-sm-2" />
                                            <div class="col-sm-10">
                                                <input value="{{ old('title') }}" name="title" type="text"
                                                    class="form-control @error('title') is-invalid @enderror"
                                                    placeholder="{{ __('enter_post_title') }}">
                                                @error('title')
                                                    <span class="invalid-feedback"
                                                        role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <x-forms.label name="category" required="true" class="col-sm-2" />
                                            <div class="col-sm-10">
                                                <select name="category_id"
                                                    class="select2bs4 @error('category_id') is-invalid @enderror"
                                                    style="width: 100%;">
                                                    <option value="">{{ __('select_category') }}</option>
                                                    @foreach ($categories as $category)
                                                        <option
                                                            {{ old('category_id') == $category->id ? 'selected' : '' }}
                                                            value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                    <span class="invalid-feedback"
                                                        role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <x-forms.label name="short_description" required="true"
                                                class="col-sm-2" />
                                            <div class="col-sm-10">
                                                <textarea rows="5" type="text" class="form-control" name="short_description"
                                                    placeholder="{{ __('write_short_description_of_post') }}">{{ old('short_description') }}</textarea>
                                                @error('short_description')
                                                    <span class="text-danger"
                                                        style="font-size: 13px;"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <x-forms.label name="description" required="true" class="col-sm-2" />
                                            <div class="col-sm-10">
                                                <textarea id="editor2" type="text" class="form-control" name="description"
                                                    placeholder="{{ __('write_description_of_post') }}">{{ old('description') }}</textarea>
                                                @error('description')
                                                    <span class="text-danger"
                                                        style="font-size: 13px;"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-9 text-center">
                                                <button type="submit" class="btn btn-success"><i
                                                        class="fas fa-plus"></i>&nbsp;{{ __('create_post') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <x-forms.label name="thumbnail_image" class="form-lebel mb-5" /> <br>
                                        <img width="300px" height="300px" id="image" class="img-fluid"
                                            src="{{ asset('backend/image/default-user.png') }}" alt="image"
                                            style="border: 1px solid #adb5bd;margin: 0 auto;padding: 3px;">

                                        <div class="upload-btn-wrapper mt-3">
                                            <input name="image"
                                                onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])"
                                                id="hiddenImgInput" type="file" hidden />
                                            <button onclick="$('#hiddenImgInput').click()" class="btn btn-info"
                                                type="button">{{ __('choose_an_image') }}</button>
                                        </div>
                                        @error('image')
                                            <span class="invalid-feedback d-block"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
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
        .ck-editor__editable_inline {
            min-height: 300px;
        }

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
    <script src="{{ asset('backend') }}/dist/js/ckeditor.js"></script>
    <script>
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        ClassicEditor
            .create(document.querySelector('#editor2'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
