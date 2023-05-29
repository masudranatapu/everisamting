@php
$user = auth()->user();
@endphp

@extends('admin.layouts.app')

@section('title')
    {{ __('category_list') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header mb-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title" style="line-height: 36px;">{{ __('category_list') }}</h3>
                            <div>
                                @if (userCan('subcategory.view'))
                                    <a href="{{ route('module.subcategory.index') }}"
                                        class="btn bg-primary float-right d-flex align-items-center justify-content-center mr-1">
                                        <i class="fas fa-list-alt"></i>
                                        {{ __('subcategory') }}
                                    </a>
                                @endif
                                @if (userCan('category.create'))
                                    <a href="{{ route('module.category.create') }}"
                                        class="btn bg-primary float-right d-flex align-items-center justify-content-center mx-1">
                                        <i class="fas fa-plus"></i>
                                        {{ __('add_category') }}
                                    </a>
                                @endif
                                @if (userCan('subcategory.create'))
                                    <a href="{{ route('module.subcategory.create') }}"
                                        class="btn bg-primary float-right d-flex align-items-center justify-content-center ml-1">
                                        <i class="fas fa-plus"></i>
                                        {{ __('subcategory') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-2">
                        <table class="table table-hover text-nowrap table-bordered" id="example">
                            <thead>
                                <tr class="text-center">
                                    <th width="10%">{{ __('image') }}</th>
                                    <th>{{ __('name') }} ({{ __('ads_count') }})</th>
                                    <th>{{ __('icon') }}</th>
                                    <th>{{ __('Category Type') }}</th>
                                    @if (userCan('category.update') || userCan('category.delete'))
                                        <th width="10%">{{ __('status') }}</th>
                                        <th width="10%">{{ __('actions') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody id="sortable">
                                @forelse ($categories as $category)
                                    <tr data-id="{{ $category->id }}">
                                        <td class="text-center">
                                            <img width="50px" height="50px" src="@if($category->image) {{ asset($category->image) }} @else {{ asset('images/category.jpg') }} @endif"
                                                alt="cate_image">
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('module.category.show', $category->slug) }}">
                                                {{ $category->name }} ({{ $category->ads_count }})
                                            </a>
                                        </td>
                                        <td class="text-center"><i
                                                class="{{ $category->icon }}"></i>&nbsp;&nbsp;&nbsp;({{ $category->icon }})
                                        </td>
                                        <td class="text-center">
                                            @if($category->type == 1)
                                                <span class="badge bg-success">{{ __('general') }}</span>
                                            @else
                                                <span class="badge bg-info">{{ __('business_directory') }}</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div>
                                                <label class="switch ">
                                                    <input data-id="{{ $category->id }}" type="checkbox"
                                                        class="success toggle-switch"
                                                        {{ $category->status == 1 ? 'checked' : '' }}>
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </td>
                                        @if (userCan('category.update') || userCan('category.delete'))
                                            <td class="text-center">
                                                @if (userCan('category.update'))
                                                    <div class="handle btn btn-success mt-0"><i
                                                            class="fas fa-hand-rock"></i></div>
                                                    <a title="{{ __('edit_category') }}"
                                                        href="{{ route('module.category.edit', $category->id) }}"
                                                        class="btn bg-info mr-1">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                @endif
                                                {{-- @if (userCan('category.delete'))
                                                    <form action="{{ route('module.category.destroy', $category->id) }}"
                                                        method="POST" class="d-inline">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button data-toggle="tooltip" data-placement="top"
                                                            title="{{ __('delete_category') }}"
                                                            onclick="return confirm('{{ __('Are you sure want to delete this item?') }}');"
                                                            class="btn bg-danger mr-1"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                @endif --}}
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">
                                            <x-not-found word="Category" route="module.category.create" />
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
    <script type="text/javascript" src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(function() {
            $("#sortable").sortable({
                items: 'tr',
                cursor: 'move',
                opacity: 0.5,
                scroll: true,
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
                    url: "{{ route('module.category.updateOrder') }}",
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

        $('.toggle-switch').change(function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('module.category.status.change') }}',
                data: {
                    'status': status,
                    'id': id
                },
                success: function(response) {
                    toastr.success(response.message, 'Success');
                }
            });
        })
    </script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                scrollY: '600px',
                scrollCollapse: true,
                paging: false,
            });
        });
    </script>
@endsection

@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 35px;
            height: 19px;
            /* width: 60px; */
            /* height: 34px; */
        }

        /* Hide default HTML checkbox */
        .switch input {
            display: none;
        }

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 15px;
            width: 15px;
            left: 3px;
            bottom: 2px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input.success:checked+.slider {
            background-color: #28a745;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(15px);
            -ms-transform: translateX(15px);
            transform: translateX(15px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
@endsection
