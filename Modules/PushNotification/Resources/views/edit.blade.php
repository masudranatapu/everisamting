@extends('admin.layouts.app')

@section('title')
    {{ __('edit_push_notification') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('edit_push_notification') }}</h3>
                        <a href="{{ route('admin.push.notification.index') }}"
                           class="btn bg-primary float-right d-flex align-items-center justify-content-center"><i
                                class="fas fa-arrow-left"></i>&nbsp;{{ __('back') }}</a>
                    </div>
                    <div class="row pt-3 pb-4">
                        <div class="col-md-6 offset-md-3">
                            <form class="form-horizontal" action="{{ route('admin.push.notification.update', $notification->id) }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <x-forms.label name="title" required="true" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input value="{{ $notification->title }}" name="title" type="text"
                                               class="form-control @error('title') is-invalid @enderror"
                                               placeholder="{{ __('enter_title') }}">
                                        @error('title')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="body" required="true" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <textarea  name="body" type="text"
                                                   class="form-control @error('body') is-invalid @enderror"
                                                   placeholder="{{ __('enter_body') }}">{{ $notification->body }}</textarea>
                                        @error('body')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="url" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input value="{{ $notification->url }}" name="url" type="text"
                                               class="form-control @error('url') is-invalid @enderror"
                                               placeholder="{{ __('enter_url') }}">
                                        @error('url')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <x-forms.label name="status" required="true" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <select name="status" id="status" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="0" {{ $notification->status == '0' ? 'active' : '' }} >Inactive</option>
                                        </select>
                                        @error('name')
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-3 col-12">
                                        <button type="submit" class="btn btn-success"><i
                                                class="fas fa-plus"></i>&nbsp;{{ __('update_push_notification') }}</button>
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
@endsection

@section('script')
@endsection
