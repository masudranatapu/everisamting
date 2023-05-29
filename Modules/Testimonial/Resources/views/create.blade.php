@extends('admin.layouts.app')
@section('title')
    {{ __('create_testimonial') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('create_testimonial') }}</h3>
                        <a href="{{ route('module.testimonial.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp; {{ __('back') }}</a>
                    </div>
                    <div class="row pt-3 pb-3">
                        <div class="col-6 offset-3">
                            <div class="text-center">
                                <img class="rounded" width="150px" height="150px" id="image"
                                    src="{{ asset('backend/image/default-user.png') }}" alt="User profile picture"
                                    style="border: 1px solid #adb5bd;margin: 0 auto;padding: 3px;">
                            </div>
                        </div>
                    </div>
                    <div class="row pt-3 pb-4">
                        <div class="col-md-5 offset-md-3">
                            <form class="form-horizontal" action="{{ route('module.testimonial.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <x-forms.label name="name" required="true" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input value="{{ old('name') }}" name="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="{{ __('enter_name') }}">
                                        @error('name')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="position" required="true" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input value="{{ old('position') }}" name="position" type="text"
                                            class="form-control @error('position') is-invalid @enderror"
                                            placeholder="{{ __('enter_position') }}">
                                        @error('position')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="image" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input name="image"
                                            class="form-control border-0 p-0 @error('image') is-invalid @enderror"
                                            type="file" id="formFile"
                                            onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])">
                                        @error('image')
                                            <span class="text-danger invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="stars" required="true" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <div id="rateYo"></div>

                                        <input type="hidden" name="stars" id="rating"
                                            class="form-control @error('stars') is-invalid @enderror">
                                        @error('stars')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="description" required="true" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <textarea rows="8" type="text" class="form-control" name="description"
                                            placeholder="{{ __('write_description_of_testimonial') }}">{{ old('description') }}</textarea>
                                        @error('description')
                                            <span class="text-danger"
                                                style="font-size: 13px;"><strong>{{ $message }}</strong></span>
                                        @enderror
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
    <link rel="stylesheet" href="{{ asset('backend/css/jquery.rateyo.min.css') }}">
    <style>
        .ck-editor__editable_inline {
            min-height: 170px;
        }
    </style>
@endsection

@section('script')
    <script src="{{ asset('backend/js/jquery.rateyo.min.js') }}"></script>
    <script>
        $("#rateYo").rateYo({
            starWidth: '30px',
            fullStar: true,
            mormalFill: 'yellow',
            ratedFill: '#ffc107',
            onSet: function(rating, rateYoInstance) {
                $('#rating').val(rating);
            }
        });
    </script>
@endsection
