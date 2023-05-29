@extends('admin.layouts.app')
@section('title')
    {{ __('custom_field_group_list') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('custom_field_group_list') }}</h3>
                    </div>
                    <div class="card-body m-0 p-0">
                        <table class="table table-hover text-nowrap table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>{{ __('name') }}</th>
                                    <th>{{ __('custom_fields') }}</th>
                                    @if (userCan('custom-field-group.update') || userCan('custom-field-group.delete'))
                                        <th width="10%">{{ __('actions') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody id="sortable">
                                @forelse ($groups as $key => $group)
                                    <tr data-id="{{ $group->id }}">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $group->name }}</td>
                                        <td>
                                            <a
                                                href="{{ route('module.custom.field.index', ['group' => $group->id]) }}">{{ $group->custom_fields_count }}</a>
                                        </td>
                                        @if (userCan('custom-field-group.update') || userCan('custom-field-group.delete'))
                                            <td>
                                                @if (userCan('custom-field-group.update'))
                                                    <a href="{{ route('module.custom.field.group.index', $group->slug) }}"
                                                        class="btn bg-info mr-1">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                @endif
                                                @if (userCan('custom-field-group.delete'))
                                                    <form
                                                        action="{{ route('module.custom.field.group.destroy', $group->id) }}"
                                                        method="POST" class="d-inline mt-2">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button data-toggle="tooltip" data-placement="top"
                                                            title="{{ __('delete_tag') }}"
                                                            onclick="return confirm('Are you sure to delete this item?')"
                                                            class="btn bg-danger"><i class="fas fa-trash"></i></button>
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
                                            <x-not-found2 word="group" />
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if ($groups->total() > $groups->count())
                        <div class="card-footer ">
                            <div class="d-flex justify-content-center">
                                {{ $groups->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">
                            @if ($edit_group)
                                <span>{{ __('edit_group') }}</span>
                            @else
                                <span>{{ __('add_group') }}</span>
                            @endif
                        </h3>
                    </div>
                    <div class="card-body">
                        @if ($edit_group && userCan('custom-field-group.update'))
                            <form class="form-horizontal"
                                action="{{ route('module.custom.field.group.update', $edit_group->slug) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <x-forms.label name="name" required="true" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input value="{{ $edit_group->name }}" name="name" type="text"
                                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            placeholder="{{ __('enter_name') }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-12 ">
                                        <button type="submit" class="btn btn-success"><i class="fas fa-sync"></i>&nbsp;
                                            {{ __('update') }}
                                        </button>
                                        <a href="{{ route('module.custom.field.group.index') }}"
                                            class="btn btn-danger"><i class="fas fa-times"></i>&nbsp; {{ __('cancel') }}
                                        </a>
                                    </div>
                                </div>
                            </form>
                        @elseif (!$edit_group && userCan('custom-field-group.create'))
                            <form class="form-horizontal" action="{{ route('module.custom.field.group.store') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <x-forms.label name="name" required="true" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input value="{{ old('name') }}" name="name" type="text"
                                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            placeholder="{{ __('enter_name') }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-4">
                                        <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i>&nbsp;
                                            {{ __('create') }}</button>
                                    </div>
                                </div>
                            </form>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('backend') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endsection

@section('script')
    <script src="{{ asset('backend') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });

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
                    url: "{{ route('module.custom.field.group.sorting') }}",
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
