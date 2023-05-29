@extends('admin.layouts.app')
@section('title')
    {{ __('category_list') }}
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">{{ __('category_list') }}</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover text-nowrap table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>{{ __('image') }}</th>
                                    <th>{{ __('name') }}</th>
                                    @if (userCan('postcategory.update') || userCan('postcategory.delete'))
                                        <th width="10%">{{ __('actions') }}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $key => $category)
                                    <tr id="item_id{{ $category->id }}">
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <img width="50px" height="50px" src="{{ $category->image_url }}"
                                                alt="category image">
                                        </td>
                                        <td>{{ $category->name }}</td>
                                        @if (userCan('postcategory.update') || userCan('postcategory.delete'))
                                            <td>
                                                @if (userCan('postcategory.update'))
                                                    <a href="{{ route('module.postcategory.index', $category->slug) }}"
                                                        class="btn bg-info mr-1">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                @endif
                                                @if (userCan('postcategory.delete'))
                                                    <form
                                                        action="{{ route('module.postcategory.destroy', $category->id) }}"
                                                        method="POST" class="d-inline mt-2">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button data-toggle="tooltip" data-placement="top"
                                                            title="{{ __('delete_tag') }}"
                                                            onclick="return confirm('Are you sure to delete this item?')"
                                                            class="btn bg-danger"><i class="fas fa-trash"></i></button>
                                                    </form>
                                                @endif
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">
                                            <x-not-found word="Categoty" />
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if ($categories->total() > $categories->count())
                        <div class="card-footer ">
                            <div class="d-flex justify-content-center">
                                {{ $categories->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="line-height: 36px;">
                            @if ($edit_category)
                                <span>{{ __('edit_category') }}</span>
                            @else
                                <span>{{ __('add_category') }}</span>
                            @endif
                        </h3>
                    </div>
                    <div class="card-body">
                        @if ($edit_category && userCan('postcategory.update'))
                            <form class="form-horizontal"
                                action="{{ route('module.postcategory.update', $edit_category->slug) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <x-forms.label name="name" required="true" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input value="{{ $edit_category->name }}" name="name" type="text"
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
                                    <x-forms.label name="change_image" required="true" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input value="{{ old('name') }}" name="image" type="file"
                                            class="form-control border-0 pl-0 {{ $errors->has('image') ? 'is-invalid' : '' }}">
                                        @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-12">
                                        <button type="submit" class="btn btn-success"><i class="fas fa-sync"></i>&nbsp;
                                            {{ __('update') }}</button>
                                        <a href="{{ route('module.postcategory.index') }}" class="btn btn-danger mt-2"><i
                                                class="fas fa-times"></i>&nbsp; {{ __('cancel') }}</a>
                                    </div>
                                </div>
                            </form>
                        @elseif (!$edit_category && userCan('postcategory.create'))
                            <form class="form-horizontal" action="{{ route('module.postcategory.store') }}"
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
                                    <x-forms.label name="image" required="true" class="col-sm-3" />
                                    <div class="col-sm-9">
                                        <input value="{{ old('name') }}" name="image" type="file"
                                            class="form-control border-0 pl-0 {{ $errors->has('image') ? 'is-invalid' : '' }}">
                                        @error('image')
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
    <link rel="stylesheet"
        href="{{ asset('backend') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endsection

@section('script')
    <script src="{{ asset('backend') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('backend') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
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
    </script>
@endsection
