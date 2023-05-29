@extends('admin.layouts.app')

@section('title')
    {{ __('custom_field') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title" style="line-height: 36px;">{{ __('custom_field') }}</h3>
                            <div>
                                <a href="{{ route('module.custom.field.group.index') }}" class="btn btn-info">
                                    <i class="fas fa-cog"></i>
                                    <span class="ml-1">{{ __('manage_group') }}</span>
                                </a>
                                <a href="{{ route('module.custom.field.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i>
                                    <span class="ml-1">{{ __('add_custom_field') }}</span>
                                </a>
                                {{-- @if (request('category') && request('category') != 'all')
                                    @php
                                        $category = Modules\Category\Entities\Category::find(request('category'), ['id', 'name']);
                                    @endphp
                                    <a href="{{ route('module.category.custom.field.add', $category->id) }}"
                                        class="btn btn-info">
                                        <i class="fas fa-plus"></i>
                                        <span class="ml-1">{{ __('add_custom_field') }} ⇨
                                            {{ $category->name }}</span>
                                    </a>
                                @endif --}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('module.custom.field.index') }}" method="get">
                            <div class="d-flex align-center mb-3 gap-15">
                                <select name="category" id="" class="form-control">
                                    <option value="all">{{ __('all_categories') }}</option>
                                    @foreach ($categories as $category)
                                        <option {{ request('category') == $category->id ? 'selected' : '' }}
                                            value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <select name="group" id="" class="form-control">
                                    <option value="all">{{ __('all_groups') }}</option>
                                    @foreach ($groups as $group)
                                        <option {{ request('group') == $group->id ? 'selected' : '' }}
                                            value="{{ $group->id }}">{{ $group->name }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary">{{ __('filter') }}</button>
                            </div>
                        </form>
                        <table class="table table-responsive table-hover table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th class="text-left" style="width:23%">{{ __('name') }}</th>
                                    <th style="width: 12%">{{ __('type') }}</th>
                                    <th style="width: 35%">{{ __('value') }}</th>
                                    <th style="width: 12%">{{ __('options') }}</th>
                                    @if (userCan('custom-field.update') || userCan('custom-field.delete'))
                                        <th width="18%">{{ __('actions') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody id="sortable">
                                @forelse ($fields as $item)
                                    <tr data-id="{{ $item->id }}">
                                        <td>
                                            <a href="{{ route('module.custom.field.edit', $item->id) }}">
                                                <i
                                                    class="height-width-30 d-inline-flex align-items-center justify-content-center {{ $item->icon }}"></i>
                                                {{ ucfirst($item->name) }} ({{ $item->customFieldGroup->name }})
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            {{ Str::replaceFirst('_', ' ', ucfirst($item->type)) }}
                                        </td>
                                        <td class="text-center">
                                            @if (isset($item->values) && $item->values && count($item->values))
                                                @foreach ($item->values as $value)
                                                    <span class="badge bg-info">
                                                        {{ $value->value }}
                                                    </span>
                                                @endforeach
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($item->required)
                                                <span class="badge bg-primary">{{ __('required') }}</span>
                                            @endif

                                            @if ($item->filterable)
                                                <span class="badge bg-info">{{ __('filterable') }}</span>
                                            @endif

                                            @if ($item->listable)
                                                <span class="badge bg-secondary">{{ __('listable') }}</span>
                                            @endif

                                            @if (!$item->required && !$item->filterable)
                                                -
                                            @endif
                                        </td>

                                        @if (userCan('custom-field.update') || userCan('custom-field.delete'))
                                            <td class="text-center">
                                                @if (userCan('custom-field.update'))
                                                    <a data-toggle="tooltip" title="{{ __('edit') }}"
                                                        href="{{ route('module.custom.field.edit', $item->id) }}">
                                                        <div class="handle btn btn-success mt-0">
                                                            <i class="fas fa-edit"></i>
                                                        </div>
                                                    </a>
                                                @endif
                                                @if (userCan('custom-field.delete'))
                                                    <form action="{{ route('module.custom.field.destroy', $item->id) }}"
                                                        method="POST" class="d-inline">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button data-toggle="tooltip" data-placement="top"
                                                            title="{{ __('delete') }}"
                                                            onclick="return confirm('{{ __('are_you_sure_want_to_delete_this_item') }}');"
                                                            class="btn bg-danger mr-1"><i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                                <div class="btn btn-success mt-0">
                                                    <i class="fas fa-hand-rock"></i>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">
                                            <x-not-found word="field" route="module.custom.field.create" />
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('backend') }}/plugins/select2/js/select2.full.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });

        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        $(function() {
            $("#sortable").sortable({
                items: 'tr',
                cursor: 'move',
                opacity: 0.4,
                scroll: false,
                dropOnEmpty: false,
                update: function() {
                    sendTaskOrderToServer('#sortable tr');
                },
                classes: {
                    "ui-sortable": "highlight"
                },
            });
            $("#sortable").disableSelection();

            function sendTaskOrderToServer(selector) {
                var order = [];
                $(selector).each(function(index, element) {
                    order.push({
                        id: $(this).attr('data-id'),
                        position: index + 1
                    });
                });

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('module.custom.field.sorting') }}",
                    data: {
                        order: order,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        toastr.success(response.message, 'Success');
                    }
                });
            }
        });
    </script>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <style>
        .badge-value {
            position: relative;
            top: -20px;
            left: -25px;
            border: 1px solid rgb(164, 162, 162);
            border-radius: 50%;
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
