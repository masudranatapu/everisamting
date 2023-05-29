@extends('admin.layouts.app')
@section('title')
    {{ __('category_custom_field_value') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="card card-white p-2">
            <div class="card-header">
                <h3 class="card-title">{{ __('category_custom_field_value') }}</h3>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('module.ad.custom.field.value.store', $ad->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        @foreach ($category->customFields as $field)
                            @if ($field->type == 'text')
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <x-forms.label name="{{ $field->name }}" :required="$field->required" />
                                        <input type="text" name="{{ $field->slug }}"
                                            class="form-control @error($field->slug) is-invalid @enderror"
                                            value="{{ old($field->slug) }}" placeholder="{{ $field->name }}">
                                        @error($field->slug)
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            @if ($field->type == 'select')
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <x-forms.label name="{{ $field->name }}" :required="$field->required" />
                                        <select name="{{ $field->slug }}"
                                            class="form-control @error($field->slug) is-invalid @enderror">
                                            @foreach ($field->values as $value)
                                                <option value="{{ $value->value }}">{{ ucfirst($value->value) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error($field->slug)
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            @if ($field->type == 'file')
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <x-forms.label name="{{ $field->name }}" :required="$field->required" />
                                        <div class="custom-file d-flex flex-row-reverse">
                                            <input type="file" name="{{ $field->slug }}"
                                                class="form-control custom-file-input @error($field->slug) is-invalid @enderror custom-file-input"
                                                id="customFile">
                                            <label class="custom-file-label text-right" for="customFile">
                                                {{ __('choose_file') }}
                                            </label>
                                        </div>
                                        @error($field->slug)
                                            <span class="text-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            @if ($field->type == 'radio')
                                <div class="col-sm-6">
                                    <x-forms.label name="{{ $field->name }}" :required="$field->required" />
                                    @foreach ($field->values as $value)
                                        <div class="form-group">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio"
                                                    id="radio{{ $value->id }}" value="{{ ucfirst($value->value) }}"
                                                    name="{{ $field->slug }}">
                                                <label for="radio{{ $value->id }}"
                                                    class="custom-control-label">{{ $value->value }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                    @error($field->slug)
                                        <span class="text-sm text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif
                            @if ($field->type == 'textarea')
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <x-forms.label name="{{ $field->name }}" :required="$field->required" />
                                        <textarea name="{{ $field->slug }}" placeholder="{{ $field->name }}"
                                            class="form-control @error($field->slug) is-invalid @enderror" id="" rows="5">{{ old($field->slug) }}</textarea>
                                        @error($field->slug)
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            @if ($field->type == 'url')
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <x-forms.label name="{{ $field->name }}" :required="$field->required" />
                                        <input type="url" name="{{ $field->slug }}"
                                            class="form-control @error($field->slug) is-invalid @enderror"
                                            value="{{ old($field->slug) }}" placeholder="{{ $field->name }}">
                                        @error($field->slug)
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            @if ($field->type == 'number')
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <x-forms.label name="{{ $field->name }}" :required="$field->required" />
                                        <input min="1" type="number" name="{{ $field->slug }}"
                                            class="form-control @error($field->slug) is-invalid @enderror"
                                            value="{{ old($field->slug) }}" placeholder="{{ $field->name }}">
                                        @error($field->slug)
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            @if ($field->type == 'date')
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <x-forms.label name="{{ $field->name }}" :required="$field->required" />
                                        <input type="date" name="{{ $field->slug }}"
                                            class="form-control @error($field->slug) is-invalid @enderror"
                                            value="{{ old($field->slug) }}" placeholder="{{ $field->name }}">
                                        @error($field->slug)
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            @php
                                $fieldId = 'cf.' . $field->id;
                                $fieldName = 'cf[' . $field->id . ']';
                                $fieldOld = 'cf.' . $field->id;
                                $defaultValue = isset($oldInput) && isset($oldInput[$field->id]) ? $oldInput[$field->id] : '';
                            @endphp

                            @if ($field->type == 'checkbox')
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <x-forms.label name="{{ $field->name }}" :required="$field->required" />
                                        <div class="row">
                                            @foreach ($field->values as $value)
                                                @if ($loop->first)
                                                    <input type="hidden" value="0" name="{{ $fieldName }}">
                                                    <div class="col-md-3 mb-1">
                                                        <div class="icheck-success d-inline">
                                                            <input {{ $defaultValue == '1' ? 'checked' : '' }}
                                                                value="1" name="{{ $fieldName }}" type="checkbox"
                                                                class="form-check-input" id="{{ $fieldId }}" />
                                                            <label class="form-check-label"
                                                                for="{{ $fieldId }}">{{ $value->value }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        @error($field->slug)
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            @if ($field->type == 'checkbox_multiple')
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <x-forms.label name="{{ $field->name }}" :required="$field->required" />
                                        <div class="row">
                                            @foreach ($field->values as $value)
                                                <div class="col-md-3 mb-1">
                                                    <div class="icheck-success d-inline">
                                                        <input id="{{ $fieldId . '.' . $value->id }}"
                                                            name="{{ $fieldName . '[' . $value->id . ']' }}"
                                                            type="checkbox" value="{{ $value->id }}"
                                                            class="form-check-input"
                                                            {{ $defaultValue == $value->id ? 'checked' : '' }} />
                                                        <label class="form-check-label"
                                                            for="{{ $fieldId . '.' . $value->id }}">{{ $value->value }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        @error($field->slug)
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i>&nbsp;
                                {{ __('update') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <style>
        .custom-file-label::after {
            left: 0;
            right: auto;
            border-left-width: 0;
            border-right: inherit;
        }
    </style>
@endsection

@section('script')
    <script>
        $('.custom-file input').change(function(e) {
            var files = [];
            for (var i = 0; i < $(this)[0].files.length; i++) {
                files.push($(this)[0].files[i].name);
            }
            $(this).next('.custom-file-label').html(files.join(', '));
        });
    </script>
@endsection
