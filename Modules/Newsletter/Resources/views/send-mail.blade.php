@extends('admin.layouts.app')
@section('title')
    {{ __('send_mail') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-8">
                                <h3>{{ __('send_mail') }}</h3>
                                <p>
                                    {{ __('you_can_send_a_mail_to_multiple_email_addresses') }}
                                </p>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('module.newsletter.index') }}"
                                    class="btn bg-primary float-right d-flex align-items-center justify-content-center">
                                    <i class="fas fa-arrow-left"></i>&nbsp; {{ __('back') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('module.newsletter.submit_mail') }}" method="POST">
                            @csrf

                            <div class="form-group row">
                                <x-forms.label name="to" required="true" class="col-sm-2" />
                                <div class="col-sm-10">
                                    <select name="emails[]" class="form-control js-example-basic-multiple @error('emails') is-invalid @enderror" multiple="multiple">
                                        @foreach ($emails as $email)
                                            <option {{ collect(old('emails'))->contains($email->id) ? 'selected' : '' }}
                                                value="{{ $email->email }}">{{ $email->email }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('emails')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <x-forms.label name="subject" required="true" class="col-sm-2" />
                                <div class="col-sm-10">
                                    <input type="text" name="subject" class="form-control" value="{{ old('subject') }}"
                                        placeholder="{{ __('write_the_subject_here') }}">
                                    @error('subject')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <x-forms.label name="body" required="true" class="col-sm-2" />
                                <div class="col-sm-10">
                                    <textarea id="editor2" type="text" class="form-control" name="body">
                                        {{ old('body') }}
                                    </textarea>
                                    @error('body')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-success">
                                        <i class="far fa-paper-plane"></i>
                                        &nbsp;{{ __('send_now') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container .select2-selection--single {
            height: 38px !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            color: rgb(0, 0, 0) !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: rgb(255, 0, 0) !important;
        }

        .select2-search .select2-search--inline .select2-search__field {
            width: 100% !important;
        }

    </style>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
    <script src="{{ asset('backend') }}/dist/js/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor2'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
