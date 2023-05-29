@php
$user = auth()->user();
@endphp

@extends('admin.layouts.app')

@section('title')
    {{ __('custom_field') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title" style="line-height: 36px;">{{ __('add_custom_field') }} ⇨
                                {{ $category->name }}</h3>
                            <span class="d-flex">
                                <a href="{{ url()->previous() }}" class="mr-2 btn btn-info">
                                    <i class="fas fa-arrow-left"></i>
                                    <span class="ml-2">{{ __('back') }}</span>
                                </a>
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal"
                            action=" {{ route('module.category.custom.field.store', $category->id) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <x-forms.label name="name" for="name" required="true" />
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name') }}" id="name" placeholder="{{ __('name') }}">
                                        @error('name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <x-forms.label name="group" for="type" required="true" />
                                        <select name="group" id="type"
                                            class="form-control @error('group') border-danger @enderror">
                                            @foreach ($groups as $group)
                                                <option {{ $group->id == old('group') ? 'selected' : '' }}
                                                    value="{{ $group->id }}">
                                                    {{ $group->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('group')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <x-forms.label name="type" for="type" required="true" />
                                        <select name="type" id="type"
                                            class="form-control @error('type') border-danger @enderror">
                                            <option {{ old('type') == 'text' ? 'selected' : '' }} value="text">
                                                {{ __('text') }}
                                            </option>
                                            <option {{ old('type') == 'textarea' ? 'selected' : '' }} value="textarea">
                                                {{ __('textarea') }}
                                            </option>
                                            <option {{ old('type') == 'select' ? 'selected' : '' }} value="select">
                                                {{ __('select') }}
                                            </option>
                                            <option {{ old('type') == 'radio' ? 'selected' : '' }} value="radio">
                                                {{ __('radio') }}
                                            </option>
                                            <option {{ old('type') == 'checkbox' ? 'selected' : '' }} value="checkbox">
                                                {{ __('checkbox') }}
                                            </option>
                                            <option {{ old('type') == 'checkbox_multiple' ? 'selected' : '' }}
                                                value="checkbox_multiple">{{ __('checkbox_multiple') }}
                                            </option>
                                            <option {{ old('type') == 'url' ? 'selected' : '' }} value="url">
                                                {{ __('url') }}
                                            </option>
                                            <option {{ old('type') == 'number' ? 'selected' : '' }} value="number">
                                                {{ __('number') }}
                                            </option>
                                            <option {{ old('type') == 'file' ? 'selected' : '' }} value="file">
                                                {{ __('file') }}
                                            </option>
                                            <option {{ old('type') == 'date' ? 'selected' : '' }} value="date">
                                                {{ __('date') }}
                                            </option>

                                        </select>
                                        @error('type')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group d-none" id="multiple_values">
                                        <x-forms.label name="value" for="type" required="true" />
                                        <select name="values[]" class="valueselect @error('values') is-invalid @enderror"
                                            multiple="multiple" taggable data-placeholder="{{ __('enter_new_value') }}"
                                            style="width: 100%;">
                                        </select>
                                        @error('values')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group d-none" id="single_value">
                                        <x-forms.label name="value" for="type" required="true" />
                                        <input type="text" name="value"
                                            class="form-control @error('value') is-invalid @enderror"
                                            value="{{ old('value') }}" id="name" placeholder="{{ __('value') }}">
                                        @error('value')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="d-flex justify-content-center flex-wrap">
                                        <div>
                                            <x-forms.label name="" for="required" :required="false" />
                                            <div class="icheck-success">
                                                <input {{ old('required') == 1 ? 'checked' : '' }} value="1"
                                                    name="required" type="checkbox" class="form-check-input"
                                                    id="required" />
                                                <x-forms.label name="required" :required="false"
                                                    class="form-check-label mr-5" for="required">
                                                    <span data-toggle="tooltip"
                                                        title="Must be fill when attaching the field with any ad.">
                                                        <x-svg.info-icon />
                                                    </span>
                                                </x-forms.label>
                                            </div>
                                        </div>
                                        <div>
                                            <x-forms.label name="" for="required" :required="false" />
                                            <div class="icheck-success">
                                                <input {{ old('filterable') == 1 ? 'checked' : '' }} value="1"
                                                    name="filterable" type="checkbox" class="form-check-input"
                                                    id="filterable" />
                                                <x-forms.label name="filterable" :required="false"
                                                    class="form-check-label mr-5" for="filterable">
                                                    <span data-toggle="tooltip"
                                                        title="Use this field as filter in the ads sidebar on search results page. NOTE: It's not possible to use File and Video fields as filters. So this feature will be not applied for these fields types.">
                                                        <x-svg.info-icon />
                                                    </span>
                                                </x-forms.label>
                                            </div>
                                        </div>
                                        <div>
                                            <x-forms.label name="" for="required" :required="false" />
                                            <div class="icheck-success">
                                                <input {{ old('listable') == 1 ? 'checked' : '' }} value="1"
                                                    name="listable" type="checkbox" class="form-check-input"
                                                    id="listable" />
                                                <x-forms.label name="listable" :required="false"
                                                    class="form-check-label mr-5" for="listable">
                                                    <span data-toggle="tooltip"
                                                        title="Use this field as show in the ads listing.">
                                                        <x-svg.info-icon />
                                                    </span>
                                                </x-forms.label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <x-forms.label name="icon" required="true" />
                                        <input type="hidden" name="icon" id="icon"
                                            value="{{ old('icon') }}" />
                                        <div id="target"></div>
                                        @error('icon')
                                            <span class="invalid-feedback d-block"
                                                role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-plus"></i>
                                        <span class="ml-2">{{ __('create') }}</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title" style="line-height: 36px;">{{ __('attach_custom_field') }} ⇨
                                {{ $category->name }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal"
                            action="{{ route('module.category.custom.field.store', $category->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <x-forms.label name="custom_fields" required="true" class="form-label" />
                                <select name="fields[]" multiple
                                    class="form-control select2bs4 @error('fields') is-invalid @enderror">
                                    @foreach ($custom_fields as $custom_field)
                                        <option {{ in_array($custom_field->id, $category_fields) ? 'selected' : '' }}
                                            value="{{ $custom_field->id }}">
                                            {{ $custom_field->name }}</option>
                                    @endforeach
                                </select>
                                @error('fields')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-sync"></i>&nbsp; {{ __('save') }}
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

@section('script')
    <script src="{{ asset('backend') }}/plugins/select2/js/select2.full.min.js"></script>
    <script type="text/javascript"
        src="{{ asset('backend') }}/plugins/bootstrap-iconpicker/dist/js/bootstrap-iconpicker.bundle.min.js"></script>
    <script type="text/javascript"
        src="{{ asset('backend') }}/plugins/bootstrap-iconpicker/dist/js/bootstrap-iconpicker.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/select2/js/select2.full.min.js"></script>
    <script>
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        $('#target').iconpicker({
            align: 'center',
            arrowClass: 'btn-danger',
            arrowPrevIconClass: 'fas fa-angle-left',
            arrowNextIconClass: 'fas fa-angle-right',
            cols: 12,
            footer: true,
            header: true,
            icon: 'fas fa-bomb',
            iconset: 'fontawesome5',
            labelHeader: '{0} of {1} pages',
            labelFooter: '{0} - {1} of {2} icons',
            placement: 'bottom',
            rows: 6,
            search: true,
            searchText: 'Search',
            selectedClass: 'btn-success',
            unselectedClass: ''
        });

        $('#target').on('change', function(e) {
            $('#icon').val(e.icon)
        });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });

        $('.select2bs4').select2({
            theme: 'bootstrap4',
        })
        $('.valueselect').select2({
            theme: 'bootstrap4',
            tags: true
        })

        var oldType = '{{ old('type') }}'
        if (oldType == 'select' || oldType == 'radio' || oldType == 'checkbox_multiple') {
            $('#multiple_values').removeClass('d-none')
            $('#single_value').addClass('d-none')
        } else if (oldType == 'checkbox') {
            $('#multiple_values').addClass('d-none')
            $('#single_value').removeClass('d-none')

        } else {
            $('#multiple_values').addClass('d-none')
            $('#single_value').addClass('d-none')
        }

        $('select[name="type"]').on('change', function() {
            var value = this.value

            if (value == 'select' || value == 'radio' || value == 'checkbox_multiple') {
                $('#multiple_values').removeClass('d-none')
                $('#single_value').addClass('d-none')
            } else if (value == 'checkbox') {
                $('#multiple_values').addClass('d-none')
                $('#single_value').removeClass('d-none')
            } else {
                $('#multiple_values').addClass('d-none')
                $('#single_value').addClass('d-none')
            }
        });
    </script>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ asset('backend') }}/plugins/bootstrap-iconpicker/dist/css/bootstrap-iconpicker.min.css" />

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
