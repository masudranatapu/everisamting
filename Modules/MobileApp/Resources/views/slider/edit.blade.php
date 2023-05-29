@extends('admin.layouts.app')
@section('title')
    {{ __('mobile_slider') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('mobile_slider') }}</h3>
                        <a href="{{ route('mobile-slider.index') }}"
                            class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>{{ __('back') }}</a>
                    </div>
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="text-center mb-4 pt-2">
                                <img width="350px" height="150px" id="image" src="{{ $slider->image_url }}"
                                    alt="{{ __('user_profile_picture') }}"
                                    style="border: 3px solid #adb5bd;object-fit:cover;margin: 0 auto;padding: 3px; border-radius: 10px;">
                            </div>
                            <form class="form-horizontal" action="{{ route('mobile-slider.update', $slider->id) }}"
                                method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="form-group row">
                                    <x-forms.label name="name" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input value="{{ $slider->name }}" name="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="{{ __('enter_new_name') }}">
                                        @error('name')
                                            <span class="invalid-feedback"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="{{ __('Background Image') }}" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <div class="custom-file">
                                            <input name="background"
                                                onchange="document.getElementById('image').src = window.URL.createObjectURL(this.files[0])"
                                                type="file" class="custom-file-input" id="customFile">
                                            <label class="custom-file-label" for="customFile">
                                                {{ __('choose_file') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-9">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-sync"></i>
                                            {{ __('Update') }}
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
