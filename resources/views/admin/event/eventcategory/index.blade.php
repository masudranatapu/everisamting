@extends('admin.layouts.app')

@section('title')
    {{ __('Event Category') }}
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3>Event Category List <span class="badge bg-blue">{{ $eventcategories->count() }}</span></h3>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#create">
                                            <i class="fa fa-plus"></i>
                                            Add Event category
                                        </button>
                                    </div>
                                </div>
                                <div class="modal fade" id="create">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Create Event Category</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('event-category.store') }}" method="post">
                                                    @csrf
                                                    <div class="form-group row">
                                                        <label class="col-md-4">Category Name <span class="text-danger">*</span></label>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Category Name" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-4">Status</label>
                                                        <div class="col-md-8">
                                                            <select name="status" class="form-control">
                                                                <option value="1">Active</option>
                                                                <option value="0">Inactive</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="offset-sm-4 col-sm-8">
                                                            <button type="submit" class="btn btn-success">Create Event Category</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>SL No</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($eventcategories as $key => $eventcategory)
                                            <tr>
                                                <td>{{ $key + 1}}</td>
                                                <td>{{ $eventcategory->name }}</td>
                                                <td>
                                                    @if($eventcategory->status == 1)
                                                        <span class="badge bg-success">Active</span>
                                                    @else 
                                                        <span class="badge bg-info">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button title="Edit event category" type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit_{{$key}}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>

                                                    <button title="Delete event category" class="btn btn-danger waves-effect" type="button" onclick="formSubmit({{ $eventcategory->id }})">
                                                        <i class="fa fa-trash"></i>
                                                    </button>

                                                    <form id="delete-form-{{ $eventcategory->id }}" action="{{ route('event-category.destroy', $eventcategory->id) }}" method="POST" class="d-none">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                                <div class="modal fade" id="edit_{{ $key }}">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Edit Event Category</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('event-category.update', $eventcategory->id) }}" method="post">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="form-group row">
                                                                        <label class="col-md-4">Category Name <span class="text-danger">*</span></label>
                                                                        <div class="col-md-8">
                                                                            <input type="text" class="form-control" name="name" placeholder="Category Name" value="{{ $eventcategory->name }}" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-md-4">Status</label>
                                                                        <div class="col-md-8">
                                                                            <select name="status" class="form-control">
                                                                                <option value="1" @if($eventcategory->status == 1) selected @endif>Active</option>
                                                                                <option value="0" @if($eventcategory->status == 0) selected @endif>Inactive</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="offset-sm-4 col-sm-8">
                                                                            <button type="submit" class="btn btn-success">Update Event Category</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-12">
                                        {!! $eventcategories->links() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function formSubmit(id) {

            if(!confirm("Do you really want to delete this?")) {
                return false;
            }

            document.getElementById('delete-form-'+id).submit();

        }
    </script>

@endsection