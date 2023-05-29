@extends('admin.layouts.app')

@section('title')
    {{ __('edit_custom_field') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('edit_custom_field') }}</h3>
                        <div>
                            <a href="{{ route('module.custom.field.group.index') }}" class="btn btn-info">
                                <i class="fas fa-cog"></i>
                                <span class="ml-1">{{ __('manage_group') }}</span>
                            </a>
                            <a href="{{ route('module.custom.field.index') }}" class="btn btn-primary">
                                <i class="fas fa-arrow-left"></i>
                                <span class="ml-1">{{ __('back') }}</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <form class="form-horizontal"
                                action=" {{ route('module.custom.field.update', $custom_field->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <x-forms.label name="name" for="name" required="true" />
                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                value="{{ old('name', $custom_field->name) }}" id="name"
                                                placeholder="{{ __('name') }}">
                                            @error('name')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <x-forms.label name="group" for="type" required="true" />
                                            <select name="group" id="type"
                                                class="form-control @error('group') border-danger @enderror">
                                                @foreach ($groups as $group)
                                                    <option
                                                        {{ $group->id == $custom_field->custom_field_group_id ? 'selected' : '' }}
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
                                                <option
                                                    {{ old('type', $custom_field->type) == 'text' ? 'selected' : '' }}
                                                    value="text">
                                                    {{ __('text') }}
                                                </option>
                                                <option
                                                    {{ old('type', $custom_field->type) == 'textarea' ? 'selected' : '' }}
                                                    value="textarea">{{ __('textarea') }}
                                                </option>
                                                <option
                                                    {{ old('type', $custom_field->type) == 'select' ? 'selected' : '' }}
                                                    value="select">
                                                    {{ __('select') }}
                                                </option>
                                                <option
                                                    {{ old('type', $custom_field->type) == 'radio' ? 'selected' : '' }}
                                                    value="radio">
                                                    {{ __('radio') }}
                                                </option>
                                                <option
                                                    {{ old('type', $custom_field->type) == 'checkbox' ? 'selected' : '' }}
                                                    value="checkbox">{{ __('checkbox') }}
                                                </option>
                                                <option
                                                    {{ old('type', $custom_field->type) == 'checkbox_multiple' ? 'selected' : '' }}
                                                    value="checkbox_multiple">{{ __('checkbox_multiple') }}
                                                </option>
                                                <option {{ old('type', $custom_field->type) == 'url' ? 'selected' : '' }}
                                                    value="url">
                                                    {{ __('url') }}
                                                </option>
                                                <option
                                                    {{ old('type', $custom_field->type) == 'number' ? 'selected' : '' }}
                                                    value="number">
                                                    {{ __('number') }}
                                                </option>
                                                <option
                                                    {{ old('type', $custom_field->type) == 'file' ? 'selected' : '' }}
                                                    value="file">
                                                    {{ __('file') }}
                                                </option>
                                                <option
                                                    {{ old('type', $custom_field->type) == 'date' ? 'selected' : '' }}
                                                    value="date">
                                                    {{ __('date') }}
                                                </option>

                                            </select>
                                            @error('type')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <x-forms.label name="category" for="type" required="true" />
                                            <select name="categories[]"
                                                class="select2bs4 @error('categories') is-invalid @enderror"
                                                multiple="multiple" data-placeholder="{{ __('select_categories') }}"
                                                style="width: 100%;">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ in_array($category->id, $custom_field->categories->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group d-none" id="multiple_values">
                                            <x-forms.label name="value" for="type" required="true" />
                                            <select name="values[]"
                                                class="valueselect @error('values') is-invalid @enderror"
                                                multiple="multiple" taggable
                                                data-placeholder="{{ __('enter_new_value') }}" style="width: 100%;">
                                                @foreach ($custom_field->values as $value)
                                                    <option value="{{ $value->value }}" selected>{{ $value->value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group d-none" id="single_value">
                                            <x-forms.label name="value" for="type" required="true" />
                                            <input type="text" name="value"
                                                class="form-control @error('value') is-invalid @enderror"
                                                value="{{ old('value', isset($custom_field->values[0]) ? $custom_field->values[0]->value : '') }}"
                                                id="name" placeholder="{{ __('value') }}">
                                            @error('value')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="d-flex justify-content-center flex-wrap">
                                            <div>
                                                <x-forms.label name="" for="required" :required="false" />
                                                <div class="icheck-success">
                                                    <input
                                                        {{ old('required', $custom_field->required) == 1 ? 'checked' : '' }}
                                                        value="1" name="required" type="checkbox"
                                                        class="form-check-input" id="required" />
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
                                                    <input
                                                        {{ old('filterable', $custom_field->filterable) == 1 ? 'checked' : '' }}
                                                        value="1" name="filterable" type="checkbox"
                                                        class="form-check-input" id="filterable" />
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
                                                    <input
                                                        {{ old('listable', $custom_field->listable) == 1 ? 'checked' : '' }}
                                                        value="1" name="listable" type="checkbox"
                                                        class="form-check-input" id="listable" />
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
                                                value="{{ old('icon', $custom_field->icon) }}" />
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
                                            <i class="fas fa-sync"></i>
                                            <span class="ml-2">{{ __('update') }}</span>
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


@push('script')
    <!-- Bootstrap-Iconpicker Bundle -->
    <script type="text/javascript"
        src="{{ asset('backend') }}/plugins/bootstrap-iconpicker/dist/js/bootstrap-iconpicker.bundle.min.js"></script>
    <script type="text/javascript"
        src="{{ asset('backend') }}/plugins/bootstrap-iconpicker/dist/js/bootstrap-iconpicker.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/select2/js/select2.full.min.js"></script>
    <script>
        $('#target').iconpicker({
            align: 'center',
            arrowClass: 'btn-danger',
            arrowPrevIconClass: 'fas fa-angle-left',
            arrowNextIconClass: 'fas fa-angle-right',
            cols: 12,
            footer: true,
            header: true,
            icon: '{{ $custom_field->icon }}',
            iconset: 'fontawesome5',
            labelHeader: '{0} of {1} pages',
            labelFooter: '{0} - {1} of {2} icons',
            placement: 'bottom',
            rows: 8,
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
            allowClear: true,
        })
        $('.valueselect').select2({
            theme: 'bootstrap4',
            allowClear: true,
            tags: true
        })

        var oldType = '{{ $custom_field->type }}'
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
@endpush
