@extends('admin.layouts.app')
@section('title')
    {{ __('edit_post') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('edit_post') }}</h3>
                        <a href="{{ route('module.post.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp;{{ __('back') }}</a>
                    </div>
                    <div class="row justify-content-center pt-3 pb-4">
                        <div class="col-md-9 px-5">
                            <form class="form-horizontal" action="{{ route('module.post.update', $post->id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <x-forms.label name="title" required="true" class="col-sm-2" />
                                    <div class="col-sm-10">
                                        <input value="{{ $post->title }}" name="title" type="text"
                                            class="form-control @error('title') is-invalid @enderror"
                                            placeholder="{{ __('enter_blog_title') }}">
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
                                            @foreach ($categories as $category)
                                                <option {{ $post->category_id == $category->id ? 'selected' : '' }}
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
                                    <x-forms.label name="short_description" required="true" class="col-sm-2" />
                                    <div class="col-sm-10">
                                        <textarea rows="5" type="text" class="form-control" name="short_description" rows="3"
                                            placeholder="{{ __('write_short_description_of_post') }}">{{ $post->short_description }}</textarea>
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
                                            placeholder="{{ __('write_description_of_post') }}">{{ $post->description }}</textarea>
                                        @error('description')
                                            <span class="text-danger"
                                                style="font-size: 13px;"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-10 text-center">
                                        <button type="submit" class="btn btn-success"><i
                                                class="fas fa-plus"></i>&nbsp;{{ __('update_post') }}</button>
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-3 text-center">
                            <x-forms.label name="thumbnail_image" class="form-lebel mb-5" /> <br>
                            @if ($post->image && file_exists($post->image))
                                <img width="300px" height="300px" id="image" class="img-fluid"
                                    src="{{ $post->image_url }}" alt="image"
                                    style="border: 1px solid #adb5bd;margin: 0 auto;padding: 3px;">
                            @else
                                <img width="300px" height="300px" id="image" class="img-fluid"
                                    src="{{ asset('backend/image/default-ad.png') }}" alt="image"
                                    style="border: 1px solid #adb5bd;margin: 0 auto;padding: 3px;">
                            @endif
                            <div class="upload-btn-wrapper mt-3">
                                <input name="image"
                                    onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])"
                                    id="hiddenImgInput" type="file" hidden />
                                <button onclick="$('#hiddenImgInput').click()" class="btn btn-info"
                                    type="button">{{ __('choose_an_image') }}</button>
                            </div>
                            @error('image')
                                <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
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
            min-height: 200px;
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
