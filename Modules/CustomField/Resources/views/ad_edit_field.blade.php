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
                <form action="{{ route('module.ad.custom.field.value.update', $ad->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        @foreach ($ad->productCustomFields as $field)
                            @if ($field->customField->type == 'text')
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <x-forms.label name="{{ $field->customField->name }}" :required="$field->customField->required" />
                                        <input type="text" name="{{ $field->customField->slug }}"
                                            class="form-control @error($field->customField->slug) is-invalid @enderror"
                                            value="{{ $field->value }}" placeholder="{{ $field->customField->name }}">
                                        @error($field->customField->slug)
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            @if ($field->customField->type == 'select')
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <x-forms.label name="{{ $field->customField->name }}" :required="$field->customField->required" />
                                        <select name="{{ $field->customField->slug }}"
                                            class="form-control @error($field->customField->slug) is-invalid @enderror">
                                            @foreach ($field->customField->values as $value)
                                                <option
                                                    {{ ucfirst($field->value) == ucfirst($value->value) ? 'selected' : '' }}
                                                    value="{{ $value->value }}">{{ ucfirst($value->value) }}</option>
                                            @endforeach
                                        </select>
                                        @error($field->customField->slug)
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            @if ($field->customField->type == 'file')
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <x-forms.label name="{{ $field->customField->name }}" :required="$field->customField->required" />
                                        <div class="input-group">
                                            <input type="file" name="{{ $field->customField->slug }}"
                                                class="form-control custom-file-input @error($field->customField->slug) is-invalid @enderror custom-file-input"
                                                id="customFile">
                                            <label class="custom-file-label text-right" for="customFile">
                                                {{ __('choose_file') }}
                                            </label>
                                        </div>
                                        @error($field->customField->slug)
                                            <span class="text-sm text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            @if ($field->customField->type == 'textarea')
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <x-forms.label name="{{ $field->customField->name }}" :required="$field->customField->required" />
                                        <textarea name="{{ $field->customField->slug }}" placeholder="{{ $field->customField->name }}"
                                            class="form-control @error($field->customField->slug) is-invalid @enderror" rows="5">{{ $field->value }}</textarea>
                                        @error($field->customField->slug)
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            @if ($field->customField->type == 'radio')
                                <div class="col-sm-6">
                                    <x-forms.label name="{{ $field->customField->name }}" :required="$field->customField->required" />
                                    @foreach ($field->customField->values as $value)
                                        <div class="form-group">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input"
                                                    {{ ucfirst($field->value) == ucfirst($value->value) ? 'checked' : '' }}
                                                    type="radio" id="radio{{ $value->id }}"
                                                    value="{{ ucfirst($value->value) }}"
                                                    name="{{ $field->customField->slug }}">
                                                <label for="radio{{ $value->id }}"
                                                    class="custom-control-label">{{ $value->value }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                    @error($field->customField->slug)
                                        <span class="text-sm text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif
                            @if ($field->customField->type == 'url')
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <x-forms.label name="{{ $field->customField->name }}" :required="$field->customField->required" />
                                        <input type="url" name="{{ $field->customField->slug }}"
                                            class="form-control @error($field->customField->slug) is-invalid @enderror"
                                            value="{{ $field->value }}" placeholder="{{ $field->customField->name }}">
                                        @error($field->customField->slug)
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            @if ($field->customField->type == 'number')
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <x-forms.label name="{{ $field->customField->name }}" :required="$field->customField->required" />
                                        <input type="number" name="{{ $field->customField->slug }}"
                                            class="form-control @error($field->customField->slug) is-invalid @enderror"
                                            value="{{ $field->value }}" placeholder="{{ $field->customField->name }}">
                                        @error($field->customField->slug)
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            @if ($field->customField->type == 'date')
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <x-forms.label name="{{ $field->customField->name }}" :required="$field->customField->required" />
                                        <input type="date" name="{{ $field->customField->slug }}"
                                            class="form-control @error($field->customField->slug) is-invalid @enderror"
                                            value="{{ $field->value }}" placeholder="{{ $field->customField->name }}">
                                        @error($field->customField->slug)
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif

                            @php
                                $fieldId = 'cf.' . $field->customField->id;
                                $fieldName = 'cf[' . $field->customField->id . ']';
                                $fieldOld = 'cf.' . $field->customField->id;
                            @endphp

                            @if ($field->customField->type == 'checkbox')
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <x-forms.label name="{{ $field->customField->name }}" :required="$field->customField->required" />
                                        <div class="row">
                                            @foreach ($field->customField->values as $value)
                                                @if ($loop->first)
                                                    <input type="hidden" value="0" name="{{ $fieldName }}">
                                                    <div class="col-md-3 mb-1">
                                                        <div class="icheck-success d-inline">
                                                            <input {{ $field->value ? 'checked' : '' }} value="1"
                                                                name="{{ $fieldName }}" type="checkbox"
                                                                class="form-check-input" id="{{ $fieldId }}" />
                                                            <label class="form-check-label"
                                                                for="{{ $fieldId }}">{{ $value->value }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        @error($field->customField->slug)
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                            @if ($field->customField->type == 'checkbox_multiple')
                                @php
                                    $exploded_values = explode(', ', $field->value);
                                @endphp

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <x-forms.label name="{{ $field->customField->name }}" :required="$field->customField->required" />
                                        <div class="row">
                                            @foreach ($field->customField->values as $key => $value)
                                                <div class="col-md-3 mb-1">
                                                    <div class="icheck-success d-inline">
                                                        <input id="{{ $fieldId . '.' . $value->id }}"
                                                            name="{{ $fieldName . '[' . $value->id . ']' }}"
                                                            type="checkbox" value="{{ $value->id }}"
                                                            class="form-check-input"
                                                            {{ in_array($value->id, $exploded_values) ? 'checked' : '' }} />
                                                        <label class="form-check-label"
                                                            for="{{ $fieldId . '.' . $value->id }}">
                                                            {{ $value->value }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        @error($field->customField->slug)
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
