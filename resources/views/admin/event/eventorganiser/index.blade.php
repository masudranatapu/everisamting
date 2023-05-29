@extends('admin.layouts.app')

@section('title')
    {{ __('Event Organiser') }}
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
                                        <h3>Event Organiser List <span class="badge bg-blue">{{ $eventorganiser->count() }}</span></h3>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#create">
                                            <i class="fa fa-plus"></i>
                                            Add Event Organiser
                                        </button>
                                    </div>
                                </div>
                                <div class="modal fade" id="create">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Create Event Organiser</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('event-organiser.store') }}" method="post">
                                                    @csrf
                                                    <div class="form-group row">
                                                        <label class="col-md-4">Organiser Name <span class="text-danger">*</span></label>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Organiser Name" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-4">Email <span class="text-danger">*</span></label>
                                                        <div class="col-md-8">
                                                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-4">Phone <span class="text-danger">*</span></label>
                                                        <div class="col-md-8">
                                                            <input type="number" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="Phone" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-4">Website <span class="text-danger">*</span></label>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" name="website" value="{{ old('website') }}" placeholder="Website" required>
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
                                                            <button type="submit" class="btn btn-success">Create Event Organiser</button>
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
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Website</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($eventorganiser as $key => $organiser)
                                            <tr>
                                                <td>{{ $key + 1}}</td>
                                                <td>{{ $organiser->name }}</td>
                                                <td><a href="mailto:{{ $organiser->email }}">{{ $organiser->email }}</a></td>
                                                <td><a href="tel:{{ $organiser->phone }}">{{ $organiser->phone }}</a></td>
                                                <td><a target="__blank" href="https://{{ $organiser->website }}">{{ $organiser->website }}</a></td>
                                                <td>
                                                    @if($organiser->status == 1)
                                                        <span class="badge bg-success">Active</span>
                                                    @else 
                                                        <span class="badge bg-info">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button title="Edit event category" type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit_{{$key}}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>

                                                    <button title="Delete event category" class="btn btn-danger waves-effect" type="button" onclick="formSubmit({{ $organiser->id }})">
                                                        <i class="fa fa-trash"></i>
                                                    </button>

                                                    <form id="delete-form-{{ $organiser->id }}" action="{{ route('event-organiser.destroy', $organiser->id) }}" method="POST" class="d-none">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                                <div class="modal fade" id="edit_{{ $key }}">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Edit Event Organiser</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('event-organiser.update', $organiser->id) }}" method="post">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="form-group row">
                                                                        <label class="col-md-4">Organiser Name <span class="text-danger">*</span></label>
                                                                        <div class="col-md-8">
                                                                            <input type="text" class="form-control" name="name" placeholder="Organiser Name" value="{{ $organiser->name }}" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-md-4">Email <span class="text-danger">*</span></label>
                                                                        <div class="col-md-8">
                                                                            <input type="email" class="form-control" name="email" placeholder="Email" value="{{ $organiser->email }}" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-md-4">Phone <span class="text-danger">*</span></label>
                                                                        <div class="col-md-8">
                                                                            <input type="number" class="form-control" name="phone" placeholder="Phone" value="{{ $organiser->phone }}" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-md-4">Website <span class="text-danger">*</span></label>
                                                                        <div class="col-md-8">
                                                                            <input type="text" class="form-control" name="website" placeholder="Website" value="{{ $organiser->website }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-md-4">Status</label>
                                                                        <div class="col-md-8">
                                                                            <select name="status" class="form-control">
                                                                                <option value="1" @if($organiser->status == 1) selected @endif>Active</option>
                                                                                <option value="0" @if($organiser->status == 0) selected @endif>Inactive</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="offset-sm-4 col-sm-8">
                                                                            <button type="submit" class="btn btn-success">Update Event Organiser</button>
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
                                        {!! $eventorganiser->links() !!}
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